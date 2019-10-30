<?php

require APPPATH . 'controllers/analyst_controller.php';

class Chroma_conditions extends MY_Controller {

    public function index() {
        $this->itemsUsed();
    }

    public function itemsUsed() {
        $data = array();
        $reqid = $this->uri->segment(3);
        $data['components'] = Components::getComponents($reqid);
        $data['content_view'] = "items_used_v";
        $this->load->view("template1", $data);
    }

    public function batch_processor($labref, $tid) {
        $data = array();
        $data['components'] = Components::getComponents($labref);
        $data['labref'] = $labref;
        $data['test_id'] = $tid;
        $data['content_view'] = "chroma_hplc";
        $data['title'] = "Reagents - Standards - Equipments";
        $data['labrefs'] = $this->loadLabrefBatch();
        $data['labrefsd'] = $this->loadLabrefBatchDone();
        $data['labref'] = $labref;
        $this->load->view("template", $data);
    }

    function loadLabrefBatch() {
        $id = $this->session->userdata('user_id');
        return $this->db
                        ->select('lab_ref_no')
                        ->where('analyst_id', $id)
                        ->where('done_status', '0')
                        ->group_by('lab_ref_no')
                        ->get('sample_issuance')
                        ->result();
    }

    function loadLabrefBatchDone() {
        $id = $this->session->userdata('user_id');
        return $this->db
                        ->select('lab_ref_no')
                        ->where('analyst_id', $id)
                        ->where('equip_status', '1')
                        ->group_by('lab_ref_no')
                        ->get('sample_issuance')
                        ->result();
    }

    public function hplc() {

        $data = array();
        $data['content_view'] = "chroma_hplc";
        $this->load->view("template1", $data);
    }

