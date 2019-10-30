<legend>
    <a href="<?php echo base_url(); ?>supervisors" >Home</a> 
    || <a href="<?php echo base_url();?>supervisors/notifications/">Notifications (<?php echo $noty;?>)</a>  
    || <a href="<?php echo base_url(); ?>supervisors" >Pending</a> 
    || <a href="<?php echo base_url(); ?>supervisors/approved_samples" >Approved</a> 
    || <a href="<?php echo base_url(); ?>report_engine/Analyst_report_hod" >Analyst Report</a> 
    || <a href="<?php echo base_url(); ?>report_engine/dreport" >Departmant Report</a> 
    || <a href="<?php echo base_url(); ?>analyst_supervisor" >Assign Supervisor</a>
</legend>

<hr />
<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }




</style>
<form action="<?php echo base_url();?>supervisors/remove" method="post">
<!--input type="submit" value="Remove Selected"/-->
<table id = "analystable">

    <thead><tr><th>Lab Reference Number</th><th>Labref</th><th>View Details (Old Way)</th><th>Approve Receipt (Current Way)</th><th>Select</th></tr></thead>

    <tbody>
        <?php 

        
        foreach ($done_tests as $test) { ?>
            <tr class="sample_issue">
                 
                <td class="common_data" ><span class="green_bold" id="labref" ><?php echo $test->labref ?></span></td>
                <td></td>
				<?php if($test->rec_status ==='0'){?>
				<td class="common_data" colspan="3" ><a id="<?php echo $test->labref;?>" href="#Approve<?php //echo base_url().'supervisors/receive/'.$test->labref;?>" class="APPROVE_SAMPLE_MOVE" >Mark as Received</a></td>
				
                <?php 
				}else{
				if($test->micro=="yes"){ ?>
                <td><?php echo anchor('supervisors/home/'.$test->labref,'View Details') ?> </td>
                <?php }else{ ;?>
                    <td><?php echo anchor('supervisors/home/'.$test->labref,'View Details') ?></td>  
               <?php };?>
              
               <td>
                   <a id="<?php echo $test->labref;?>" href="#approval-confirmaton" class="APPROVE_SAMPLE">Approve Sample</a>
               </td>
			     <td class="numbering" ><input type="checkbox" name="ids[]" value="<?php echo $test->labref ?>"/></td>
				<?php } ?>
            </tr>
         <?php } ?>
 </tbody>

</table>
</form>

<div id="dialog" title="Supervisor Actions..">
  <p>Please Select an action to perform on the sample....</p>
</div>

<script type="text/javascript">
    $(function() {
		
	

        $('#analystable').dataTable({
            "bJQueryUI": true
        }).rowGrouping({
            //iGroupingColumnIndex: 0,
            //sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 0
            //bExpandableGrouping:true,
          //  bExpandSingleGroup: false,
          //  iExpandGroupOffset: -1

        });


        $(document).on('click','.APPROVE_SAMPLE',function () {
            $labref = $(this).attr('id');
            if (confirm('You are about to confirm receipt of this sample and that it is fully done with no rejections or repeats and ready for review. Do you want to continue?')) {
              window.location.href="<?php echo base_url();?>supervisors/approveSample/"+$labref
            } else {
                // Do nothing!
            }
        })
		
		 $(document).on('click','.APPROVE_SAMPLE_MOVE',function () {
            $labref = $(this).attr('id');
		    $( "#dialog" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Receive & Approve": function() {
           window.location.href="<?php echo base_url();?>supervisors/receiveAndApprove/"+$labref
        },
        "Receive Only": function() {
           window.location.href="<?php echo base_url();?>supervisors/receive/"+$labref
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
			//alert($labref)
           /* if (confirm('Click "OK" to Receive and Approve sample and "CANCEL" to only receive and approve sample in the next step...')) {
              window.location.href="<?php echo base_url();?>supervisors/receiveAndApprove/"+$labref
            } else {
                 window.location.href="<?php echo base_url();?>supervisors/receive/"+$labref
            }*/
        })
    });

</script>

