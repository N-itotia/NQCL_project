<?php

class Reviewer extends MY_Controller {

    function __construct() {
        parent::__construct();
        }
		
		function revewerSubmissionReport($month,$year){
			$user_id  =$this->session->userdata('user_id');
			$data['samples']=$this->get($month,$year);
			$data['user']=$this->getUsersInfo();
            $this->load->view('reviewer_report',$data);
			
			}
			
			function get($month,$year){
				$id=$this->session->userdata('user_id');
				$q= $this->db->query(
				"SELECT p.product_name, rw.labref 
				FROM request p, reviewer_report rw
				WHERE p.request_id=rw.labref 
				AND date_added BETWEEN '$month' AND '$year'
				AND rw.reviewer_id=$id 
				GROUP BY rw.labref")
				->result();
				return $q;
			}
public function reviewe() {
   
    $data['labref']=  $this->getLabreferences();
    $data['worksheets']=  $this->worksheets();
    $data['reviewer_id']=  $this->session->userdata('user_id');
    $data['settings_view']='reviewer_v';
    $this->base_params($data);
   
}

public function index($uri='worksheets1') {
   
    $data['labref']=  $this->getLabreferences();
    $data['uri']=$uri;
   // $data['worksheets']=  $this->worksheets();
    $data['reviewer_id']=  $this->session->userdata('user_id');
    $data['settings_view']='reviewer_v_1';
    $this->base_params($data);
   
}

function get_Analyst($labref){
	$query = "SELECT analyst_id FROM sample_issuance WHERE lab_ref_no ='$labref'";
	$res = $this->db->query($query)->result();
	$user_id = $res[0]->analyst_id;
	$query2 = "SELECT CONCAT(title ,' ', fname,' ', lname) name FROM user WHERE id = '$user_id'";
	$res2 = $this->db->query($query2)->result();
	$person = $res2[0]->name;
	echo json_encode(array('id'=>$user_id,'analyst'=>$person));
}

public function approved_samples($uri='worksheets2') {
   
    $data['labref']=  $this->getLabreferences();
    $data['uri']=$uri;
   // $data['worksheets']=  $this->worksheets();
    $data['reviewer_id']=  $this->session->userdata('user_id');
    $data['settings_view']='reviewer_v_1';
    $this->base_params($data);
   
}


public function rejected_samples($uri='worksheets3') {
   
    $data['labref']=  $this->getLabreferences();
    $data['uri']=$uri;
   // $data['worksheets']=  $this->worksheets();
    $data['reviewer_id']=  $this->session->userdata('user_id');
    $data['settings_view']='reviewer_v_1';
    $this->base_params($data);
   
}

    function setStatus(){
        $ids = $this->input->post('ids');
        
        foreach ($ids as $id):
        $this->db->where('id',$id)->update('reviewer_worksheets',array('status'=>1));
        endforeach;
    }


   
     function make_oos($labref) {
        $this->db->where('request_id', $labref)->update('request', array('oos' => '1','oos_status'=>'1'));
          $this->db->where('labref', $labref)->update('tests_done', array('oos' => '1'));
          $this->delete_oos($labref);
          $this->Mark_As_OOS($labref);
      
    }
 
  
   
    function delete_oos($labref){
        $id=  $this->session->userdata('user_id');
        $this->db->where('folder',$labref)->where('reviewer_id',$id)->delete('reviewer_worksheets');
    }
   
       function make_oos_coa($labref) {
        $this->db->where('request_id', $labref)->update('request', array('oos' => '1','oos_status'=>'1'));
          $this->db->where('labref', $labref)->update('tests_done', array('oos' => '1'));
          $this->delete_oos_coa($labref);
          $this->Mark_As_OOS($labref);
        redirect('coa_review/draft_coa_review/');
    }
   
      function delete_oos_coa($labref){
        $id=  $this->session->userdata('user_id');
        $this->db->where('folder',$labref)->where('director_id',$id)->delete('directors');
    }
   
   
   



function reject($labref,$level){
    $this->db->where('folder',$labref);
    $this->db->update('reviewer_worksheets',array('status'=>'2'));
   
      $data1 = array(
            'a_stat' => '5',
           
        );
        $this->db->where('labref', $labref);
        $this->db->update('review_samples', $data1);
   
    $this->registerRejectionReason($labref,$level);
    $this->Rev_Rejection_COA($labref);
   // $this->updateAnalyst($labref);
    redirect('reviewer');
    }
	
	
	
	function rejectReviewer($labref,$level){
    $this->db->where('folder',$labref);
    $this->db->update('reviewer_worksheets',array('status'=>'2'));
   
      $data1 = array(
            'a_stat' => '5',
           
        );
        $this->db->where('labref', $labref);
        $this->db->update('review_samples', $data1);
		
		$dataw = array(
            'completion' => '0',
           
        );
		$this->db->where('lab_ref_no', $labref);
		$this->db->where('analyst_id', $this->input->post('person'));
        $this->db->update('sample_issuance', $dataw);
   
    $this->registerRejectionReason($labref,$level);
    $this->Rev_Rejection_COA($labref);
   // $this->updateAnalyst($labref);
    redirect('reviewer');
    }
   
    function reject_reason($labref,$level){
   echo json_encode(
   $this->db->select('reject_reason')->where('labref',$labref)->where('at_level',$level)->get('sample_rejection')->result()
          
           );
    }
   
   
   
   
   
    function updateAnalyst($labref){
            $this->db->where('lab_ref_no',$labref);
                $this->db->update('sample_issuance',array('status'=>'2'));

    }
 
   public function getLabreferences(){
        $user_id=$this->session->userdata('user_id');
        $this->db->select('folder,priority');
        $this->db->where('reviewer_id',$user_id);
        //$this->db->group_by('labref');
        $query=$this->db->get('reviewer_worksheets');
       
        if($query->num_rows()>0){
            foreach ($query->result() as $value) {
                $data[]=$value;
            }
        }
        return $data;
    }

public function samples_for_review() {
    $data['labref']=  $this->uri->segment(3);
        $data['reviewer_id']=  $this->session->userdata('user_id');
        $data['settings_view'] = 'samples_uploaded_view';
        $this->base_params($data);
    }

    function elfinder_init() {
        $reviewer_id=$this->session->userdata('user_id');
        $labref=$this->uri->segment(3);
        $this->load->helper('path');
        $opts = array(
            //'debug' => true,
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => './reviewers/'.$reviewer_id.'/'.date('Y').'/'.$labref,
                    'URL' => base_url() . '/reviewers/'.$reviewer_id.'/'.$labref,
                    'accessControl' => 'access',
                    'disabled' => array('edit', 'rename', 'cut', 'copy','delete','trash'),
                    'dotFiles' => false,
                    'tmbDir' => '_tmb',
                    'arc' => '7za',
                    'defaults' => array('read' => true, 'write' => false, 'rm' => false)
                ),
            ),
        );
        $this->load->library('elfinder_lib', $opts);
    }
  

    public function worksheets() {
    $reviewer_id=  $this->session->userdata('user_id');
  
    $this->db->where('reviewer_id',$reviewer_id);
 
    $query=  $this->db->where('status','0')->group_by('folder')->get('reviewer_worksheets');
	  
	foreach($query->result() as $folders){
		  $folder[]=$folders;
	  }
  
	//Check if returned result is empty or not 
	if(!empty($folder)){
		return $folder;
	}
	else{
		return '[]';
	}
	
}

    public function worksheets1() {
    $reviewer_id=  $this->session->userdata('user_id');
   
    $query=$this->db->query("SELECT rw.*, re.product_name, re.invoice_status, re.client_id
FROM reviewer_worksheets rw, request re
WHERE rw.folder = re.request_id
AND DATE_FORMAT(rw.time_done,'%Y') > 2014
AND rw.status ='0'
AND rw.reviewer_id = '$reviewer_id' GROUP BY rw.folder");
  
   // $this->db->where('reviewer_id',$reviewer_id);
 
   // $query=  $this->db->where('status','0')->group_by('folder')->get('reviewer_worksheets');
  foreach($query->result() as $folders){
      $folder[]=$folders;
  }
  if(empty($folder)){
	   echo '[]';
 
  }else{
     echo json_encode( $folder); 
  }
}


   public function worksheets2() {
    $reviewer_id=  $this->session->userdata('user_id');
   
    $query=$this->db->query("SELECT rw.*, re.product_name
FROM reviewer_worksheets rw, request re
WHERE rw.folder = re.request_id
AND rw.status='1'
AND reviewer_id = '$reviewer_id'");
  
    //$this->db->where('reviewer_id',$reviewer_id);
 
  //  $query=  $this->db->where('status','1')->group_by('folder')->get('reviewer_worksheets');
  foreach($query->result() as $folders){
      $folder[]=$folders;
  }
  if($folder!==''){
  echo json_encode( $folder);
  }else{
      echo '[]';
  }
}

   public function worksheets3() {
    $reviewer_id=  $this->session->userdata('user_id');
   
    $query=$this->db->query("SELECT rw.*, re.product_name
FROM reviewer_worksheets rw, request re
WHERE rw.folder = re.request_id
AND rw.status='2'
AND reviewer_id = '$reviewer_id'");
  
    //$this->db->where('reviewer_id',$reviewer_id);
 
  //  $query=  $this->db->where('status','1')->group_by('folder')->get('reviewer_worksheets');
  foreach($query->result() as $folders){
      $folder[]=$folders;
  }
  if($folder!==''){
  echo json_encode( $folder);
  }else{
      echo '[]';
  }
}
    public function base_params($data) {
        $data['title'] = "Review Page";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        //$data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}
