<style>
    .spinner {
        display: inline-block;
        opacity: 0;
        width: 0;

        -webkit-transition: opacity 0.25s, width 0.25s;
        -moz-transition: opacity 0.25s, width 0.25s;
        -o-transition: opacity 0.25s, width 0.25s;
        transition: opacity 0.25s, width 0.25s;
    }

    .has-spinner.active {
        cursor: progress;
    }

    .has-spinner.active .spinner {
        opacity: 1;
        width: auto; /* This doesn't work, just fix for unkown width elements */
    }

    .has-spinner.btn-mini.active .spinner {
        width: 10px;
    }

    .has-spinner.btn-small.active .spinner {
        width: 13px;
    }

    .has-spinner.btn.active .spinner {
        width: 16px;
    }

    .has-spinner.btn-large.active .spinner {
        width: 19px;
    }
</style>


<div class="col-md-10 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo $r_h; ?> &#187
                <small> <?php echo date('d-m-Y H:i:s'); ?></small>
            </h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <hr>
            <p style="font-weight: bold;">GENERAL REPORT</p>
            <hr>
            <br/>
            <form class="form-horizontal form-label-left" data-parsley-validate="" method="post" id="RE_Form">

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Client</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="select2_single form-control" tabindex="-1" required name="client" id="client">
                            <option value="All">ALL CLIENTS</option>
                            <?php foreach ($clients as $c): ?>
                                <option
                                    value="<?php echo $c->id; ?>"><?php echo $c->name . ' &#187 Samples (' . $c->popular . ') &#187  **Most Active**'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="startdate" id="startdate" required type="text" class="form-control"
                               placeholder="Start Date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="enddate" id="enddate" required type="text" class="form-control"
                               placeholder="End Date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Department
                        <br>
                        <small class="text-navy">Select department</small>
                    </label>

                    <div class="col-md-9 col-sm-9 col-xs-12">


                        <select class="department form-control select2_single" name="department">


                            <option value="All">All</option>
                            <?php foreach ($depts as $dept): ?>
                                <option value="<?php echo $dept->id; ?>"><?php echo $dept->name; ?></option>
                            <?php endforeach; ?>
                        </select>


                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Sample Status
                        <br>
                        <small class="text-navy">Select Status</small>
                    </label>

                    <div class="col-md-9 col-sm-9 col-xs-12">


                        <select name="activities" class="form-control select2_single">
                            <option value="All">All</option>
                            <?php foreach ($activities as $activity): ?>
                                <option
                                    value="<?php echo $activity->activity; ?>"><?php echo $activity->activity; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>


                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-success btn-lg" id="Generate_Report1"
                                data-loading-text="<i class='fa fa-spinner fa-spin '></i> Generating Report, This might take several minutes, Please Wait....">
                            Generate Report
                        </button>

                    </div>

                </div>
            </form>
        </div>
        <hr>
        <p style="font-weight: bold;"> DEPARTMENTAL REPORT</p>
        <hr>
        <div class="x_content">
            <br/>
            <form class="form-horizontal form-label-left" data-parsley-validate="" method="post" id="RU_Form">

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Client</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="select2_single form-control" tabindex="-1" required name="client" id="client">
                            <option value="All">ALL CLIENTS</option>
                            <?php foreach ($clients as $c): ?>
                                <option
                                    value="<?php echo $c->id; ?>"><?php echo $c->name . ' &#187 Samples (' . $c->popular . ') &#187  **Most Active**'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="startdate" id="startdate1" required type="text" class="form-control"
                               placeholder="Start Date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="enddate" id="enddate1" required type="text" class="form-control"
                               placeholder="End Date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Department
                        <br>
                        <small class="text-navy">Select department</small>
                    </label>

                    <div class="col-md-9 col-sm-9 col-xs-12">


                        <select class="department form-control select2_single" name="department">


                            <option value="All">All</option>
                            <?php foreach ($depts as $dept): ?>
                                <option value="<?php echo $dept->id; ?>"><?php echo $dept->name; ?></option>
                            <?php endforeach; ?>
                        </select>


                    </div>
                </div>


                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-success btn-lg" id="Generate_Report2"
                                data-loading-text="<i class='fa fa-spinner fa-spin '></i> Generating Report, This might take several minutes, Please Wait....">
                            Generate Report
                        </button>

                    </div>

                </div>
            </form>
        </div>


        <hr>
        <p style="font-weight: bold;">TRACK LIST: SAMPLE LAST SEEN</p>
        <hr>
        <div class="x_content">
            <br/>
            <form class="form-horizontal form-label-left" data-parsley-validate="" method="post" id="LS_Form">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Labref No(s). </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea name="samples" id="samples" required class="form-control"
                                  placeholder="Enter Labref if more than one separate with comma eg. NDQW123536,NQDR53355"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-success btn-lg" id="Generate_Report3"
                                data-loading-text="<i class='fa fa-spinner fa-spin '></i> Finding Sample, Please Wait....">
                            Get Last Seen
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $(".select2_single").select2({
                allowClear: true
            });
            $('.datepicker').datepicker({});

            $('#Generate_Report1').click(function () {
                Sdate = $('#startdate').val();
                Client = $('#client').val();
                Edate = $('#enddate').val();
                if (Sdate == '') {
                    alert('Please Enter Start Date!');
                    return false;
                } else if (Client = '') {
                    alert('Please Select Client');
                    return false;
                } else if (Edate == '') {
                    alert('Please Enter End Date');
                    return false;
                } else {


                   // $('#Generate_Report1').prop('disabled', true);
                    var $this = $('#Generate_Report1');
                    $this.button('loading');

                    $.post("<?php echo base_url();?>report_engine/getReport/", $('#RE_Form').serialize(), function () {
                        $('#Generate_Report1').prop('disabled', false);
                        $this.button('reset');
                        $('#Generate_Report1').prop('value', 'Generate Report');

                        window.location.href = "<?php echo site_url('sample_report/ClientSampleReport.xlsx');?>";

                    });
                    return true;
                }

            });


            $('#Generate_Report2').click(function () {
                Sdate = $('#startdate1').val();
                Client = $('#client').val();
                Edate = $('#enddate1').val();
                if (Sdate == '') {
                    alert('Please Enter Start Date!');
                    return false;
                } else if (Client = '') {
                    alert('Please Select Client');
                    return false;
                } else if (Edate == '') {
                    alert('Please Enter End Date');
                    return false;
                } else {


                    $('#Generate_Report2').prop('disabled', true);
                    var $this = $('#Generate_Report2');
                    $this.button('loading');

                    $.post("<?php echo base_url();?>report_engine/getAllDeptRep/", $('#RU_Form').serialize(), function () {
                        $('#Generate_Report2').prop('disabled', false);
                        $this.button('reset');
                        $('#Generate_Report2').prop('value', 'Generate Report');

                        window.location.href = "<?php echo site_url('sample_report/ClientSampleReport2.xlsx');?>";

                    });
                    return true;
                }

            });

            $('#Generate_Report3').click(function () {
                Sdate = $('#samples').val();

                if (Sdate == '') {
                    alert('Please Enter Sample');
                    return false;

                } else {


                   // $('#Generate_Report3').prop('disabled', true);
                    var $this = $('#Generate_Report3');
                    $this.button('loading');

                    $.post("<?php echo base_url();?>report_engine/sampleLocator/", $('#LS_Form').serialize(), function () {
                        $('#Generate_Report3').prop('disabled', false);
                        $this.button('reset');
                        $('#Generate_Report3').prop('value', 'Get Last Seen');

                        window.location.href = "<?php echo site_url('sample_report/Last_Seen.xlsx');?>";

                    });
                    return true;
                }

            });

            /* $('input[name=activities]').click(function() {
             $checked=$('input[name=activities]:checked').val();
             if($checked !== 'Authorization of COA Release' || $checked !=='CAN No.'){
             document.querySelectorAll('[name=status]')[0].checked = true;
             document.querySelectorAll('[name=status]')[1].disabled = true;
             document.querySelectorAll('[name=status]')[2].disabled = true;

             }else {
             alert('emable');
             $(".opr2").removeAttr("disabled")

             }
             });*/


        });
    </script>
