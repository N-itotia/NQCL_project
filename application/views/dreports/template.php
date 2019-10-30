<?php
$this->load->view('dreports/header');
$this->load->view('dreports/menus');?>
<div id="page-wrapper">
    <div class="row" style="margin-top: 15px;"></div>
<?php $this->load->view('dreports/'.$contents);
$this->load->view('dreports/footer');
