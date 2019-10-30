<?php
$this->load->view('issues_v/header');
$this->load->view('issues_v/menus');?>
<div id="page-wrapper">
    <div class="row" style="margin-top: 15px;"></div>
<?php $this->load->view('issues_v/'.$contents);
$this->load->view('issues_v/footer');
