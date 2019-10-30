<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Custom_sheets extends MY_Controller {

   function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    function index() {
        $data['depts'] = $this->getDepts();
        $data['settings_view'] = 'w_creation_v_m_1';
        $data['sheets'] = $this->loadsheets();

        $this->base_params($data);
    }
    
    function connector(){
       $this->load->helper('path');
        $opts = array(
            //'debug' => true, 
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => './cwks/',
                    'URL' => base_url() . '/cwks/',
                    'accessControl' => 'access',
                   // 'disabled' => array('edit', 'rename', 'cut', 'copy', 'delete', 'trash'),
                    'dotFiles' => false,
                    'tmbDir' => '_tmb',
                    'arc' => '7za',
                    'defaults' => array('read' => true, 'write' => true, 'rm' => true)
                ),
            ),
        );
        $this->load->library('elfinder_lib', $opts); 
    }
    
        function repository(){
        $data['settings_view'] = 'main_repo';
       $this->base_params($data); 
    }
    
    function genericEdit($id){
       $data['sheets'] = $this->getSheet($id); 
       $data['name'] = $this->getSheetTitle($id); 
        $data['settings_view'] = 'w_creation_v_m_2';
         $this->base_params($data);
    }
    
       function excel() {
        $data['depts'] = $this->getDepts();
        $data['settings_view'] = 'w_creation_v_m_1_1';
        $data['sheets'] = $this->loadesheets();
        $data['tests']= $this->loadTests();
        $this->base_params($data);
    }
    
    function excel_edit($id) {
        $data['depts'] = $this->getDepts();
        $data['no']=$id;
        $data['settings_view'] = 'w_creation_v_m_1_1_2';
        $data['sheets'] = $this->loadesheetsE($id);
         $data['sheets1'] = $this->loadesheets();
        $data['tests']= $this->loadTests();
        $this->base_params($data);
    }
    
    
    
       function generic() {
        $data['depts'] = $this->getDepts();
        $data['sheet_no']=  $this->get_sheet_no();
         $data['last']= $this->get_max();
        $data['settings_view'] = 'w_creation_v_m_1_1_1';
        $data['sheets'] = $this->loadesheets();
        $data['tests']= $this->loadTests();
        $this->base_params($data);
    }
    
    function edit_sheet_number($number){
        $this->db->where('id','1')->update('wk_no_cell',array('number'=>  strtoupper($number)));
    }
	
	

     function get_max(){
        return $this->db->select_max('worksheet_no')->get('worksheets_excel')->result();
    }
    
    function generic_tests($id,$test_id){
       $results= $this->loadresults($id,$test_id);
               print"<pre>";
       print_r($results);
               print"</pre>";
        
    }

