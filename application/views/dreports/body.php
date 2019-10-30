<!-- Page Content -->
<style>
      .title{
    	font-weight: bolder;
    	color:black;
    	font-size:18px;
    }
    .wetchem{
    	position: relative;
    	
    	margin-right: 40px;
    }
    .dtitle{
    	font-weight: bold;
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">NQCL LIMS </h3><span>Analyst Reports</span>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="col-lg-12">

        <div class="row col-sm-5">
            <div class="panel panel-default well">
                <div class="panel-heading">
                    <h2>All Analysts</h2>

                </div>
                <div class="panel-body ">
                    <ol>
                        <?php foreach ($analysts as $a): ?>
                            <li><?php echo $a->name; ?></li>
                        <?php endforeach; ?>
                    </ol>

                </div>
                <div class="panel-footer">
                    <a class="btn btn-lg btn-primary" href="<?php echo base_url(); ?>report_engine/analyst_report_hod/" target="_blank">See Monthly Work Report</a>
                </div>
            </div>
        </div>


        <div class="row col-sm-6" style="margin-left: 10px;">
            <div class="panel panel-default well">
                                <a class="btn btn-lg btn-success" href="<?php echo base_url();?>report_engine/dep/<?php echo $year- 1;?>"><?php echo $year - 1 ;?></a>

                <a class="btn btn-lg btn-success" href="<?php echo base_url();?>report_engine/dep/<?php echo $year;?>"><?php echo $year;?></a>
                  <a class="btn btn-lg btn-success" href="<?php echo base_url();?>report_engine/dep/<?php echo $year +1 ;?>"><?php echo $year + 1;?></a>
                <div class="panel-heading">
                    <h2>Analysis Samples <?php echo $year; ?></h2>

                </div>
                <div class="panel-body ">
                    <div class="sampleAreea">
                        <p class="title">Total Samples Assigned to</p>
                        <hr>
                        <a href="<?php echo base_url() . "report_engine/pataReporti/all/1/$year"; ?>" target="_blank">
                            <div class="wetchem">

                                <p class="dtitle">Wetchemistry</p>
                                <hr>
                                <center><?php echo number_format($wrec); ?></center>
                            </div>
                        </a>
                        <a href="<?php echo base_url() . "report_engine/pataReporti/all/2/$year"; ?>" target="_blank">
                            <div class="wetchem">

                                <p class="dtitle">Microbiology</p>
                                <hr>
                                <center><?php echo number_format($mrec); ?></center>

                            </div>
                        </a>
                    </div>
                    <hr>
                    <div class="sampleAreea">
                        <p class="title">Samples Completed</p>
                        <hr>
                        <a href="<?php echo base_url() . "report_engine/pataReporti/com/1/$year"; ?>" target="_blank">
                            <div class="wetchem">

                                <p class="dtitle">Wetchemistry</p>
                                <hr>
                                <center><?php echo number_format($wcom); ?></center>
                            </div>
                        </a>
                        <a href="<?php echo base_url() . "report_engine/pataReporti/com/2/$year"; ?>" target="_blank">
                            <div class="wetchem">

                                <p class="dtitle">Microbiology</p>
                                <hr>
                                <center><?php echo number_format($mcom); ?></center>

                            </div>
                        </a>
                    </div>
                    <hr>
                    <div class="sampleAreea">
                        <p class="title">Samples Pending</p>
                        <hr>
                        <a href="<?php echo base_url() . "report_engine/pataReporti/pen/1/$year"; ?>" target="_blank">
                            <div class="wetchem">

                                <p class="dtitle">Wetchemistry</p>
                                <hr>
                                <center><?php echo number_format($wpen); ?></center>
                            </div>
                        </a>
                        <a href="<?php echo base_url() . "report_engine/pataReporti/pen/2/$year"; ?>" target="_blank">
                            <div class="wetchem">

                                <p class="dtitle">Microbiology</p>
                                <hr>
                                <center><?php echo number_format($mpen); ?></center>

                            </div>
                        </a>
                    </div>

                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>


    </div>
    <!-- /.panel-body -->

</div>


<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            "JQueryUI": true
        });
    });
</script>


