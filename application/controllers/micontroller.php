<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Micontroller extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function results($labref, $test_id) {
		error_reporting(0);
        $data['labref'] = $labref;
        $data['test_id'] = $test_id;
        $data['data'] = $this->getResults($labref, $test_id);
        $data['test_name'] = $this->getTest($test_id);
        $data['settings_view'] = "microbiology_tv_1";
        $this->base_params($data);
    }

    function getTest($id) {
        return $this->db->where('id', $id)->get('tests')->result();
    }

    function Save($labref, $test_id, $test_name) {
        $method = $this->input->post('method');
        $compendia = $this->input->post('compendia');
        $specs = $this->input->post('specification');
        $determined = $this->input->post('determined');


        $data = array(
            'method' => $method,
            'compedia' => $compendia,
            'specification' => $specs,
            'determined' => $determined
        );
        $table = 'coa_body';

        $this->update($table, $labref, $test_id, $data);
        $this->save_test($labref, $test_id, $test_name);

        redirect('analyst_controller');
    }

    function Save_s($labref, $test_id) {
        $method = $this->input->post('method');
        $compendia = $this->input->post('compendia');
        $specs = $this->input->post('specification');
        $determined = $this->input->post('determined');


        $data = array(
            'method' => $method,
            'compedia' => $compendia,
            'specification' => $specs,
            'determined' => $determined
        );
        $table = 'coa_body';

        $this->update($table, $labref, $test_id, $data);
        //  redirect('micontroller/results/'.$labref.'/'.$test_id);
    }

    function update($table, $labref, $test_id, $data) {
        $this->db
                ->where('labref', $labref)
                ->where('test_id', $test_id)
                ->update($table, $data);
        $this->updateUploadStatus($labref, $test_id);
    }

    function save_test($labref, $test_id, $test_name) {
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;

        $data = $this->check_repeat_status($labref, $test_id);
        $r_status = $data[0]->repeat_status;
        $new_r_status = $r_status + 1;
        $analyst_id = $this->session->userdata('user_id');

        $final_test_done = array(
            'labref' => $labref,
            'test_name' => $test_name,
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => $test_id,
            'analyst_id' => $analyst_id,
            'priority' => '',
            'worksheet_status' => 1,
            'micro' => 'yes'
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function updateUploadStatus($labref, $test_id) {
        $this->db->where('lab_ref_no', $labref)->where('test_id', $test_id)->update('sample_issuance', array('upload_status' => 1, 'done_status' => '1', 'completion' => '1'));
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
    }

    function check_repeat_status($labref, $test_id) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('test_subject', $test_id);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function getResults($labref, $test_id) {
        $this->db->where('labref', $labref);
        $this->db->where('test_id', $test_id);
        $query = $this->db->get('coa_body');
        return $result = $query->result();
    }

    public function approve_data($labref,$test_id) {
       
        $method = $this->input->post('method');
        $compendia = $this->input->post('compendia');
        $specs = $this->input->post('specification');
        $determined = $this->input->post('determined');


        $data = array(
            'method' => $method,
            'compedia' => $compendia,
            'specification' => $specs,
            'determined' => $determined
        );
        $table = 'coa_body';

        $this->update($table, $labref, $test_id, $data);
   

        $this->db->where('labref', $labref);
        $this->db->where('test_subject', $test_id);
        $this->db->update('tests_done', array('approval_status' => '1'));


    }

    public function base_params($data) {
        $data['title'] = "Analyst";
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
