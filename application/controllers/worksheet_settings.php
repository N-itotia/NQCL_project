<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Worksheet_settings extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
  
        $data['settings_view'] = 'settings_wk'; 
        $data['last']= $this->get_max();
        $this->base_params($data);
    }
    
    function get_max(){
        return $this->db->select_max('worksheet_no')->get('worksheets_excel')->result();
    }

    
    
    
    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "Assay: Sample - " . $labref;
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

