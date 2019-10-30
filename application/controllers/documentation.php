<?php

class Documentation extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function Home() {
        $data['settings_view'] = 'documents_v';
        $data['documentation_data'] = $this->getData();
        $data['title'] = "Analyzed Samples";
        $this->base_params($data);
    }
    
    
      function rev_assigned() {
        $data['settings_view'] = 'documents_v_3';
        $data['documentation_data'] = $this->getReviewerData();
        $data['title'] = "Reviewer Assigned Samples";
        $this->base_params($data);
    }
    
       function rejected() {
                $data['settings_view'] = 'documents_v_reject';
        $data['title'] = "Reviewed Samples";
        $data['documentation_data'] = $this->getReviewedDataRejected();
        $this->base_params($data);
  
    }

    function reviewed() {
        $data['settings_view'] = 'documents_v_1';
        $data['title'] = "Reviewed Samples";
        $data['documentation_data'] = $this->getReviewedData();
        $this->base_params($data);
    }
    
    
    
      function reviewed_assigned() {
        $data['settings_view'] = 'documents_v_1_1';
        $data['title'] = "Reviewed Samples";
        $data['documentation_data'] = $this->getReviewerDataWithdraw();
        $this->base_params($data);
    }
    
     
      public function getReviewerDataWithdraw() {
        $query = $this->db->query("SELECT dir.*, r.product_name,CONCAT(u.title,' ',u.fname,' ', u.lname) as person 
		FROM directors dir, request r, user u 
		WHERE dir.folder = r.request_id 
		AND dir.director_id = u.id 
                AND dir.d_approve='0'
                 AND dir.approval_status='0'
		GROUP BY dir.folder ");
        return $result = $query->result();
        //print_r($result);
    }
    
     function s_logs() {
        $data['settings_view'] = 'documents_v_2_1';
        $data['title'] = "Received Samples Logs";
        $data['documentation_data'] = $this->getRData();
        $this->base_params($data);
    }
    
      function r_logs() {
        $data['settings_view'] = 'documents_v_2_1_1';
        $data['title'] = "Received Samples Logs";
        $data['documentation_data'] = $this->getReData();
        $this->base_params($data);
    }
    
    function withdraw($labref, $rev_id){
        $this->db->where('labref',$labref)->update('supervisor_approvals',array('assign_status'=>0)); 
        $this->db->where('folder',$labref)->where('reviewer_id',$rev_id)->delete('reviewer_worksheets');
        $withdraw = array(
            'labref'=>$labref,
            'date_action'=>date('d-m-Y'),
            'r_id'=>$rev_id,
            'status'=>'Withdrawn'
        );
        $this->db->insert('reviewer_log',$withdraw);
        $this->Withdrawing($labref, $this->getReviewerNameM($rev_id));
    }
    
     function withdraw_reassign($labref, $rev_id1,$id){
         $rev_id = str_replace("%20", "", $rev_id1);
        $data1 = $this->input->post('reviewer');
        $this->db->where('id',$id)->update('reviewer_worksheets',array('reviewer_id'=>$data1,'status'=>'0')); 
        $withdraw = array(
            'labref'=>$labref,
            'date_action'=>date('d-m-Y'),
            'r_id'=>$data1,
            'status'=>'Re-assigned'
        );
        $this->db->insert('reviewer_log',$withdraw);
        $this->Withdrawing($labref, $this->getReviewerNameM($rev_id));
        $this->Re_assign($labref, $data1);
    }
    
    
    
    
    function receive($labref){
        $current_user = $this->getPerson();
            $name = $current_user[0]->title ." ". $current_user[0]->fname." ".$current_user[0]->lname;  
        
        $this->db->insert(
                'documentation_receive_log',array('r_by'=>$name,'labref'=>$labref,'s_from'=>'Supervisor'));
        $this->db->where('labref',$labref)->update('supervisor_approvals',array('doc_rec_status'=>'1')); 
        
        redirect('documentation/home');
    }
    
     function Reviewer($labref){
        $current_user = $this->getPerson();
            $name = $current_user[0]->title ." ". $current_user[0]->fname." ".$current_user[0]->lname;  
        
        $this->db->insert(
                'documentation_receive_log',array('r_by'=>$name,'labref'=>$labref,'s_from'=>'Reviewer'));
        $this->db->where('labref',$labref)->update('reviewer_documentation',array('doc_rec_status'=>'1')); 
        
        redirect('documentation/reviewed/');
    }
    
    
   public function getPerson() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select("title,lname, fname");
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function rejectedAnalysedSamples() {
        $data['settings_view'] = 'documents_r';
        $data['title'] = "Rejected Analysed Samples";
        $data['documentation_data'] = $this->getReviewedData();
        $this->base_params($data);
    }

    function rejectedReviewedSamples() {
        $data['settings_view'] = 'documents_r_1';
        $data['title'] = "Rejected Reviewed Samples";
        $data['documentation_data'] = $this->getReviewedData();
        $this->base_params($data);
    }
	
	function remove_sample($labref){
		$this->db->where('labref',$labref)->delete('reviewer_documentation');
	}

    function rejectedDirectedSamples() {
        $data['settings_view'] = 'documents_r_2';
        $data['title'] = "Rejected Samples From Director";
        $data['documentation_data'] = $this->getReviewedData();
        $this->base_params($data);
    }

    function fromDirector() {
        $data['settings_view'] = 'documents_v_director';
        $data['title'] = "Sample From Director";
        $data['documentation_data'] = $this->getDataFromDirector();

        $this->base_params($data);
    }
    
    
    function getReviewersArray(){
		$this->db->select('u.title,u.fname as fname, u.lname as lname, u.id as id');
        $this->db->from('user u');
        $this->db->join('users_types as us', 'us.email = u.email', 'left');
        $this->db->where('us.usertype_id = 8');
		$this->db->or_where('us.usertype_id = 30');
		
        $query = $this->db->get()-> result_array();
		echo json_encode($query);
	}
        
        function returnCOA($id,$labref){
            if($id=='115'){
                $this->db->where('director_id',$id)->where('folder',$labref)->update('directors',array('d_approve'=>'0'));
                $this->db->where('labref',$labref)->delete('directors_say');
            }else{
                $this->db->where('director_id','115')->where('folder',$labref)->update('directors',array('approval_status'=>'0','director_id'=>$id,'d_approve'=>'0'));
                            $this->db->where('labref',$labref)->delete('directors_say');
                            

                
            }
        
            
        }
    
	
	 function archive() {
        $data['settings_view'] = 'documents_v_archive';
        $data['title'] = "Archived COA";
        $data['documentation_data'] = $this->getDataFromArchive();

        $this->base_params($data);
    }

    public function getData() {
        $query =  $this->db->query("SELECT DISTINCT sa.*,r.product_name
		FROM supervisor_approvals sa,  request r 
		WHERE sa.labref = r.request_id 
		AND sa.assign_status='0'
		GROUP BY sa.test_product,sa.labref
         ");
      //  $user_id = $this->session->userdata('user_id');     
        //$this->db->where('assign_status', 0);
       // $query = $this->db->get('supervisor_approvals');
        return $result = $query->result();
        //  print_r($result);
    }

    public function getReviewedData() {
		$query = $this->db->query("SELECT  rd.*,r.product_name
		FROM reviewer_documentation rd,  request r 
		WHERE rd.labref = r.request_id 
		AND rd.assign_status='0'
		
		GROUP BY rd.labref");
        //$query = $this->db->where('assign_status','0')->order_by('id', 'DESC')->group_by('labref')->get('reviewer_documentation');
        return $result = $query->result();
        //print_r($result);
    }
    
      public function getReviewerData() {
        $query = $this->db->query("SELECT rw.*, r.product_name,CONCAT(u.title,' ',u.fname,' ', u.lname) as person 
		FROM reviewer_worksheets rw, request r, user u 
		WHERE rw.folder = r.request_id 
		AND rw.reviewer_id = u.id 
                AND rw.status='0'
		GROUP BY rw.folder , rw.reviewer_id");
        return $result = $query->result();
        //print_r($result);
    }
    
    function rev_history($labref){
        echo json_encode($this->db->query("SELECT rl.*, CONCAT(u.title,' ',u.fname,' ', u.lname) as person FROM reviewer_log rl, user u WHERE rl.r_id = u.id AND  rl.labref='$labref'")->result());
    }
    
      public function getReData() {
        $query = $this->db->query("SELECT d.*, s.reviewer_name AS supervisor_name FROM documentation_receive_log d, reviewer_documentation s WHERE d.s_from='Reviewer' AND d.labref=s.labref GROUP BY d.labref ORDER BY d.id ASC");
        return $result = $query->result();
        //print_r($result);
    }
    
     public function getRData() {
        $query = $this->db->query("SELECT d.*, s.supervisor_name FROM documentation_receive_log d, supervisor_approvals s WHERE d.s_from='Reviewer' AND d.labref=s.labref GROUP BY d.labref ORDER BY d.id ASC");
        return $result = $query->result();
        //print_r($result);
    }
    
    
    public function getReviewedDataRejected() {
        $query = $this->db->where('reject_status','1')->order_by('id', 'DESC')->group_by('labref')->get('reviewer_documentation');
        return $result = $query->result();
        //print_r($result);
    }

    public function getDataFromDirector() {
	  $this->db->select('*, folder as labref');
        $this->db->group_by('labref');
	$this->db->where('d_approve','1');
        $query = $this->db->get('directors');
        return $result = $query->result();
    }
	
	  public function getDataFromArchive() {
        $this->db->group_by('labref');		
		$this->db->where('status','1');
        $query = $this->db->get('directors_say');
        return $result = $query->result();
    }


    public function getDepatmentName() {
        $department_id = $this->getDepatmentId();
        $department_iid = $department_id[0]->department_id;
        $this->db->select('name');
        $this->db->where('id', $department_iid);
        $query1 = $this->db->get('departments');
        $result = $query1->result();
    }

    public function getWorksheets() {

        $this->db->select('*');
        $this->db->where('assign_status', 0);
        $query = $this->db->get('files');

        foreach ($query->result() as $value) {
            $data[] = $value;
        }
        return $data;
    }

    /* public function getFolderRef() {
      $this->db->select('nqcl_number');
      $this->db->group_by('nqcl_number', 0);
      $query = $this->db->get('files');

      foreach ($query->result() as $value) {
      $data[] = $value;
      }
      return $data;
      } */

    public function getDepatmentId() {
        $sesssion = $this->session->userdata('user_id');
        $this->db->select('department_id');
        $this->db->where('id', $sesssion);
        $query1 = $this->db->get('user');
        return $result = $query1->result();
    }

    public function generateCOA($offset = 0) {
        $filename = $this->uri->segment(3);
        $data['head'] = 'CERTIFICATE OF ANALYSIS';
        $data['cert_no'] = 'CERTIFICATE No: CAN/' . date('Y') . '/';
        $html1 = $this->load->view('welcome_message', $data, true);
        $html = $html1;
        $this->dompdf_lib->createPDF($html, 'myfilename');
    }

    function getRequestInformation($labref) {
        $this->db->from('request r');
        $this->db->join('clients c', 'r.client_id = c.id');
        $this->db->where('r.request_id', $labref);
        $this->db->limit(1);
        $query = $this->db->get();
        $Information = $query->result();
        return $Information;
    }

    function getRequestedTests($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $query = $this->db->get();
        $result = $query->result();
        $output = array_map(function ($object) {
            return $object->name;
        }, $result);
        return $tests = implode(', ', $output);
    }
	
	function getlastplace($labref, $location=''){
		$query = $this->db
		->where('labref',$labref)
		->order_by('id','ASC')
		->limit(1)
		->get('tracking_table')
		->result();
		
		echo json_encode($query);
	}

    public function base_params($data) {

        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}
