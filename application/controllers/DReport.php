<?php

include APPPATH . 'core/MY_Issues.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Dreport extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function supervisor($year) {
        $data['year'] = $year;
        $data['title'] = 'Supervisor Reports';
        $data['contents'] = 'supervisor';
        $data['supervisors'] = $this->getSupData();
        $data['allsup'] = count($this->getAll($year));
        $data['getapp'] = count($this->getSuperStatus($year, 1));
        $data['getpen'] = count($this->getSuperStatus($year, 0));
        $this->template_loader($data);
    }

    public function reviewer($year) {
        $data['year'] = $year;
        $data['title'] = 'Reveiwer Reports';
        $data['contents'] = 'reveiwer';
        $data['supervisors'] = User::getAllReviewers();
        $data['allsup'] = count($this->getAllRev($year));
        $data['getapp'] = count($this->getRevStatus($year, 1));
        $data['getpen'] = count($this->getRevStatus($year, 0));
        $this->template_loader($data);
    }
    
        public function dcoarev($year) {
        $data['year'] = $year;
        $data['title'] = 'DRAFT COA REVIEW Reports';
        $data['contents'] = 'reveiwer_coa';
        $data['supervisors'] = User::getAllReviewersOfCoa();
        $data['allsup'] = count($this->getAllRev($year));
        $data['getapp'] = count($this->getRevStatus($year, 1));
        $data['getpen'] = count($this->getRevStatus($year, 0));
        $this->template_loader($data);
    }


    function pataReporti($type, $year) {
        if ($type == 'sup') {
            $data['heading'] = 'All Samples Received By Supervisors ' . $year;
            $data['content'] = $this->getAll($year);
        } else if ($type == 'supcom') {
            $data['heading'] = 'All Samples Approved By Supervisors ' . $year;
            $data['content'] = $this->getSuperStatus($year, 1);
        } else if ($type == 'supen') {
            $data['heading'] = 'All Samples Pending Supervisors Approvals ' . $year;
            $data['content'] = $this->getSuperStatus($year, 0);
        } else if ($type == 'rev') {
            $data['heading'] = 'All Samples Received By Reviewers ' . $year;
            $data['content'] = $this->getAllRev($year, 1);
        } else if ($type == 'revcom') {
            $data['heading'] = 'All Samples Approved by reviewers ' . $year;
            $data['content'] = $this->getRevStatus($year, 1);
        } else if ($type == 'repen') {
            $data['heading'] = 'All Samples Pending Supervisors Approvals ' . $year;
            $data['content'] = $this->getRevStatus($year, 0);
        }
        $data['title'] = "Department Reports";
        $this->load->view('reports_d', $data);
    }

    function superv($id, $s, $e, $name) {
        $data['heading'] = strtoupper($name);
        $data['se'] = $s . ' to ' . $e;
        $data['content'] = $this->getSingleSuperData($id, $s, $e, 1);
        $data['content1'] = $this->getSingleSuperData($id, $s, $e, 0);
        $data['title'] = "Supervisor Report";
        $this->load->view('dreports/reports_d_s', $data);
    }
    
    
       function rev($id, $s, $e, $name) {
        $data['heading'] = strtoupper($name);
        $data['se'] = $s . ' to ' . $e;
        $data['content'] = $this->getSingleRevData($id, $s, $e, 1);
        $data['content1'] = $this->getSingleRevData($id, $s, $e, 0);
        $data['title'] = "Supervisor Report";
        $this->load->view('dreports/reports_d_s', $data);
    }

    function getSupData() {
        return $this->db->get('analyst_supervisor')->result();
    }

    function getAllAnaysts() {
        return $this->db->query("SELECT CONCAT(u.title,' ',u.fname,' ',u.lname) name  FROM users_types ut
INNER JOIN user u ON u.email = ut.email
AND ut.usertype_id='1'
AND ut.status ='1' ORDER BY u.fname ASC")->result();
    }

    function getAllRev($year) {
        return $this->db->query("
SELECT r.product_name,si.folder labref,DATE_FORMAT(si.time_done,'%d-%m-%Y') received,si.status,CASE WHEN SUM(si.status) < COUNT(si.status) THEN 0 ELSE 1 END AS label, CONCAT(u.fname ,' ', u.lname) name
FROM reviewer_worksheets si 
INNER JOIN request r 
ON r.request_id = si.folder 
INNER JOIN user u
ON si.reviewer_id = u.id
AND YEAR(si.time_done)='$year'
GROUP BY si.folder
ORDER BY si.folder ASC
")->result();
    }

    function getAll($year) {
        return $this->db->query("
SELECT r.product_name,si.labref labref,DATE_FORMAT(si.date_time,'%d-%m-%Y') received,si.approval_status,CASE WHEN SUM(si.approval_status) < COUNT(si.approval_status) THEN 0 ELSE 1 END AS label, CONCAT(u.fname ,' ', u.lname) name
FROM tests_done si 
INNER JOIN request r 
ON r.request_id = si.labref 
INNER JOIN user u
ON si.supervisor_id = u.id
AND YEAR(si.date_time)='$year'
GROUP BY si.labref
ORDER BY si.labref ASC
")->result();
    }
    function getAllCOA($year) {
        return $this->db->query("
SELECT r.product_name,si.folder labref,si.time_done received,si.approval_status,
CASE WHEN SUM(si.approval_status) < COUNT(si.approval_status) THEN 0 ELSE 1 END AS label, CONCAT(u.fname ,' ', u.lname) name 
FROM directors si 
INNER JOIN request r ON r.request_id = si.folder 
INNER JOIN user u ON si.director_id = u.id 
AND si.time_done LIKE '%$year%' 
GROUP BY si.folder 
ORDER BY si.folder ASC 
")->result();
    }

    function getSingleSuperData($id, $s, $e, $status) {
        return $this->db->query("SELECT * FROM(
SELECT r.product_name,si.labref labref,DATE_FORMAT(si.date_time,'%d-%m-%Y') received,si.approval_status,CASE WHEN SUM(si.approval_status) < COUNT(si.approval_status) THEN 0 ELSE 1 END AS label, CONCAT(u.fname ,' ', u.lname) name
FROM tests_done si 
INNER JOIN request r 
ON r.request_id = si.labref 
INNER JOIN user u
ON si.supervisor_id = u.id
AND si.date_time BETWEEN '$s' AND '$e'
AND si.supervisor_id='$id'
GROUP BY si.labref)
su  WHERE label ='$status' ORDER BY labref ASC")->result();
    }
    
    
        function getSingleRevData($id, $s, $e, $status) {
        return $this->db->query("SELECT * FROM(
SELECT r.product_name,si.folder labref,DATE_FORMAT(si.time_done,'%d-%m-%Y') received,si.status,CASE WHEN SUM(si.status) < COUNT(si.status) THEN 0 ELSE 1 END AS label, CONCAT(u.fname ,' ', u.lname) name
FROM reviewer_worksheets si 
INNER JOIN request r 
ON r.request_id = si.folder 
INNER JOIN user u
ON si.reviewer_id = u.id
AND si.time_done BETWEEN '$s' AND '$e'
AND si.reviewer_id='$id'
GROUP BY si.folder)
su  WHERE label ='$status' ORDER BY labref ASC")->result();
    }


    function getSuperStatus($year, $status) {
        return $this->db->query("SELECT * FROM(
SELECT r.product_name,si.labref labref,DATE_FORMAT(si.date_time,'%d-%m-%Y') received,si.approval_status,CASE WHEN SUM(si.approval_status) < COUNT(si.approval_status) THEN 0 ELSE 1 END AS label, CONCAT(u.fname ,' ', u.lname) name
FROM tests_done si 
INNER JOIN request r 
ON r.request_id = si.labref 
INNER JOIN user u
ON si.supervisor_id = u.id
AND YEAR(si.date_time)='$year'
GROUP BY si.labref)
su  WHERE label ='$status' ORDER BY labref ASC")->result();
    }

    function getRevStatus($year, $status) {
        return $this->db->query("SELECT * FROM(
SELECT r.product_name,si.folder labref,DATE_FORMAT(si.time_done,'%d-%m-%Y') received,si.status,CASE WHEN SUM(si.status) < COUNT(si.status) THEN 0 ELSE 1 END AS label, CONCAT(u.fname ,' ', u.lname) name
FROM reviewer_worksheets si 
INNER JOIN request r 
ON r.request_id = si.folder 
INNER JOIN user u
ON si.reviewer_id = u.id
AND YEAR(si.time_done)='$year'
GROUP BY si.folder)
su  WHERE label ='$status' ORDER BY labref ASC")->result();
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

    function template_loader($data) {
        $this->load->view('dreports/template', $data);
    }

}
