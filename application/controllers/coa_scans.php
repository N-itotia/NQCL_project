<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Coa_Scans extends MY_Controller{

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        $data['settings_view'] ='coa_scans_v';
		$data['req']=$this->load();
        $this->base_params($data);
        
    }
	function load(){
		return $this->db->select('request_id')->get('request')->result();
	}
    
    public function upload_file() {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';
  $name =$this->input->post('title');
                    $labref =$this->input->post('labref');
        if ($status != "error") {
            $config['upload_path'] = 'coa_scans_files/';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;
			 $config['file_name'] = $labref;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $image_path = $data['full_path'];
                 $file_ext = $data['file_ext'];
                 $fname = $data['orig_name'];
                if (file_exists($image_path)) {
                  
                    $this->insert_file($labref, $fname, $name);
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    
        public function insert_file($labref, $filename, $title)
    {
        $data = array(
            'labref' =>$labref,
            'filename'      => $filename,
            'title'         => $title
        );
        $this->db->insert('coa_scans', $data);
        
    }
    
    function delete($id){
        $this->db->where('filename',$id)->delete('coa_scans'); 
        unlink('coa_scans_files/'.$id);
    }
    
     public function requests_list() {
        $request = $this->db->query("SELECT cs.*, r.product_name FROM coa_scans cs, request r WHERE cs.labref=r.request_id ")->result();
        if(!empty($request)){
            foreach ($request as $r) {
                $data[] = $r;
            }
            echo json_encode($data);
        }
        else{
            echo "[]";
        }
    }
	
	function coa_number($labref){
	echo json_encode($this->db->select('CAN')->where('request_id',$labref)->get('request')->result());	
	}
     

    public function base_params($data) {
        
        $data['title'] = "COA SCANS MANAGEMENT ";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";    

        $this->load->view('template', $data);
    }

}
