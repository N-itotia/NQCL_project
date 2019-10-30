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
    .ui-datepicker { width: 17em; padding: .2em .2em 0; z-index: 9999 !important; }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">NQCL LIMS > DRAFT COA REVIEW </h3>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="col-lg-12">

        <div class="row col-sm-5">
            <div class="panel panel-default well">
                <div class="panel-heading">
                    <h4>All Reviewer Reports</h4>

                </div>
                <div class="panel-body ">

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Reviewer</th>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($supervisors as $a):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><a id="<?php echo $a['id']; ?>" class="FancyBox" href="#Supervisordata" sup="<?php echo $a['title'] . ' '.$a['fname']. ' '.$a['lname']; ?>"><?php echo $a['title'] . ' '.$a['fname']. ' '.$a['lname']; ?></a></td>
                               
                            </tr>
    <?php $i++;
endforeach; ?>
                    </table>


                </div>
                <div class="panel-footer">
<!--                    <a class="btn btn-lg btn-primary" href="<?php echo base_url(); ?>report_engine/analyst_report_hod/" target="_blank">See Monthly Work Report</a>-->
                </div>
            </div>
        </div>


        <div class="row col-sm-6" style="margin-left: 10px;">
            <div class="panel panel-default well">
                <a class="btn btn-lg btn-success" href="<?php echo base_url(); ?>dreport/reviewer/<?php echo $year - 1; ?>"><?php echo $year - 1; ?></a>

                <a class="btn btn-lg btn-success" href="<?php echo base_url(); ?>dreport/reviewer/<?php echo $year; ?>"><?php echo $year; ?></a>
                <a class="btn btn-lg btn-success" href="<?php echo base_url(); ?>dreport/reviewer/<?php echo $year + 1; ?>"><?php echo $year + 1; ?></a>
                <div class="panel-heading">
                    <h2>Reviewed COA Drafts <?php echo $year; ?></h2>

                </div>
                <div class="panel-body ">
                    <div class="sampleAreea">
                        <p class="title">Total COA Draft Received</p>
                        <hr>
                        <a href="<?php echo base_url() . "dreport/pataReporti/rev/$year"; ?>" target="_blank">
                            <div class="wetchem">

                                <p class="dtitle">By Reviewer</p>
                                <hr>
                                <center><?php echo number_format($allsup); ?></center>
                            </div>
                        </a>

                    </div>
                    <hr>
                    <div class="sampleAreea">
                        <p class="title">Samples Approved</p>
                        <hr>
                        <a href="<?php echo base_url() . "dreport/pataReporti/revcom/$year"; ?>" target="_blank">
                            <div class="wetchem">

                                <p class="dtitle">By Reviewer</p>
                                <hr>
                                <center><?php echo number_format($getapp); ?></center>
                            </div>
                        </a>

                        <hr>
                        <div class="sampleAreea">
                            <p class="title">Samples Pending Approval</p>
                            <hr>
                            <a href="<?php echo base_url() . "dreport/pataReporti/repen/$year"; ?>" target="_blank">
                                <div class="wetchem">

                                    <p class="dtitle">By Reviewer</p>
                                    <hr>
                                    <center><?php echo number_format($getpen); ?></center>
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
    <div class="row col-sm-6" id="FancyBoxER" style="display: none; width: 450px; height: 250px;">
        <div class="panel-primary">
            <div class="panel-heading">
                Select Dates
            </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="input-group">
                        <input type="text" class="form-control dates" id="Sdate" placeholder="Start Date" />
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control dates" id="Edate" placeholder="End Date"/>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="button" class="btn btn-lg btn-primary" id="Report" data-sid='' data-sup='' value="Generate Report"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
               id=null;
               sup=null;
               s=null;
               e=null;
            $('.dates').datepicker({
                changeYear: true,
                changeMonth: true,
                dateFormat:"yy-mm-dd"
            });
            $('.FancyBox').click(function () {
                id = $(this).attr('id');
                sup = $(this).attr('sup');
                  
            
               $('#Report').prop('data-sid',id);
               $('#Report').prop('data-sup',sup);
               $('#Report').prop('value',sup);
                $.fancybox.open({
                    href: '#FancyBoxER',
                    width: 600,
                    height: 500
                });
            });

            $('#Report').click(function () {
               s = $('#Sdate').val();
                e = $('#Edate').val();
                if (s === '') {
                    alert('Start Date Required!')
                } else if (e === '') {
                    alert('End Date Required')
                } else {
              
              
                    window.location.href = "<?php echo base_url(); ?>dreport/rev/" + id + "/" + s + "/" + e+"/"+sup;
                }
            })
        });
    </script>


