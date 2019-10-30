<?php $this->load->view('report_top'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $phead;?></h1>
    </div>
    <?php $this->load->view($contents); ?>
    <!-- /.row -->
</div>
<?php $this->load->view('report_bottom'); ?>
            