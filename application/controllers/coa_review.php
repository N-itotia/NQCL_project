<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Coa_Review extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
	
	function return_coa(){
		
	}
	
	function remove(){
		$ids = $this->input->post('ids');
		foreach($ids as $i):
		$this->db->where('id',$i)->update('directors',array('approval_status'=>1));
		endforeach;
		redirect('coa_review/draft_coa_review');
	}
    
   public function draft_coa_review() {
        error_reporting(1);
      //  $data['labref'] = $this->getLabreferences();
        $data['worksheets'] = $this->worksheets();
        $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['settings_view'] = 'director_v_2';
        $this->base_params($data);
    }
      public function draft_coa_review_app() {
        error_reporting(1);
      //  $data['labref'] = $this->getLabreferences();
        $data['worksheets'] = $this->worksheets2();
        $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['settings_view'] = 'director_v_2';
        $this->base_params($data);
    }
	
	    public function finalized_coa() {
        error_reporting(1);
      //  $data['labref'] = $this->getLabreferences();
        $data['worksheets'] = $this->worksheets3();
        $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['settings_view'] = 'final_coa_v';
        $this->base_params($data);
    }
	
	function rfc($labref,$rid){
			$reason = $this->input->post('worksheet');
			$rev = $this->input->post('director');
		$this->db->where('id',$rid)->delete('directors');
		$this->db->where('folder',$labref)->update('reviewer_worksheets',array('status'=>0,'reason'=>$reason,'reviewer_id'=>$rev));
		redirect('coa_review/draft_coa_review');
	}
	
	
	 public function worksheets3() {
        $reviewer_id = $this->session->userdata('user_id');
   
       $query= $this->db->query("SELECT d.*, r.product_name 
FROM directors d, request r

WHERE d.folder = r.request_id AND d_approve='1'
AND time_done > '05-05-2015'

GROUP BY d.folder");       
        foreach ($query->result() as $folders) {
            $folder[] = $folders;
        }
        return $folder;
    }
    
    
        public function worksheets() {
        $reviewer_id = $this->session->userdata('user_id');
   
       $query= $this->db->query("SELECT d.*, r.product_name, r.invoice_status
FROM directors d, request r
WHERE d.director_id = '$reviewer_id'
AND d.folder = r.request_id
AND d.approval_status = 0 
GROUP BY d.folder");       
        foreach ($query->result() as $folders) {
            $folder[] = $folders;
        }
        return $folder;
    }
    
        public function worksheets2() {
        $reviewer_id = $this->session->userdata('user_id');
   
        $this->db->where('director_id', $reviewer_id);
        $this->db->where('approval_status', 1);
        //$this->db->or_where('reject_status', 0);
        $this->db->group_by('folder');
        $query = $this->db->get('directors');
        foreach ($query->result() as $folders) {
            $folder[] = $folders;
        }
        return $folder;
    }
    
        public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "COA Review ";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        //$data['banner_text'] = "NQCL Settings";
        //$data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}

