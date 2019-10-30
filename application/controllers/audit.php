<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Audit extends CI_Controller {

    function __construct() {
        parent::__construct();   
    }
    
    function getAuditData($labref,$column,$post){
        $new_data = $this->input->post($post);
        $data = $this->db->select($column)->where('request_id',$labref)->get('request')->result();
        if(trim($data[0]->$column) === trim($new_data)):
            echo 'No Change';
        else:
            $change_log = array(
                'field_changed'=>  strtoupper($column),
                'from_what'=>$data[0]->$column,
                'to_what'=>$new_data,
                'date_time'=>date('d-m-Y H:i:s'),
                'user'=>  $this->session->userdata('user_id'),
                'labref'=>$labref
                );
                $this->db->insert('coa_changelog',$change_log);
            
            echo 'Change Detected <br> Old Data: '.$data[0]->$column ." -> New Data: ". $new_data;
        
        endif;
        
        
    }
    
       function getAuditDataBottom($labref,$id,$column,$post){
        $new_data = $this->input->post($post);
        $data = $this->db->select($column)->where('labref',$labref)->where('test_id',$id)->get('coa_body')->result();
        if(trim($data[0]->$column) === trim($new_data)):
            echo 'No Change';
        else:
            
               $change_log = array(
                'field_changed'=>  strtoupper($column),
                'from_what'=>$data[0]->$column,
                'to_what'=>$new_data,
                'date_time'=>date('d-m-Y H:i:s'),
                'user'=>  $this->session->userdata('user_id'),
                'labref'=>$labref,
                'test_id'=>$id
                );
        $count = $this->check_record($labref, $column, $new_data);
        if($count > 0):
            echo 'New Data already logged';
            else:
                $this->db->insert('coa_changelog',$change_log);
            echo 'Change Detected <br> Old Data: '.$data[0]->$column ." -> New Data: ". $new_data;
        endif;
            
        
        endif;
        
        
    }
    
    function check_record($labref,$column,$new_data){
         return $this->db
                 ->select('field_changed')
                 ->where('labref',$labref)
                 ->where('field_changed',$column)
                 ->where('to_what',$new_data)
                 ->get('coa_changelog')
                 ->num_rows();
    }
    
    function showme(){
        echo trim('BP 2016 Vol. V App XII C 123 fdf');
    }
    
    
   
}
    



