<?php

include APPPATH . 'core/MY_Issues.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Issues extends MY_Issues {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Issues Tracking Homepage';
        $data['contents'] = 'body';
         $data['myissues'] = $this->MyIssues_general();
        $this->template_loader($data);
    }

    public function log() {
        $data['title'] = 'Open & Closed Issues Log';
        $data['contents'] = 'log';
        $data['o'] = $this->count_o();
        $data['c'] = $this->count_c();
        $data['log'] = $this->uri->segment(2);
        $data['myissues'] = $this->MyIssues();
        $this->template_loader($data);
    }

    public function log_open($status) {
        $data['title'] = 'Open Issues Log';
        $data['contents'] = 'open_issues';
        $data['o'] = $this->count_o();
        $data['c'] = $this->count_c();
        $data['log'] = $this->uri->segment(2);
        $data['myissues'] = $this->getOC($status);
        $this->template_loader($data);
    }

    public function log_closed($status) {

        $data['title'] = 'Closed Issues Log';
        $data['contents'] = 'closed_issues';
        $data['o'] = $this->count_o();
        $data['c'] = $this->count_c();
        $data['log'] = $this->uri->segment(2);
        $data['myissues'] = $this->getOC($status);
        $this->template_loader($data);
    }

    function getOC($status) {
        $user_id = $this->session->userdata('user_id');
        return $this->db->where('status', $status)->where('user_id', $user_id)->get('issue')->result();
    }

    function count_o() {
        $user_id = $this->session->userdata('user_id');
        return $this->db->where('status', '0')->where('user_id', $user_id)->get('issue')->num_rows();
    }

    function count_c() {
        $user_id = $this->session->userdata('user_id');
        return $this->db->where('status', '1')->where('user_id', $user_id)->get('issue')->num_rows();
    }

    function issue_review($id) {
        $data['title'] = 'Issue Review';
        $data['id'] = $id;
        $data['contents'] = 'log_1';
        $data['o'] = $this->count_o();
        $data['c'] = $this->count_c();
        $data['myissues'] = $this->getReview($id);
        $this->template_loader($data);
    }
    
        function issue_review_general($id) {
        $data['title'] = 'Issue Review General';
        $data['id'] = $id;
        $data['contents'] = 'log_general';
        $data['o'] = $this->count_o();
        $data['c'] = $this->count_c();
        $data['myissues'] = $this->getReview($id);
        $this->template_loader($data);
    }


    function issue_sorted($id) {
        $data['title'] = 'Issue Review';
        $data['id'] = $id;
        $data['contents'] = 'sorted';
        $data['o'] = $this->count_o();
        $data['c'] = $this->count_c();
        $data['myissues'] = $this->getReview($id);
        $this->template_loader($data);
    }

    function issue_edit($id) {
        $data['title'] = 'Issue Edit';
        $data['id'] = $id;
        $data['contents'] = 'log_2';
        $data['o'] = $this->count_o();
        $data['c'] = $this->count_c();
        $data['myissues'] = $this->getReview($id);
        $this->template_loader($data);
    }

    function getReview($id) {
        return $this->db->where('id', $id)->get('issue')->result();
    }
    
      function MyIssues_general() {
        $user_id = $this->session->userdata('user_id');
        return $this->db->get('issue')->result();
    }


    function MyIssues() {
        $user_id = $this->session->userdata('user_id');
        return $this->db->where('user_id', $user_id)->get('issue')->result();
    }

    public function create_new() {
        $data['o'] = $this->count_o();
        $data['c'] = $this->count_c();
        $data['title'] = 'Create New Issue';
        $data['contents'] = 'create_issues';
        $this->template_loader($data);
    }

    function add() {
        $title = $this->input->post('title');
        $issue = $this->input->post('issues');
        $developer = $this->input->post('developer');
        $user_id = $this->session->userdata('user_id');
        $user_typ = User::getUserType($user_id);
        $title1 = $user_typ[0]['title'];
        $user_name = $user_typ[0]['fname'];
        $lname = $user_typ[0]['lname'];
        $name = $title1 . $user_name . " " . $lname;

        $issues = array(
            'title' => $title,
            'issue' => $issue,
            'developer' => $developer,
            'whose' => $name,
            'user_id' => $user_id
        );
        $this->db->insert('issue', $issues);
        redirect('Issues/log');
    }

    function edit($id) {
        $title = $this->input->post('title');
        $issue = $this->input->post('issues');
        $developer = $this->input->post('developer');
        $user_id = $this->session->userdata('user_id');
        $user_typ = User::getUserType($user_id);
        $title1 = $user_typ[0]['title'];
        $user_name = $user_typ[0]['fname'];
        $lname = $user_typ[0]['lname'];
        $name = $title1 . $user_name . " " . $lname;

        $issues = array(
            'title' => $title,
            'issue' => $issue,
            'developer' => $developer,
        );
        $this->db->where('id', $id)->update('issue', $issues);
        redirect('Issues/issue_edit/' . $id);
    }

    function complete($id) {
        $comment = $this->input->post('comment');
        $issues = array(
            'status' => 1,
            'comment' => $comment,
            'time_sorted' => date('Y-m-d')
        );
        $this->db->where('id', $id)->update('issue', $issues);
        redirect('Issues/log_open/0');
    }
    
    function re_open($id) {
    
        $issues = array(
            'status' => 0,
        
        );
        $this->db->where('id', $id)->update('issue', $issues);
        redirect('Issues/log_closed/1');
    }

}
