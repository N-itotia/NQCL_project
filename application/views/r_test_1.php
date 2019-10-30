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
  cursor:progress;
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
            <h2><?php echo $r_h;?> &#187 <small> <?php echo date('d-m-Y H:i:s');?></small></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left" data-parsley-validate="" method="post" id="RE_Form">
                
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Client</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="select2_single form-control" tabindex="-1" required name="client" id="client">
                            <option value="All">All</option>
                            <?php foreach ($clients as $c): ?>
                                <option value="<?php echo $c->id; ?>"><?php echo $c->name . ' &#187 Samples ('.$c->popular.') &#187  **Most Active**'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

               <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="select2_single form-control" tabindex="-1" required name="status" id="status">
                            <option value="0">Unassigned</option>
                            <option value="1">Assigned</option>
                           
                            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="startdate" id="startdate" required type="text" class="form-control" placeholder="Start Date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="enddate" id="enddate" required type="text" class="form-control"  placeholder="End Date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    </div>
                </div>

       

 
               

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
         <button type="button" class="btn btn-success btn-lg" id="Generate_Report" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Generating Report, This might take several minutes, Please Wait....">Generate Report</button>
</div>

</div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".select2_single").select2({
            placeholder: "Select a Client",
            allowClear: true
        });
        $('.datepicker').datepicker({

        });

        $('#Generate_Report').click(function(){
			Sdate = $('#startdate').val();
			Client=$('#status').val();
			Edate = $('#enddate').val();
			if(Sdate==''){
				alert('Please Enter Start Date!');
				return false;
			}else if(Client=''){
				alert('Please Select Client');
					return false;
			}else if(Edate==''){
				alert('Please Enter End Date');
					return false;
			}else{
             

			
				  $('#Generate_Report').prop('disabled',true);
					  var $this = $('#Generate_Report');
             $this.button('loading'); 

             $.post("<?php echo base_url();?>report_engine/ExcelGeneratorUnassigned/",$('#RE_Form').serialize(),function(){
                $('#Generate_Report').prop('disabled',false);
	        $this.button('reset'); 
		$('#Generate_Report').prop('value','Generate Report');

              window.location.href="<?php echo site_url('sample_report/StatusReport.xlsx');?>" ;

           }) ;
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