    public function getAssayColumn() {
//Get uri segments
        $reqid = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);

//Get Column Number
        $column_no = Columns_usage::getColumnNumber($reqid, $test_id);
        $c_no = $column_no[0]["columns"]["column_no"];
        $c_id = $column_no[0]["column_id"];
//Return Json to View
        if (!empty($column_no)) {
            $column_details = Columns::getColumns($c_no);
            $chromatographic_conditions = Chromatographic_conditions::getConditions($reqid, $test_id, $c_id);
            echo json_encode(array(
                'status' => 'success',
                'details' => $column_details,
                'conditions' => $chromatographic_conditions
            ));
        } else {
            echo json_encode(array(
                'status' => 'error',
                'details' => 'Assay column not found. Please do Assay first.'
            ));
        }
    }

    public function columns() {
        $data = array();
        $data['worksheet_name'] = $this->uri->segment(5);
        $data['test_id'] = $this->uri->segment(3);
        $data['reqid'] = $this->uri->segment(4);
        $data['save_url'] = $this->router->fetch_class();
        $data['formname'] = $this->router->fetch_method() . "form";

        $data['content_view'] = "chromatographic_conditions_v";
        $this->load->view("template1", $data);
    }

    public function compendia() {
        $data = array();
        $data['worksheet_name'] = $this->uri->segment(5);
        $data['test_id'] = $this->uri->segment(3);
        $data['reqid'] = $labref = $this->uri->segment(4);
        $data['c_count'] = $this->load_count($labref);
        $data['save_url'] = $this->router->fetch_class();
        $data['formname'] = $this->router->fetch_method() . "form";

        $data['content_view'] = "compendia_v";
        $this->load->view("template1", $data);
    }

    function load_count($labref) {
        return $this->db->where('request_id', $labref)->get('components')->result();
    }

    public function compendia_save() {
        $this->checkPost();

        //Get Request_id
        $reqid = $this->input->post("request_id");

        //Get Test_id
        $test_id = $this->input->post("test_id");

        //Hold input values in variables - get compendia and specification
        $compendia = $this->input->post("compendia");
        // print_r($compendia);
        $c_splited = implode(":", $compendia);
        $specification = $this->input->post("specification");
        $s_splited = implode(":", $specification);



        //Concatenate specifications and limits
        //$specs_limits = $specification . " " .$limits;
        //Update arrays
        $coa_body_where_array = array('test_id' => $test_id, 'labref' => $reqid);
        $coa_body_update_array = array('compedia' => $c_splited, 'specification' => $s_splited);

        //Update Coa Body
        $this->db->where($coa_body_where_array);
        $this->db->update('coa_body', $coa_body_update_array);

        //Set compendia status to 1 in sample issuance table
        $this->setCompendiaStatus($test_id, $reqid);
    }

    public function setCompendiaStatus($t, $r) {

        //Set Compendia Status to 1 in Sample Issuance Table
        $this->db->where(array('test_id' => $t, 'lab_ref_no' => $r));
        $this->db->update('sample_issuance', array('compendia_status' => 1));
    }

    public function getUser() {
        $userarray = $this->session->userdata;
        $user_id = $userarray['user_id'];
        return $user_id;
    }

    public function checkPost() {
        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully'
            ));
        }
    }

    function post($name) {
        return $this->input->post($name);
    }

    function Rem($labref, $aid, $table) {
        $this->db->where('labref', $labref)->where('user_id', $aid)->delete($table);
    }

    function saveBatch($la, $test_id) {
        $user_id = $this->getUser();
        $labref = $this->post('labref');
 for ($w = 0; $w < count($labref); $w++):
        $this->Rem($labref[$w], $user_id, 'reagents_used');
        $this->Rem($labref[$w], $user_id, 'equipment_used');
        $this->Rem($labref[$w], $user_id, 'refsubs_used');
        $this->db->where('request_id', $labref[$w])->where('user_id', $user_id)->delete('chromatographic_conditions');
		endfor;
		




        //Equipment   
        $ename = $this->post('ename');
        $ecode = $this->post('ecode');
        $edlc = $this->post('edlc');
        $ednc = $this->post('ednc');

        //Reagents   
        $rname = $this->post('rname');
        $rmfg = $this->post('rmfg');
        $rbatch = $this->post('rbatch');
        $rodate = $this->post('rodate');
        $redate = $this->post('redate');

        //Standards   
        $sname = $this->post('sname');
        $sbatch = $this->post('sbatch');
        $spot = $this->post('spot');
        $sedate = $this->post('sedate');

        for ($l = 0; $l < count($labref); $l++):

            for ($e = 0; $e < count($ename); $e++):
                $equip = array(
                    'labref' => $labref[$l],
                    'equipment' => $ename[$e],
                    'nqcl_code' => $ecode[$e],
                    'last_calibrated' => $edlc[$e],
                    'next_calibration' => $ednc[$e],
                    'user_id' => $user_id,
                    'test_id' => $test_id
                );

                $this->db->insert('equipment_used', $equip);
            endfor;

            for ($r = 0; $r < count($rname); $r++):
                $reagents = array(
                    'labref' => $labref[$l],
                    'reagent' => $rname[$r],
                    'manufacturer' => $rmfg[$r],
                    'batch_no' => $rbatch[$r],
                    'date_opened' => $rodate[$r],
                    'expiry_date' => $redate[$r],
                    'user_id' => $user_id,
                    'test_id' => $test_id
                );
                $this->db->insert('reagents_used', $reagents);
            endfor;

            for ($i = 0; $i < count($sname); $i++):
                $std = array(
                    'labref' => $labref[$l],
                    'refsub' => $sname[$i],
                    'nqcl_code' => $sbatch[$i],
                    'quantity' => 'N/A',
                    'potency' => $spot[$i],
                    'expiry_date' => $sedate[$i],
                    'user_id' => $user_id,
                    'test_id' => $test_id
                );

                $this->db->insert('refsubs_used', $std);
            endfor;


            $chroconds = array(
                'request_id' => $labref[$l],
                'column_id' => $this->post('cnoA'),
                'column_type' => $this->post('ctype'),
                'column_temp' => $this->post('ctemp'),
                'detection' => $this->post('cdet'),
                'injection' => $this->post('cin'),
                'flow_rate' => $this->post('cra'),
                'pump_pressure' => $this->post('cpr'),
                'mobile_phase' => $this->post('mobile_phase'),
                'user_id' => $user_id,
                'test_id' => '5'
            );
            $this->db->insert('chromatographic_conditions', $chroconds);

            $chrocondsdis = array(
                'request_id' => $labref[$l],
                'column_id' => $this->post('cnoD'),
                      'column_type' => $this->post('cdtype'),
                'column_temp' => $this->post('cdtemp'),
                'detection' => $this->post('cddet'),
                'injection' => $this->post('cdin'),
                'flow_rate' => $this->post('cdra'),
                'pump_pressure' => $this->post('cdpr'),
                'mobile_phase' => $this->post('mobile_phased'),
                'user_id' => $user_id,
                'test_id' => '2'
            );

            $this->db->insert('chromatographic_conditions', $chrocondsdis);

            $this->updateBatchStatus($labref[$l]);
            $this->RegisterStandardsBatch($labref[$l]);
        endfor;




        redirect('analyst_controller');
    }

    function updateBatchStatus($labref) {
        $data = array(
            'equip_status' => '1',
            'chroma_status' => '1',
        );
        $this->db->where('lab_ref_no', $labref)->update('sample_issuance', $data);
    }

    public function save() {

        //Check if POST is successful
        $this->checkPost();

        //User Logged in
        $user_id = $this->getUser();

        //Get Lab Reference Number
        $reqid = $this->input->post("request_id");

        //Get Test_id
        $test_id = $this->input->post("test_id");

        //Hold input values in variables
        $id = $this->input->post("column_id");
        $column_temp = $this->input->post("column_temp");
        $detection = $this->input->post("detection");
        $injection = $this->input->post("injection");
        $flow_rate = $this->input->post("flow_rate");
        $pump_pressure = $this->input->post("pump_pressure");
        $mobile_phase = $this->input->post("mobile_phase");


        //Log Column Usage
        $clmn = new Columns_usage();
        $clmn->column_id = $id;
        $clmn->request_id = $reqid;
        $clmn->test_id = $test_id;
        $clmn->date = date('y-m-d');
        $clmn->user_id = $user_id;
        $clmn->save();

        //Save Chromatographic Conditions
        $chrmcnd = new Chromatographic_conditions();
        $chrmcnd->request_id = $reqid;
        $chrmcnd->test_id = $test_id;
        $chrmcnd->column_id = $id;
        $chrmcnd->column_temp = $column_temp;
        $chrmcnd->detection = $detection;
        $chrmcnd->injection = $injection;
        $chrmcnd->flow_rate = $flow_rate;
        $chrmcnd->pump_pressure = $pump_pressure;
        $chrmcnd->mobile_phase = $mobile_phase;
        $chrmcnd->save();

        //Set status to 1
        $chroma_status = 1;

        //Set update arrays
        $chroma_where_array = array('lab_ref_no' => $reqid, 'test_id' => $test_id);
        $chroma_update_array = array('chroma_status' => $chroma_status);


        //Update chromatographic conditions status to 0
        $this->db->where($chroma_where_array);
        $this->db->update('sample_issuance', $chroma_update_array);
        $this->RegisterStandards($reqid, $column_temp);
    }

    function RegisterStandardsBatch($labref) {
        if (file_exists('samplepdfs/' . $labref . '_CHROMATOGRAPHIC_CONDITIONS.pdf')) {
            unlink('samplepdfs/' . $labref . '_CHROMATOGRAPHIC_CONDITIONS.pdf');
        } else {
            // echo 'Not found';
        }
        $standards = $this->getStandardsBP($labref);
        $c_conds_assay = $this->getColumnsChromaCABP($labref);
        $c_conds_diss = $this->getColumnsChromaCDBP($labref);
	

        $full_name = 'samplepdfs/HPLC_Conditions__Assay___Dissolution_.pdf';
        $pdf = new FPDI('P', 'mm', 'A4');
        $pdf->AliasNbPages();

        $pagecount = $pdf->setSourceFile($full_name);

        $i = 1;
        do {
            // add a page
            $pdf->AddPage();
            // import page
            $tplidx = $pdf->ImportPage($i);

            $pdf->useTemplate($tplidx, 10, 10, 200);

            $pdf->SetFont('Arial');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFontSize(9);

            
                $pdf->SetXY(70, 52);
                $pdf->Write(1, $c_conds_assay[0]->column_id);
                $pdf->SetXY(125, 52);
                $pdf->Write(1, $c_conds_assay[0]->column_type);
                $pdf->SetXY(70, 58);
                $pdf->Write(1, $c_conds_assay[0]->column_temp);
                $pdf->SetXY(70, 63);
                $pdf->Write(1, $c_conds_assay[0]->detection);
                $pdf->SetXY(128, 63);
                $pdf->Write(1, $c_conds_assay[0]->injection);
                $pdf->SetXY(25, 80);
                $pdf->Write(1, $c_conds_assay[0]->mobile_phase);
                $pdf->SetXY(178, 79);
                $pdf->Write(1, $c_conds_assay[0]->flow_rate);
                $pdf->SetXY(178, 85);
                $pdf->Write(1, $c_conds_assay[0]->pump_pressure);


                //chromatographic conditions dissolution
                $pdf->SetXY(70, 109);
                $pdf->Write(1, $c_conds_diss[0]->column_id);
                $pdf->SetXY(125, 109);
                $pdf->Write(1, $c_conds_diss[0]->column_type);
                $pdf->SetXY(70, 115);
                $pdf->Write(1, $c_conds_diss[0]->column_temp);
                $pdf->SetXY(70, 120);
                $pdf->Write(1, $c_conds_diss[0]->detection);
                $pdf->SetXY(128, 120);
                $pdf->Write(1, $c_conds_diss[0]->injection);
                $pdf->SetXY(25, 137);
                $pdf->Write(1, $c_conds_diss[0]->mobile_phase);
                $pdf->SetXY(178, 137);
                $pdf->Write(1, $c_conds_diss[0]->flow_rate);
                $pdf->SetXY(178, 142);
                $pdf->Write(1, $c_conds_diss[0]->pump_pressure);
            




            $xa = 1;
            $ya = (int) 172;
            $pdf->SetFontSize(10);
            for ($s = 0; $s < count($standards); $s++) {

                $pdf->SetXY(38, $ya+=7);
                $pdf->Write(1, $standards[$s]->refsub);

                $pdf->SetXY(115, $ya);
                $pdf->Write(1, $standards[$s]->nqcl_code);

                $pdf->SetXY(160, $ya);
                $pdf->Write(1, round($standards[$s]->potency, 4));
            }






            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/' . $labref . '_CHROMATOGRAPHIC_CONDITIONS.pdf', 'F');
        $test_id = '500';
        $analyst_id = $this->session->userdata('user_id');
        $this->deletePDFgen($labref, $test_id, $analyst_id);
        $pdf_name = $labref . '_CHROMATOGRAPHIC_CONDITIONS';
        $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
    }

    function RegisterStandards($labref, $column_temp) {
        if (file_exists('samplepdfs/' . $labref . '_CHROMATOGRAPHIC_CONDITIONS.pdf')) {
            unlink('samplepdfs/' . $labref . '_CHROMATOGRAPHIC_CONDITIONS.pdf');
        } else {
            // echo 'Not found';
        }
        $standards = $this->getStandards($labref);
        $c_conds_assay = $this->getColumnsChromaCA($labref);
        $c_conds_diss = $this->getColumnsChromaCD($labref);

        $full_name = 'samplepdfs/HPLC_Conditions__Assay___Dissolution_.pdf';
        $pdf = new FPDI('P', 'mm', 'A4');
        $pdf->AliasNbPages();

        $pagecount = $pdf->setSourceFile($full_name);

        $i = 1;
        do {
            // add a page
            $pdf->AddPage();
            // import page
            $tplidx = $pdf->ImportPage($i);

            $pdf->useTemplate($tplidx, 10, 10, 200);

            $pdf->SetFont('Arial');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFontSize(9);

            if ($column_temp != '') {
                //chromatographic conditions assay
                $pdf->SetXY(70, 52);
                $pdf->Write(1, $c_conds_assay[0]->column_id);
                $pdf->SetXY(125, 52);
                $pdf->Write(1, $c_conds_assay[0]->column_id);
                $pdf->SetXY(70, 58);
                $pdf->Write(1, $c_conds_assay[0]->column_temp);
                $pdf->SetXY(70, 63);
                $pdf->Write(1, $c_conds_assay[0]->detection);
                $pdf->SetXY(128, 63);
                $pdf->Write(1, $c_conds_assay[0]->injection);
                $pdf->SetXY(25, 80);
                $pdf->Write(1, $c_conds_assay[0]->mobile_phase);
                $pdf->SetXY(178, 79);
                $pdf->Write(1, $c_conds_assay[0]->flow_rate);
                $pdf->SetXY(178, 85);
                $pdf->Write(1, $c_conds_assay[0]->pump_pressure);


                //chromatographic conditions dissolution
                $pdf->SetXY(70, 109);
                $pdf->Write(1, $c_conds_diss[0]->column_id);
                $pdf->SetXY(125, 109);
                $pdf->Write(1, $c_conds_diss[0]->column_id);
                $pdf->SetXY(70, 115);
                $pdf->Write(1, $c_conds_diss[0]->column_temp);
                $pdf->SetXY(70, 120);
                $pdf->Write(1, $c_conds_diss[0]->detection);
                $pdf->SetXY(128, 120);
                $pdf->Write(1, $c_conds_diss[0]->injection);
                $pdf->SetXY(25, 137);
                $pdf->Write(1, $c_conds_diss[0]->mobile_phase);
                $pdf->SetXY(178, 137);
                $pdf->Write(1, $c_conds_diss[0]->flow_rate);
                $pdf->SetXY(178, 142);
                $pdf->Write(1, $c_conds_diss[0]->pump_pressure);
            }




            $xa = 1;
            $ya = (int) 172;
            $pdf->SetFontSize(10);
            for ($s = 0; $s < count($standards); $s++) {

                $pdf->SetXY(38, $ya+=7);
                $pdf->Write(1, $standards[$s]->refsub);

                $pdf->SetXY(115, $ya);
                $pdf->Write(1, $standards[$s]->nqcl_code);

                $pdf->SetXY(160, $ya);
                $pdf->Write(1, round($standards[$s]->potency, 4));
            }






            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/' . $labref . '_CHROMATOGRAPHIC_CONDITIONS.pdf', 'F');
        $test_id = '500';
        $analyst_id = $this->session->userdata('user_id');
        $this->deletePDFgen($labref, $test_id, $analyst_id);
        $pdf_name = $labref . '_CHROMATOGRAPHIC_CONDITIONS';
        $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
    }

    public function uv() {

        $data = array();
        $data['content_view'] = "chroma_uv";
        $this->load->view("template1", $data);
    }
    
        function getCodes($table){
        $name = $this->input->get('eq',TRUE);
        echo json_encode($this->db->where('name',str_replace('%20','',$name))->get($table)->result());
    }
    
    
        function suggestions_table($table) {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetProcAutocomplete($table, array('name' => $term));

        $keywords = array();
        foreach ($rows as $row){
            array_push($keywords, $row->name);
        }

        echo json_encode($keywords);
    }
    
    
        function suggestions_table_columns() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetColumnsAutocomplete( array('name' => $term));

        $keywords = array();
        foreach ($rows as $row){
            array_push($keywords, $row->column_no);
            array_push($keywords, $row->column_type);
            array_push($keywords, $row->column_dimensions);
        }

        echo json_encode($keywords);
    }
    
    
      function GetColumnsAutocomplete($options = array()) {
         
       $query= $this->db->select('c.column_no ,ct.column_type, ct.column_dimension')
       ->from(' columns c, column_types ct')
        ->where(' c.column_id','ct.id')
        ->like('c.column_no', $options['name'], 'after')
        ->order_by('c.column_no','ASC');
       
        return $query->result();
    }
    
    function loadColumns($cno){
        echo json_encode($this->db->query("SELECT c.column_no ,ct.column_type, ct.column_dimensions FROM columns c, column_types ct WHERE c.column_id=ct.id AND c.column_no = '$cno'  ")->result());
    }
    
    

    
    
     function GetProcAutocomplete($table,$options = array()) {
         $table2 = explode('%', $table);
        $this->db->distinct();
        $this->db->select('name');
        $this->db->like('name', $options['name'], 'after');
        $this->db->order_by('name','ASC');
        $query = $this->db->get($table2[0]);
        return $query->result();
    }

    public function GetAutocomplete($options = array(), $table_name, $column) {
        $this->db->distinct();
        $this->db->select($column);
        $this->db->like($column, $options[$column], 'after');
        $query = $this->db->get($table_name);
        return $query->result();
    }

    public function suggestions() {
        $column = $this->uri->segment(4);
        $table = $this->uri->segment(3);
        $term = $this->input->post('term', TRUE);
        $rows = $this->GetAutocomplete(array($column => $term), $table, $column);
        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->$column);
        echo json_encode($keywords);
    }

    function getItems() {
        $table = $this->uri->segment(4);
        $method = "get" . $table;
        $ref = $this->uri->segment(3);
        $ref = str_replace('%20', '_', $ref);
        $details = $table::$method($ref);
        echo json_encode($details);
    }

    function pushCodes() {
        $details = $this->getCodes();
        $details_array = array();

        foreach ($details as $detail)
            array_push($details_array, $details->code);
        echo json_encode($details_array);
    }

    public function save_items() {
        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully',
                'array' => json_encode($_POST)
            ));
        }

        //Date	
        $date = date('y-m-d');

        //User id
        $userarray = $this->session->userdata;
        $user_id = $userarray['user_id'];

        //Request id
        $reqid = $this->uri->segment(3);

        //Test id

        $test_id = $this->uri->segment(4);

        //Item ids		
        $equipment = $this->input->post('e_id', TRUE);
        $reagents = $this->input->post('r_id', TRUE);
        $standards = $this->input->post('s_id', TRUE);
        $columns = $this->input->post('c_id', TRUE);

        //Components per refsub
        $components = $this->input->post("s_components", TRUE);

        for ($i = 0; $i < count($reagents); $i++) {
            $reagents1 = array(
                'reagent_id' => $reagents[$i],
                'request_id' => $reqid,
                'date' => $date,
                'user_id' => $user_id,
                //$rgnt -> quantity = $reagents_qty[$i];
                'unit' => ''
            );
            $this->db->insert('reagents_usage', $reagents1);
        }

        /* Quantity
          $reagents_qty = $this -> input -> post('reagents_qty', TRUE);
          $standards_qty = $this -> input -> post('standards_qty', TRUE);
         */

        //Save Equipment
        if (!empty($equipment)) {
            for ($i = 0; $i < count($equipment); $i++) {
                $equip = new Equipment_usage();
                $equip->equipment_id = $equipment[$i];
                $equip->request_id = $reqid;
                $equip->date = $date;
                $equip->user_id = $user_id;
                $equip->save();
            }
        }

        //Save Reagents
        if (!empty($reagents)) {
            for ($i = 0; $i < count($reagents); $i++) {

                /* Offset used quantities against existing quantities
                  $reagentData = Reagents::getQuantity($reagents[$i]);
                 */
                if (!empty($reagentData)) {
                    /*
                      $oldReagentQty = $reagentData[0]['volume'];
                      $reagentUnit = $reagentData[0]['qunit'];
                      $newReagentQty = $oldReagentQty - $reagents_qty[$i];
                      $updateReagentQty = array('volume' => $newReagentQty);

                      //Update reagents table
                      $this -> db -> where('id', $reagents[$i]);
                      $this -> db -> update('reagents', $updateReagentQty);
                     */

                    $rgnt = new Reagents_usage();
                    $rgnt->reagent_id = $reagents[$i];
                    $rgnt->request_id = $reqid;
                    $rgnt->date = $date;
                    $rgnt->user_id = $user_id;
                    //$rgnt -> quantity = $reagents_qty[$i];
                    $rgnt->unit = $reagentUnit;
                    //$rgnt -> save();
                }
            }
        }



        //Save Standards
        if (!empty($standards)) {

            for ($i = 0; $i < count($standards); $i++) {
                /* Offset used quantities against existing quantities
                  $standardsData = Refsubs::getQuantity2($standards[$i]);
                 */
                //if(!empty($standardsData)){

                /*
                  $oldStandardQty = $standardsData[0]['init_mass'];
                  $standardUnit = $standardsData[0]['init_mass_unit'];
                  $newStandardQty = $oldStandardQty - $standards_qty[$i];
                  $updateStandardQty = array('init_mass' => $newStandardQty);

                  Update reagents table
                  $this -> db -> where('id', $standards[$i]);
                  $this -> db -> update('refsubs', $updateStandardQty);
                 */

                //Save Refsubs
                $rfsb = new Refsubs_usage();
                $rfsb->refsubs_id = $standards[$i];
                $rfsb->request_id = $reqid;
                $rfsb->date = $date;
                $rfsb->user_id = $user_id;
                $rfsb->component = $components[$i];
                //$rfsb -> quantity = $standards_qty[$i];
                //$rfsb -> unit = $standardUnit;
                $rfsb->save();
                //}		
            }
        }
        //Save Columns

        /* if(!empty($standards)) {
          for($i=0;$i<count($columns);$i++){
          $rfsb =  new Columns_usage();
          $rfsb -> column_id = $columns[$i];
          $rfsb -> request_id = $reqid;
          $rfsb -> date = $date;
          $rfsb -> user_id = $user_id;
          $rfsb -> save();
          }
          } */

        //Update equip status
        $equip_update_where_array = array('lab_ref_no' => $reqid);
        $equip_update_array = array('equip_status' => '1');
        $this->db->where($equip_update_where_array);
        $this->db->update('sample_issuance', $equip_update_array);
        //  echo 'oohoohohoho';
        //   $this->RegisterStandards($reqid);
    }

    public function base_params($data) {
        $data['title'] = "Chromatographic Conditions";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "Chromatographic Conditions";
        $data['link'] = "settings_management";
        $this->load->view('template', $data);
    }

    public function test() {
        $id = $this->uri->segment(3);
        $standardsData = Refsubs::getQuantity2($id);
        echo $oldStandardQty = $standardsData[0]['init_mass'];
        echo $standardUnit = $standardsData[0]['init_mass_unit'];
        //			$newStandardQty = $oldStandardQty - $standards_qty[$i];


        echo $newStandardQty;
    }

}

?>