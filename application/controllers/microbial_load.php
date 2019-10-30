<?php
include APPPATH . 'third_party/FPDF/fpdf17/fpdf.php';
include APPPATH . 'third_party/FPDF/FPDI/fpdi.php';
class Microbial_load extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function worksheet() {
         $data['labref'] = $labref= $this->uri->segment(3);
        $data['test_id'] =$test_id= $this->uri->segment(4);
        $data['worksheet_anme']=  $this->uri->segment(1);
        $data['micro_number']=  $this->getMicroNumber($labref);
        $data['settings_view'] = "microbial_load_v";
        $data['active']=  $this->getActiveIng($labref);
         $data['date']=  $this->findthedate($labref,$test_id);
        $this->base_params($data);
    }
     function getActiveIng($labref){
        return $this->db->select('name')->where('request_id',$labref)->get('components')->result();
    }
    function findthedate($labref,$test_id){
     return $this->db->select('created_at')->where('lab_ref_no',$labref)->where('test_id',$test_id)->get('sample_issuance')->result();

    }

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 14);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('sample_issuance')->result();
        return $result = $query[0]->do_count;
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
    
    function updateMicrobialLoad($labref,$r,$test_id){
        $analyst_id = $this->session->userdata('user_id'); 
                $component = $this->input->post('pname');

        $microlab = $this->input->post('micro_no');
        $date_rec = $this->input->post('date_received');
        $date_set = $this->input->post('date_set');
        $date_of_results = $this->input->post('date_of_result');
        $smp = $this->input->post('smp');
        $unit = $this->input->post('unit');
        $dilent = $this->input->post('diluent');
        $v1 = $this->input->post('v1');
        $p1 = $this->input->post('p1');
        $v2 = $this->input->post('v2');
        $plating = $this->input->post('plating');
        $replicate = $this->input->post('replicate');
        $average1 = $this->input->post('average1');
        $average2 = $this->input->post('average2');
        $average12 = $this->input->post('average12');
        $conclusion = $this->input->post('radio');
    
        $cfu = $this->input->post('cfu-1');
        $cfu1 = $this->input->post('cfu1');
        
         $last_id = $this->db->query("SELECT `id` FROM `microbial_load_body` WHERE `labref`='$labref' AND `repeat_status`='$r' ORDER BY id ASC limit 1 ")->result();

    $start_id = $last_id[0]->id;
       for ($i = 0; $i < count($cfu); $i++) {
            $cfus = array(
                'cfu' => $cfu[$i],
                'cfu1' => $cfu1[$i],
                'labref' => $labref,
                'component' => $component,
                
            );
            $this->db->where('labref',$labref)->where('id',$start_id)->update('microbial_load_body', $cfus);
            $start_id++;
        }



        $microbial_load_data = array(
                    'labref'=>$labref,
                    'component'=>$component,               
                    'micro_number'=>$microlab,
                    'date_recieved'=>$date_rec,
                    'date_test_set'=>$date_set,
                    'date_of_results'=>$date_of_results,
                    'smp'=>$smp,
                    'unit'=>$unit,
                    'diluent'=>$dilent,          
                    'v1'=>$v1,
                    'p1'=>$p1,
                    'v2'=>$v2,
                    'plating'=>$plating,
                    'replicate'=>$replicate,
                    'average1'=>$average1,
                    'average2'=>$average2,
                    'average12'=>$average12,
                    'conclusion'=>$conclusion,
                    
        );
        // $this->output->enable_profiler();
          $this->db->where('labref',$labref)->where('repeat_status',$r)->update('microbial_load_top', $microbial_load_data); 
   
        
          $this->deletePDFgen($labref, $test_id, $analyst_id);
          $pdf_name=$labref.'_microbial_load';
          $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
          $this->RegisterMIcrobialLoad($labref,$r);

         
        }

    public function save() {

   $labref = $this->uri->segment(3);
        $max_row_id = $this->getDisRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
        $analyst_id = $this->session->userdata('user_id');
           $component = $this->input->post('pname');
          $max_component_row_id = $this->getDissComponentNo($labref, $component);
        $new_component = $max_component_row_id;
 
        $component_no = $new_component;
     
        $microlab = $this->input->post('micro_no');
        $date_rec = $this->input->post('date_received');
        $date_set = $this->input->post('date_test_set');
        $date_of_results = $this->input->post('date_of_result_determined');
        $smp = $this->input->post('smp');
        $unit = $this->input->post('unit');
        $dilent = $this->input->post('diluent');
        $v1 = $this->input->post('v1');
        $p1 = $this->input->post('p1');
        $v2 = $this->input->post('v2');
        $plating = $this->input->post('plating');
        $replicate = $this->input->post('replicate');
        $average1 = $this->input->post('average1');
        $average2 = $this->input->post('average2');
        $average12 = $this->input->post('average12');
        $conclusion = $this->input->post('radio');
    
        $cfu = $this->input->post('cfu-1');
        $cfu1 = $this->input->post('cfu1');
        
  




        for ($i = 0; $i < count($cfu); $i++) {
            $cfus = array(
                'cfu' => $cfu[$i],
                'cfu1' => $cfu1[$i],
                'labref' => $labref,
                'component' => $component,
                'component_no' => $component_no,
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id,
            );
            $this->db->insert('microbial_load_body', $cfus);
        }



        $microbial_load_data = array(
                    'labref'=>$labref,
                    'component'=>$component,
                    'component_no'=>$component_no,
                    'repeat_status'=>$new_status,
                    'analyst_id'=>$analyst_id,
                    'micro_number'=>$microlab,
                    'date_recieved'=>$date_rec,
                    'date_test_set'=>$date_set,
                    'date_of_results'=>$date_of_results,
                    'smp'=>$smp,
                    'unit'=>$unit,
                    'diluent'=>$dilent,          
                    'v1'=>$v1,
                    'p1'=>$p1,
                    'v2'=>$v2,
                    'plating'=>$plating,
                    'replicate'=>$replicate,
                    'average1'=>$average1,
                    'average2'=>$average2,
                    'average12'=>$average12,
                    'conclusion'=>$conclusion,
                    
        );
        // $this->output->enable_profiler();
         $this->db->insert('microbial_load_top', $microbial_load_data);
       //  $this->output->enable_profiler();

       //$this->Returning_to_Supervisor($labref);
         $this->updateSampleIssuance();
          $this->updateTestIssuanceStatus();
          $this->updateSampleSummary();
          $this->post_posting();
          $this->save_test();
          $test_id=  $this->uri->segment(4);
          $this->deletePDFgen($labref, $test_id, $analyst_id);
          $pdf_name=$labref.'_microbial_load';
          $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
          $this->updateUploadStatus($labref, $test_id);
          $this->RegisterMIcrobialLoad($labref,$new_status);
          //$this->updateTabsCapsCOADetails($labref);
          //$sql1 = "UPDATE worksheets SET comment='$comment' WHERE labref='$labref'";
          //$j = mysql_query($sql1); */



     // redirect('analyst_controller');
    }
    function getMLtop($labref,$r){
        $a_id = $this->session->userdata('user_id');
        return $this->db
                ->where('labref',$labref)
                ->where('repeat_status',$r)
                ->where('analyst_id',$a_id)
                ->get('microbial_load_top')
                ->result();
    }
       function getMLbot($labref,$r){
        $a_id = $this->session->userdata('user_id');
        return $this->db
                ->where('labref',$labref)
                ->where('repeat_status',$r)
                ->where('analyst_id',$a_id)
                ->get('microbial_load_body')
                ->result();
    }
    
     function RegisterMIcrobialLoad($labref,$r) {
        if (file_exists('samplepdfs/'.$labref.'_microbial_load.pdf')) {
            unlink('samplepdfs/'.$labref.'_microbial_load.pdf');
        } else {
           // echo 'Not found';
        }
   
        $mlt = $this->getMLtop($labref,$r);
        $mlb = $this->getMLbot($labref,$r);

        $full_name = 'samplepdfs/microbial_count.pdf';     
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
            
            //chromatographic conditions assay
          $pdf->SetXY(40, 52);
          $pdf->Write(1, $mlt[0]->micro_number);
          $pdf->SetXY(90, 52);
          $pdf->Write(1, $mlt[0]->date_recieved);
          $pdf->SetXY(128, 52);
          $pdf->Write(1, $mlt[0]->date_test_set);
          $pdf->SetXY(165, 52);
          $pdf->Write(1, $mlt[0]->date_of_results);
          
          
          
            $pdf->SetFont('Arial');
            $pdf->SetXY(45, 80);
            $pdf->Write(1, $mlt[0]->smp .$mlt[0]->unit);
            
            $pdf->Line(40, 85, 60, 85);
            
            $pdf->SetXY(43, 90);
            $pdf->MultiCell(100,1, $mlt[0]->v1 . 'ml ' . $mlt[0]->diluent,0,'L');
            
            $pdf->SetXY(63, 85);
            $pdf->Write(1, 'X');
            
            
            $pdf->SetFont('Arial');
            $pdf->SetXY(78, 80);
            $pdf->Write(1, $mlt[0]->p1 . 'ml' );
            
            $pdf->Line(70, 85, 90, 85);
            
            $pdf->SetXY(73, 90);
            $pdf->MultiCell(100,1, $mlt[0]->v2 . 'ml ' .$mlt[0]->diluent,0,'L');
            
            $pdf->SetXY(93, 85);
            $pdf->Write(1, 'X');
            
            $pdf->SetFont('Arial');
            $pdf->SetXY(105, 80);
            $pdf->Write(1, '1' . 'ml' );
            
            $pdf->Line(100, 85, 115, 85);
            
            $pdf->SetXY(99, 90);
            $pdf->MultiCell(100,1, $mlt[0]->plating .'ml  Plating',0,'L');
            
            
            $pdf->SetFont('Arial');
            $pdf->SetXY(130, 85);
            $pdf->Write(1, 'Replicates: '.$mlt[0]->replicate  );
            
          
           
        
    
          
           $pdf->SetFont('Arial');
            $pdf->SetXY(128, 120);
            $pdf->Write(1, $mlb[0]->cfu);
            $pdf->SetXY(170, 120);
            $pdf->Write(1, $mlb[0]->cfu1);          
           
            $pdf->SetXY(128, 128);
            $pdf->Write(1, $mlb[1]->cfu);
            $pdf->SetXY(170, 128);
            $pdf->Write(1, $mlb[1]->cfu1);        
            
            $pdf->SetFont('Arial', 'B'); 
            $pdf->SetXY(128, 136);
            $pdf->Write(1, $mlb[2]->cfu);
            $pdf->SetXY(170, 136);
            $pdf->Write(1, $mlb[2]->cfu1);
            
             $pdf->SetFont('Arial');
            $pdf->SetXY(128, 150);
            $pdf->Write(1, $mlb[3]->cfu);
            $pdf->SetXY(170, 150);
            $pdf->Write(1, $mlb[3]->cfu1); 
            
            $pdf->SetXY(128, 158);
            $pdf->Write(1, $mlb[4]->cfu);           
            $pdf->SetXY(170, 158);
            $pdf->Write(1, $mlb[4]->cfu1);
           
            $pdf->SetXY(128, 166);
            $pdf->Write(1, $mlb[5]->cfu);           
            $pdf->SetXY(170, 166);
            $pdf->Write(1, $mlb[5]->cfu1);
           
            $pdf->SetFont('Arial', 'B');
            $pdf->SetXY(128, 174);
            $pdf->Write(1, $mlb[6]->cfu);
            $pdf->SetXY(170, 174);
            $pdf->Write(1, $mlb[6]->cfu1);

            if($mlt[0]->conclusion =='No Microbial Count'){
            $pdf->SetXY(70, 196);
            $pdf->Write(1, 'Yes'); 
            }else{
            $pdf->SetXY(70, 206);
            $pdf->Write(1, 'No');   
            }




            /*   $xa=1;
            $ya=(int)172;
                $pdf->SetFontSize(10);
           for($s=0; $s<count($standards);$s++){

            $pdf->SetXY(38, $ya+=7);
            $pdf->Write(1, $standards[$s]->name);
            
            $pdf->SetXY(115, $ya);
            $pdf->Write(1, $standards[$s]->rs_code);
            
            $pdf->SetXY(160, $ya);
            $pdf->Write(1, round($standards[$s]->potency,4));
            
              
            }
          * */
          
       





            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/'.$labref.'_microbial_load.pdf', 'F');
    
        echo 'Done';
    }
    
    

    
    public function getDissComponentNo($labref, $component) {

        $query = $this->db->query("SELECT MAX( component_no ) as component_number , component
                                    FROM `microbial_load_top`
                                    WHERE labref = '$labref' AND component='$component'");
        $row = $query->result();

        $mydata = $row[0]->component_number;
        if (empty($mydata)) {
            $query = $this->db->select_max('component_no')
                    ->where('labref', $labref)
                    ->get('microbial_load_top')
                    ->result();
            $row_data = $query[0]->component_no + 1;
            return $mydata = $row_data;
        } else {
            return $mydata;
        }
    }
    
    
    function getDataA($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('microbial_load_body')->result();
    }
     function getDataB($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('microbial_load_top')->result();
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);

        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 14);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);

        $this->comparetToDecide($labref);
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        $posts = array(
            'labref' => $labref,
            'component' => 'microbial_load',
            'component_no' => '0',
            'test_name' => 'microbial_load',
            'date_time' => date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $posts);
    }

    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'microbial_load');
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
            'test_name' => 'microbial_load',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'microbial_load_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
    }

       function updateSampleSummary() {
        $labref = $this->uri->segment(3);
        $data = array(
      
           'method' => 'Microbial Load'
        );
        $this->db->where('test_id', 14);
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
        $query = $this->db->get('microbial_load_top');
        return $row = $query->result();
    }

    public function microbial_load_r() {
           $data['test_name']=$module = $this->uri->segment(1);
         $data['test_id'] =  $this->uri->segment(6);
        $data['analyst_id'] =  $this->uri->segment(7);
        $data['test'] =  $this->uri->segment(8);
        $module = $this->uri->segment(2);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['edit'] = $c = $this->uri->segment(5);
        $data['c'] = $c = $this->uri->segment(6);
        $data['test_id'] = $c = $this->uri->segment(7);
        $data['done'] = $this->checkApproval('microbial_load_r', $labref, $r, $c);
        $data['comspe'] = $this->findComSpec($labref);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        $this->session->set_userdata('mail_name', $new);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        $data['s_data']=  $this->getDataA($labref ,$r);       
        $data['b_data']=  $this->getDataB($labref ,$r);       
       // print_r( $data['b_data']);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'microbial_load_r_v';
        $this->base_params($data);
    }
    function findComSpec($labref){
        return $this->db->where('labref',$labref)->where('test_id',14)->get('coa_body')->result();
    }
    

    function getDisintegrationData($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('microbial_load')
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
            'test_name' => 'microbial_load',
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
        $this->db->where('test_name', 'microbial_load');
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
        $this->db->where('test_name', 'microbial_load');

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
        $component= $this->input->post('pname');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component',$component);
        $query = $this->db->get('microbial_load_top');
        return $row = $query->result();
        // print_r($row);  
    }

    function repeats($labref) {
        echo json_encode(
                $this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->get('microbial_load_top')
                        ->result()
        );
    }

    public function base_params($data) {
        $data['title'] = "Microbial Load";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
