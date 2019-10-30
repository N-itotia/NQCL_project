<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MY_Issues extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function template_loader($data){          
       $this->load->view('issues_v/template',$data);
          
                
    }

}