function loadTests(){
    return $this->db->get('tests')->result();
}

    function getDepts() {
        return $this->db->get('test_departments')->result();
    }

    function do_upload() {
        $w_name = $this->input->post('w_title');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "samplepdfs/" . $sname . '.pdf';
        if (file_exists($filename)) {
            $data['exists'] = $w_name . ' Already Exists';
            $data['depts'] = $this->getDepts();
            $data['sheets'] = $this->loadsheets();
            $data['settings_view'] = 'w_creation_v_m_1';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "samplepdfs";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'pdf';


            $this->load->library('upload', $config);        
             
            

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadsheets();
                $data['settings_view'] = 'w_creation_v_m_1';
                $this->base_params($data);
            } else {
                $this->SaveWorksheetDetails();
                $data['success'] = 'Worksheet Successfully Uploaded';
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadsheets();
                $data['settings_view'] = 'w_creation_v_m_1';
                $this->base_params($data);
            }
        }
    }
    
    
    function excel_do_upload() {
        $w_name = $this->input->post('w_title');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "exceltemplates/" . $sname . '.xlsx';
        if (file_exists($filename)) {
            $data['exists'] = $w_name . ' Already Exists';
            $data['depts'] = $this->getDepts();
            $data['sheets'] = $this->loadsheets();
            $data['settings_view'] = 'w_creation_v_m_1';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "exceltemplates";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'xlsx';


            $this->load->library('upload', $config);        
             
            

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadesheets();
                 $data['tests']= $this->loadTests();
                $data['settings_view'] = 'w_creation_v_m_1_1';
                $this->base_params($data);
            } else {
                $this->SaveWorksheetDetailse();
                $data['success'] = 'Worksheet Successfully Uploaded';
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadesheets();
                $data['settings_view'] = 'w_creation_v_m_1_1';
                $this->base_params($data);
            }
        }
    }
    
    
    
    function excel_do_upload_edit1($id) {
        $w_name = $this->input->post('w_title');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "exceltemplates/" . $sname . '.xlsx';
        unlink($filename);
      

            $config['upload_path'] = "exceltemplates";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'xlsx';


            $this->load->library('upload', $config);        
             
            

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                $data['depts'] = $this->getDepts();
               $data['no']=$id;
               $data['sheets'] = $this->loadesheetsE($id);
                $data['sheets1'] = $this->loadesheets();
                 $data['tests']= $this->loadTests();
                $data['settings_view'] = 'w_creation_v_m_1_1_2';
                $this->base_params($data);
            } else {
                $this->SaveWorksheetDetailse_edit($id);
                $data['success'] = 'Worksheet Edit File Successfully Uploaded';
                $data['depts'] = $this->getDepts();
                        $data['no']=$id;

                $data['sheets'] = $this->loadesheetsE($id);
                 $data['sheets1'] = $this->loadesheets();
                $data['settings_view'] = 'w_creation_v_m_1_1_2';
                $this->base_params($data);
            }
        
    }


    function do_upload_edit() {
        $w_name = $this->input->post('w_title_edit');
        $sname = $this->sanitize_name(ucfirst($w_name));
      


        $config['upload_path'] = "smplepdfs";
        $config['file_name'] = $sname;
        $config['allowed_types'] = 'pdf';


        $this->load->library('upload', $config);
        $file_name = $this->input->post('worksheet_edit');
        if ($file_name == '') {
            $this->upload_edit();            
            redirect('custom_sheets');
        } else {
            if (!$this->upload->do_upload('worksheet_edit')) {
                echo $this->upload->display_errors() . ' ' . "<a href='" . base_url() . 'worksheet_creation' . "'>Back</a>";
            } else {
                redirect('custom_sheets');
            }
        }
    }
    
       function do_upload_edite($id) {
        $w_name = $this->input->post('w_title_edit');
        $sname = $this->sanitize_name(ucfirst($w_name));
      


        $config['upload_path'] = "exceltemplates";
        $config['file_name'] = $sname;
        $config['allowed_types'] = 'xlsx';


        $this->load->library('upload', $config);
        $file_name = $this->input->post('worksheet_edit');
        if ($file_name == '') {
            $this->upload_edite();            
            redirect('custom_sheets/generic');
        } else {
            if (!$this->upload->do_upload('worksheet_edit')) {
                echo $this->upload->display_errors() . ' ' . "<a href='" . base_url() . 'worksheet_creation' . "'>Back</a>";
            } else {
                redirect('custom_sheets/generic');
            }
        }
    }

    function loadsheets() {

        return $this->db->get('worksheet_tests')->result();
    }
   function loadesheets() {

        return $this->db->order_by('id','asc')->get('worksheets_excel')->result();
    }
    
    function getSheet($id){
        return $this->db->where('wk_no',$id)->get('generic_worksheet')->result();
    }
    function getSheetTitle($id){
        return $this->db->where('worksheet_no',$id)->get('worksheets_excel')->result();
    }
    
      function loadesheetsE($id) {
        return $this->db->query("SELECT we.*, t.name as test_name
FROM worksheets_excel we, tests t
WHERE t.id = we.test_id
AND we.id='$id'")->result();
    }
    function loadsheetsJ($id) {

        echo json_encode($this->db->where('id', $id)->get('worksheet_tests')->result());
    }
    
       function loadsheetsJe($id) {

        echo json_encode($this->db->where('id', $id)->get('worksheets_excel')->result());
    }
      function delete_me($id) {
        $sheet_name = $this->db->where('id', $id)->select('alias')->get('worksheets_excel')->result();
        echo $name = $sheet_name[0]->alias;
        $this->db->where('id', $id)->delete('worksheets_excel');
        unlink('exceltemplates/' . $name . '.xlsx');
        redirect('custom_sheets/excel');
    }
    
       function delete_ge($id) {
     
        $this->db->where('id', $id)->delete('worksheets_excel');
        $this->db->where('wk_no', $id)->delete('generic_worksheet');
        unlink('exceltemplates/' . $name . '.xlsx');
       redirect('custom_sheets/generic');
    }

    function delete_m($id) {
        $sheet_name = $this->db->where('id', $id)->select('alias')->get('worksheet_tests')->result();
        echo $name = $sheet_name[0]->alias;
        $this->db->where('id', $id)->delete('worksheet_tests');
        unlink('samplepdfs/' . $name . '.pdf');
        redirect('custom_sheets');
    }

    public function SaveWorksheetDetails() {
        $w_name = $this->input->post('w_title');
        $file_details = array(
            'name' => ucfirst($w_name),
           
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->insert('worksheet_tests', $file_details);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
       public function SaveWorksheetDetailse_edit($id) {
        $w_name = $this->input->post('w_title');
          $test_id = $this->input->post('test_id');
        $file_details = array(
            'name' => ucfirst($w_name),
            'test_id'=>$test_id,
            'alias' => $this->sanitize_name(ucfirst($w_name)),
            'worksheet_no'=>  $this->input->post('wk_no')
        );
        $query = $this->db->where('id',$id)->update('worksheets_excel', $file_details);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
     function excel_do_upload_ge() {
        $w_name = $this->input->post('w_title');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "exceltemplates/" . $sname . '.xlsx';
		unlink($filename);
        if (file_exists($filename)) {
            $data['exists'] = $w_name . ' Already Exists';
            $data['depts'] = $this->getDepts();
            $data['sheets'] = $this->loadesheets();
            $data['settings_view'] = 'w_creation_v_m_1_1_1';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "exceltemplates";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'xlsx';


            $this->load->library('upload', $config);        
             
            

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                 $data['last']= $this->get_max();
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadesheets();
                 $data['tests']= $this->loadTests();
                $data['settings_view'] = 'w_creation_v_m_1_1_1';
                $this->base_params($data);
            } else {
                $this->SaveWorksheetDetailge();
                $data['success'] = 'Worksheet Successfully Uploaded';
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadesheets();
                 $data['last']= $this->get_max();
                $data['settings_view'] = 'w_creation_v_m_1_1_1';
                $this->base_params($data);
            }
        }
    }
    
    public function SaveWorksheetDetailge() {
        $wk_no = $this->input->post('wk_no');
        $w_name = $this->input->post('w_title');
        $test_id = $this->input->post('test_id');
        $tests = $this->input->post('tests');
        $u_no = $this->input->post('u_no');
        $parameter = $this->input->post('parameter');
        $cells = $this->input->post('cellno');
        
        $file_details = array(
            'name' => ucfirst($w_name),
            'test_id' => '',
            'alias' => $this->sanitize_name(ucfirst($w_name)),
            'worksheet_no' => $wk_no,
        );
       $this->db->insert('worksheets_excel', $file_details);



        for ($i = 0; $i < count($parameter); $i++):
            $file_details = array(
                'wk_no' => $wk_no,
                'tests' => $tests,
                'test_id' => $test_id[$i],
                'u_no' => $u_no,
                'parameter' => $parameter[$i],
                'cell' => strtoupper($cells[$i]),
            );
            $this->db->insert('generic_worksheet', $file_details);
        endfor;
       // $this->giveNumber( $this->sanitize_name(ucfirst($w_name)), $wk_no); 
   
    }
    
    
      function excel_do_upload_ge_edit($id) {
           
        $w_name = $this->input->post('w_title');
        $old = $this->input->post('old_name');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "exceltemplates/" . $old . '.xlsx';
		unlink($filename);
        if (file_exists($filename)) {
            $data['exists'] = $w_name . ' Already Exists';
                   $data['name'] = $this->getSheetTitle($id); 

              $data['sheets'] = $this->getSheet($id); 
        $data['settings_view'] = 'w_creation_v_m_2';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "exceltemplates";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'xlsx';


            $this->load->library('upload', $config);        
             
            

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                       $data['name'] = $this->getSheetTitle($id); 

                  $data['sheets'] = $this->getSheet($id); 
        $data['settings_view'] = 'w_creation_v_m_2';
                $this->base_params($data);
            } else {
                $this->Edit($id);
                $data['success'] = 'Worksheet Successfully Uploaded and Details Edited';
                       $data['name'] = $this->getSheetTitle($id); 

                 $data['sheets'] = $this->getSheet($id); 
                 $data['settings_view'] = 'w_creation_v_m_2';
                $this->base_params($data);
            }
        }
    }
    
      public function Edit($id) {
          $this->db->where('worksheet_no',$id)->delete('worksheets_excel');
          $this->db->where('wk_no',$id)->delete('generic_worksheet');
      
        $w_name = $this->input->post('w_title');
        $test_id = $this->input->post('test_id');
        $tests = $this->input->post('tests');
        $u_no = $this->input->post('u_no');
        $parameter = $this->input->post('parameter');
        $cells = $this->input->post('cellno');
        
        $file_details = array(
            'name' => ucfirst($w_name),
            'test_id' => '',
            'alias' => $this->sanitize_name(ucfirst($w_name)),
            'worksheet_no' => $id,
        );
       $this->db->insert('worksheets_excel', $file_details);



        for ($i = 0; $i < count($parameter); $i++):
            $file_details = array(
                'wk_no' => $id,
                'tests' => $tests,
                'test_id' => $test_id[$i],
                'u_no' => $u_no,
                'parameter' => $parameter[$i],
                'cell' => strtoupper($cells[$i]),
            );
            $this->db->insert('generic_worksheet', $file_details);
        endfor;
       // $this->giveNumber( $this->sanitize_name(ucfirst($w_name)), $wk_no); 
    echo 'Success';
    }
    
    
   function r($w=''){
       $path ='Workbooks/Sodium.xlsx';
       $this->UniversalWorkbookReaderGeneric($w,$path);
   }

    public function upload_edit() {
        $id = $this->input->post('id');
        $w_name = $this->input->post('w_title_edit');
     
        $file_details = array(
            'name' => ucfirst($w_name),
           // 'department' => $department,
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->where('id', $id)->update('worksheet_tests', $file_details);
        if ($query) {
            $oldname=  $this->input->post('sheet_name');
            rename('samplepdfs/'.$oldname.'.pdf', 'samplepdfs/'.$this->sanitize_name(ucfirst($w_name)).'.pdf');
            return true;
        } else {
            return false;
        }
    }
    
        public function upload_edite() {
        $id = $this->input->post('id');
        $w_name = $this->input->post('w_title_edit');
     
        $file_details = array(
            'name' => ucfirst($w_name),
           // 'department' => $department,
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->where('id', $id)->update('worksheets_excel', $file_details);
        if ($query) {
            $oldname=  $this->input->post('sheet_name');
            rename('exceltemplates/'.$oldname.'.xlsx', 'exceltemplates/'.$this->sanitize_name(ucfirst($w_name)).'.xlsx');
            return true;
        } else {
            return false;
        }
    }


    public function base_params($data) {
        $data['title'] = "Worksheet Creation";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
