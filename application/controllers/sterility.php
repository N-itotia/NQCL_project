<?php
include APPPATH . 'third_party/FPDF/fpdf17/fpdf.php';
include APPPATH . 'third_party/FPDF/FPDI/fpdi.php';
class Sterility extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function worksheet() {
        $data['labref'] = $labref= $this->uri->segment(3);
        $data['test_id'] =$test_id= $this->uri->segment(4);
        $data['worksheet_name']=   $this->uri->segment(1);
        $data['active']=  $this->getActiveIng($labref);
        $data['settings_view'] = "sterility_v";
       $data['micro_number']=  $this->getMicroNumber($labref);
         $data['date']=  $this->findthedate($labref,$test_id);
        $this->base_params($data);
    }
    function check_done($labref,$component){
        $query= $this->db->where('labref',$labref)->where('component',$component)->get('sterility');
        if($query->num_rows()> 0){
           echo json_encode(array('done_state'=>1));
        }else{
          echo json_encode(array('done_state'=>0));
        }
    }
    
      public function getLabelPdf() {

        require_once("application/helpers/dompdf/dompdf_config.inc.php");

        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        $dompdf = new DOMPDF();
          
        $data['s_data']=  $this->getData($labref ,$r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $html = $this->load->view('sterility_v', $data, TRUE);

        $dompdf->load_html($html);
        $dompdf->render();
        write_file($labref.'_strility.pdf', $dompdf->output());
       
    }

    

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 9);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('sample_issuance')->result();
        return $result = $query[0]->do_count;
    }
    function getActiveIng($labref){
        return $this->db->select('name')->where('request_id',$labref)->get('components')->result();
    }
    function findthedate($labref,$test_id){
     return $this->db->select('created_at')->where('lab_ref_no',$labref)->where('test_id',$test_id)->get('sample_issuance')->result();

    }

    function updateSampleIssuance() {
        $do_status = $this->getDoStatus() + '1';
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', array('do_count' => $do_status));
    }
    
        public function saveEdit($labref,$r,$test_id) {       
            
        
        $analyst_id = $this->session->userdata('user_id');
     
        $microlab = $this->input->post('microlab_no');
        $date_rec = $this->input->post('date_rec');
        $date_set = $this->input->post('date_set');
        $date_of_results = $this->input->post('date_of_results');
        $micro = $this->input->post('qty');
        $measure = $this->input->post('measure');
        $methodology = $this->input->post('filtration');
        $sample_preparation = $this->input->post('sample_preparation');
        $sample_ = $this->input->post('sample_');
        $positive_control = $this->input->post('pc');
        $neg_control = $this->input->post('neg_control');
        $positive_sample_control = $this->input->post('psc');
        $sbda = $this->input->post('sbda');
        $snc = $this->input->post('snc');
        $comply = $this->input->post('comply');



        $samples = implode(", ", $sample_);
        $positive_controls = implode(", ", $positive_control);
        $neg_controls = implode(", ", $neg_control);
        $positive_sample_controls = implode(", ", $positive_sample_control);
        $sbdas = implode(", ", $sbda);
        $sncs = implode(", ", $snc);

        $samples_1 = explode(", ", $samples);
        $sample_top = $samples_1[0];
        $sample_bottom = $samples_1[1];

        $positive_control_all = explode(", ", $positive_controls);
        $bsubtilispc = $positive_control_all[0];
        $pareugonisapc = $positive_control_all[1];
        $bsabtiltdbpc = $positive_control_all[2];
        $calbicanspc = $positive_control_all[3];

        $neg_controls_all = explode(", ", $neg_controls);
        $neg_control_top = $neg_controls_all[0];
        $neg_control_btm = $neg_controls_all[1];
        
        $positive_sample_control_all = explode(", ", $positive_sample_controls);
        $bsubtilispsc = $positive_sample_control_all[0];
        $pareugonisapsc = $positive_sample_control_all[1];
        $bsabtiltdbpsc = $positive_sample_control_all[2];
        $calbicanspsc = $positive_sample_control_all[3];
        
        $sbdass = explode(", ", $sbdas);
        $sbds_top = $sbdass[0];
        $sbdas_btm = $sbdass[1];
        
        $sncss = explode(", ", $sncs);
        $sncs_top = $sncss[0];
        $sncs_btm = $sncss[1];



        $sterility_data = array(
               
                    'component'=>$this->input->post('pname'),            
                    'micro_number'=>$microlab,
                    'date_recieved'=>$date_rec,
                    'date_test_set'=>$date_set,
                    'date_of_results'=>$date_of_results,
                    'methodology'=>$methodology,
                    'sample_preparation'=>$sample_preparation,
                    'quantity_used'=>$micro,          
                    'sample_top'=>$sample_top,
                    'sample_bottom'=>$sample_bottom,
                    'bsubtilis_s'=>$bsubtilispc,
                    'paeruginosia'=>$pareugonisapc,
                    'bsubtilis_sb'=>$bsabtiltdbpc,
                    'calbicans'=>$calbicanspc,
                    'negcntrltop'=>$neg_control_top,
                    'negcntrlbottm'=>$neg_control_btm,
                    'bsubtilis_psc'=>$bsubtilispsc,
                    'paeruginosia_psc'=>$pareugonisapsc,
                    'bsubtilis_psc1'=>$bsabtiltdbpsc,
                    'calbicans_psc'=>$calbicanspsc,
                    'sbda1'=>$sbds_top,
                    'sbda2'=>$sbdas_btm,
                    'sbdanc1'=>$sncs_top,
                    'sbdanc2'=>$sncs_btm,
                    'conclusion'=>$comply,  
                    'measure'=>$measure,
                
        );
      $last_id = $this->db->query("SELECT `id` FROM `sterility` WHERE `labref`='$labref' AND `repeat_status`='$r' ORDER BY id ASC limit 1 ")->result();
        $id = $last_id[0]->id;
         $this->db->where('id',$id)->update('sterility', $sterility_data);
         
          //$this->deletePDFgen($labref, $test_id, $analyst_id);
          $pdf_name=$labref.'_sterility';
          $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
          $this->RegisterSterility($labref,$r);
        }

    public function save() {

        $labref = $this->uri->segment(3);
        $max_row_id = $this->getDisRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
        
            
        
        $analyst_id = $this->session->userdata('user_id');
        $component ='';
        $component_no ='';

        $microlab = $this->input->post('microlab_no');
        $date_rec = $this->input->post('date_rec');
        $date_set = $this->input->post('date_set');
        $date_of_results = $this->input->post('date_of_results');
        $micro = $this->input->post('qty');
        $measure = $this->input->post('measure');
        $methodology = $this->input->post('filtration');
        $sample_preparation = $this->input->post('sample_preparation');
        $sample_ = $this->input->post('sample_');
        $positive_control = $this->input->post('pc');
        $neg_control = $this->input->post('neg_control');
        $positive_sample_control = $this->input->post('psc');
        $sbda = $this->input->post('sbda');
        $snc = $this->input->post('snc');
        $comply = $this->input->post('comply');



        $samples = implode(", ", $sample_);
        $positive_controls = implode(", ", $positive_control);
        $neg_controls = implode(", ", $neg_control);
        $positive_sample_controls = implode(", ", $positive_sample_control);
        $sbdas = implode(", ", $sbda);
        $sncs = implode(", ", $snc);

        $samples_1 = explode(", ", $samples);
        $sample_top = $samples_1[0];
        $sample_bottom = $samples_1[1];

        $positive_control_all = explode(", ", $positive_controls);
        $bsubtilispc = $positive_control_all[0];
        $pareugonisapc = $positive_control_all[1];
        $bsabtiltdbpc = $positive_control_all[2];
        $calbicanspc = $positive_control_all[3];

        $neg_controls_all = explode(", ", $neg_controls);
        $neg_control_top = $neg_controls_all[0];
        $neg_control_btm = $neg_controls_all[1];
        
        $positive_sample_control_all = explode(", ", $positive_sample_controls);
        $bsubtilispsc = $positive_sample_control_all[0];
        $pareugonisapsc = $positive_sample_control_all[1];
        $bsabtiltdbpsc = $positive_sample_control_all[2];
        $calbicanspsc = $positive_sample_control_all[3];
        
        $sbdass = explode(", ", $sbdas);
        $sbds_top = $sbdass[0];
        $sbdas_btm = $sbdass[1];
        
        $sncss = explode(", ", $sncs);
        $sncs_top = $sncss[0];
        $sncs_btm = $sncss[1];



        $sterility_data = array(
                    'labref'=>$labref,
                    'component'=>$this->input->post('pname'),
                    'component_no'=>$component_no,
                    'repeat_status'=>$new_status,
                    'analyst_id'=>$analyst_id,
                    'micro_number'=>$microlab,
                    'date_recieved'=>$date_rec,
                    'date_test_set'=>$date_set,
                    'date_of_results'=>$date_of_results,
                    'methodology'=>$methodology,
                    'sample_preparation'=>$sample_preparation,
                    'quantity_used'=>$micro,          
                    'sample_top'=>$sample_top,
                    'sample_bottom'=>$sample_bottom,
                    'bsubtilis_s'=>$bsubtilispc,
                    'paeruginosia'=>$pareugonisapc,
                    'bsubtilis_sb'=>$bsabtiltdbpc,
                    'calbicans'=>$calbicanspc,
                    'negcntrltop'=>$neg_control_top,
                    'negcntrlbottm'=>$neg_control_btm,
                    'bsubtilis_psc'=>$bsubtilispsc,
                    'paeruginosia_psc'=>$pareugonisapsc,
                    'bsubtilis_psc1'=>$bsabtiltdbpsc,
                    'calbicans_psc'=>$calbicanspsc,
                    'sbda1'=>$sbds_top,
                    'sbda2'=>$sbdas_btm,
                    'sbdanc1'=>$sncs_top,
                    'sbdanc2'=>$sncs_btm,
                    'conclusion'=>$comply,  
                    'measure'=>$measure,
                
        );
        // $this->output->enable_profiler();
         $this->db->insert('sterility', $sterility_data);
       // $this->Returning_to_Supervisor($labref);
         $this->updatepSTOADetails($labref);
          $this->updateSampleIssuance();
          $this->updateTestIssuanceStatus();
          $this->updateSampleSummary();
          $this->post_posting();
          $this->save_test();
          $test_id=  $this->uri->segment(4);
           //$this->deletePDFgen($labref, $test_id, $analyst_id);
          $pdf_name=$labref.'_sterility';
          $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
          $this->RegisterSterility($labref, $new_status);
          $this->updateUploadStatus($labref, $test_id);
       



        redirect('analyst_controller');
    }
    
     function RegisterSterility($labref,$r) {
        if (file_exists('samplepdfs/'.$labref.'_sterility.pdf')) {
            unlink('samplepdfs/'.$labref.'_sterility.pdf');
        } else {
           // echo 'Not found';
        }
   
        $mlt = $this->getData($labref,$r);
       

        $full_name = 'samplepdfs/sterility.pdf';     
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

          $pdf->SetFont('Arial','B');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFontSize(9);
            
            //chromatographic conditions assay
          $pdf->SetXY(40, 53);
          $pdf->Write(1, $mlt[0]->micro_number);
          $pdf->SetXY(90, 53);
          $pdf->Write(1, $mlt[0]->date_recieved);
          $pdf->SetXY(128, 53);
          $pdf->Write(1, $mlt[0]->date_test_set);
          $pdf->SetXY(165, 53);
          $pdf->Write(1, $mlt[0]->date_of_results);
          
          
            if($mlt[0]->methodology =='Membrane Filtration'){
             $pdf->SetFont('Arial','B');
            $pdf->SetXY(92, 60);
            $pdf->Write(1, "MF"); 
            }else{
            $pdf->SetXY(92, 64);
            $pdf->Write(1, 'DI');   
            }
            
          $pdf->SetXY(128, 70);
          $pdf->Write(1, $mlt[0]->quantity_used ." ". $mlt[0]->measure);
          
           $pdf->SetFont('Arial');
          $pdf->SetXY(33, 90);
          $pdf->MultiCell(120,5, $mlt[0]->sample_preparation,0,'L');
          
          $pdf->SetFont('Arial','B');
            $pdf->SetFontSize(8);
          
          $pdf->SetXY(60, 130);
          $pdf->Write(1, $mlt[0]->sample_top);
          
          $pdf->SetXY(60, 147);
          $pdf->Write(1, $mlt[0]->sample_bottom);
          
          $pdf->SetXY(102, 125);
          $pdf->Write(1, $mlt[0]->bsubtilis_s);
          
          $pdf->SetXY(102, 135);
          $pdf->Write(1, $mlt[0]->paeruginosia);
          
           $pdf->SetXY(102, 142);
          $pdf->Write(1, $mlt[0]->bsubtilis_sb);
          
          $pdf->SetXY(102, 152);
          $pdf->Write(1, $mlt[0]->calbicans);
          
          
           $pdf->SetXY(128, 130);
          $pdf->Write(1, $mlt[0]->negcntrltop);
          
          $pdf->SetXY(128, 147);
          $pdf->Write(1, $mlt[0]->negcntrlbottm);
          
          
          $pdf->SetXY(177, 125);
          $pdf->Write(1, $mlt[0]->bsubtilis_psc);
          
          $pdf->SetXY(177, 135);
          $pdf->Write(1, $mlt[0]->paeruginosia_psc);
          
           $pdf->SetXY(177, 142);
          $pdf->Write(1, $mlt[0]->bsubtilis_psc1);
          
          $pdf->SetXY(177, 152);
          $pdf->Write(1, $mlt[0]->calbicans_psc);
          
             $pdf->SetXY(115, 188);
          $pdf->Write(1, $mlt[0]->sbda1);
          
          $pdf->SetXY(115, 196);
          $pdf->Write(1, $mlt[0]->sbda2);
          
           $pdf->SetXY(160, 188);
          $pdf->Write(1, $mlt[0]->sbdanc1);
          
          $pdf->SetXY(160, 196);
          $pdf->Write(1, $mlt[0]->sbdanc2);
          
      

            if($mlt[0]->conclusion =='No Microbial Growth'){
            $pdf->SetXY(70, 206);
            $pdf->Write(1, 'Yes'); 
            }else{
            $pdf->SetXY(70, 215);
            $pdf->Write(1, 'No');   
            }

       $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/'.$labref.'_sterility.pdf', 'F');
    
        echo 'Done';
    }
    
    

    
    
    
    function getData($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('sterility')->result();
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);

        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 9);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);

        $this->comparetToDecide($labref);
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        $posts = array(
            'labref' => $labref,
            'component' => 'sterility',
            'component_no' => '0',
            'test_name' => 'sterility',
            'date_time' => date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $posts);
    }

    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'sterility');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function save_test() {
        $labref = $this->uri->segment(3);
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;

        $data = $this->check_repeat_status();
        $r_status = $data[0]->repeat_status;
        $new_r_status = $r_status + 1;
        $analyst_id = $this->session->userdata('user_id');

        $final_test_done = array(
            'labref' => $labref,
            'test_name' => 'sterility',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'sterility_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency,
            'worksheet_status' => 1
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function updateSampleSummary() {
        $labref = $this->uri->segment(3);
        $data = array(
    
            'method' => $this->input->post('filtration')
        );
        $this->db->where('test_id', 9);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $data);
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
    }

    public function getDisintegrationTestRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('sterility');
        return $row = $query->result();
    }

    public function sterility_r() {
        
            $module_name = $this->uri->segment(1);
           $data['test_name']=$module = $this->uri->segment(1);
         $data['test_id'] =  $this->uri->segment(6);
        $data['analyst_id'] =  $this->uri->segment(7);
        $data['test'] =  $this->uri->segment(8);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['edit'] = $c = $this->uri->segment(5);
        $data['c'] = $c = $this->uri->segment(6);
        $data['done'] = $this->checkApproval('sterility_r', $labref, $r, $c);
        //$data['caps_results'] = $this->getCaps_v($labref, $r);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        $this->session->set_userdata('mail_name', $new);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        $data['s_data']=  $this->getData($labref ,$r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'sterility_r_v';
        $this->base_params($data);
    }

    function getDisintegrationData($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('sterility')
                        ->result();
    }

    function getAnalystData() {
        error_reporting(0);
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId_1($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
            $query = $this->db->get('analyst_supervisor');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }

    function getAnalystId_1($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function getUsername() {
        $this->db->select('analyst_name');
        $this->db->where('supervisor_id', $this->session->userdata('user_id'));
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
    }

    public function approve_data() {
        $labref = $this->uri->segment(3);
         $this->Returning_to_documentation($labref);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $supervisor_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorName();
        //print_r($supervisor);
        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;
        $analyst = $this->getAnalystName();
        $analyst_name = $analyst[0]->analyst_name;
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $approve_data = array(
            'supervisor_name' => $supervisor_name,
            'analyst_name' => $analyst_name,
            'labref' => $labref,
            'repeat_status' => $r,
            'test_name' => 'sterility',
            'component_no' => $c,
            'test_product' => 'formicrobiology',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency
        );
        $this->db->insert('supervisor_approvals', $approve_data);

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'sterility');
        $this->db->update('tests_done', array('approval_status' => '1'));


        $this->compareToDecide($labref);

        redirect('supervisors/home/' . $this->session->userdata('lab'));
    }

    public function approve() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'sterility');

        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            echo 'Already Approved';
        } else {
            $this->approve_data();
        }
    }

    public function getSupervisorName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('id', $supervisor_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getAnalystName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }

    function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }

    public function getDisRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('sterility');
        return $row = $query->result();
        // print_r($row);  
    }

    function repeats($labref) {
        echo json_encode(
                $this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->get('sterilityt')
                        ->result()
        );
    }

    public function base_params($data) {
        $data['title'] = "Sterility";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
