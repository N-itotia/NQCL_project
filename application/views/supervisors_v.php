<legend><a href="<?php echo base_url(); ?>supervisors" >Home</a> | <a href="<?php echo base_url();?>supervisors/notifications/">Notifications (<?php echo $noty;?>)</a></legend>

<hr />
<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }




</style>

<table id = "analystable">

    <thead><tr><th>Select</th><th>Lab Reference Number</th><th>Test Name</th><th>View Worksheet (Wet Chem Only)</th><th>Status</th><th>Priority</th><th>View Worksheet (MICROBIOLOGY ONLY)</th></tr>
    </thead>

    <tbody>
        
        <?php 
        foreach ($analyst_data as $test) { ?>
 
         

            <tr class="sample_issue">
                    <td class="numbering" ><input type="checkbox" name="ids[]"/></td>
                <td class="common_data" ><span class="green_bold" id="labref" ><?php echo $test->labref ?> &nbsp; &rArr; &nbsp; <a href="<?php echo base_url()."request_management/make_oos/".$test->labref;?>">Mark as OOS</a></span></td>

                <?php if ($test->repeat_status > 1) { ?>
                    <td class="sample_data"><span class=""><?php echo $test->test_name ?>&nbsp;&nbsp;</span>    <?php 
                        if($test->component =='0' || $test->component ==''){
                         echo "";
                        }else{
                          echo '(<strong>'.$test->component.'</strong>)';  
                        }                           
                            ?></td> 
                    <?php } else {
                    ?>
                    <td class="sample_data"><span class=""><?php echo $test->test_name ?></span>
                        <?php 
                        if($test->component =='0' || $test->component ==''){
                         echo "";
                        }else{
                          echo '(<strong>'.$test->component.'</strong>)';  
                        }                           
                            ?>
                    </td> 

                <?php } ?>
                
                    
                    <?php if($test->test_name=='assay'){?>
                    <td><a href='<?php echo site_url() . "supervisor_upload/worksheet/" . $test->labref . "/" . $test->repeat_status . "/" . $test->component_no.'/'. $test->test_id.'/'. $test->analyst_id  ?>'><a href="<?php echo base_url().'analyst_uploads/'.$test->labref.'.xlsx';?>">Open Workbook</a> || 
                            
                     <a href="#approve" class="do_approve" id="<?php echo $test->labref;?>" tid="<?php echo $test->test_id;?>" aid="<?php echo $test->analyst_id;?>">Approve</a> ||
                     <a style="background: greenyellow; color:black;"href='<?php echo site_url() ."supervisors/upload_corrected_workbook/" .$test->labref.'/'.$test->repeat_status.'/'. $test->test_subject . "/". $test->test_id . "/". $test->analyst_id  ?>'>Upload and Approve Corrected Workbook </a>
                    || <a href="<?php echo site_url('supervisors/reject_test/'.$test->labref.'/5'.'/'.$test->analyst_id.'/assay/'.$this->session->userdata('user_id').'/reject');?>">Reject</a></td>
                    <?php } else if($test->micro =='yes') {?>
                    <td><a href='<?php echo site_url() . $test->test_name . "/" . $test->test_subject . "/" . $test->labref . "/" . $test->repeat_status . "/" . $test->component_no .'/'. $test->test_id.'/'. $test->analyst_id ?>'></a></td>
                    <?php }else{ ?>
                    <td><a href='<?php echo site_url() . $test->test_name . "/" . $test->test_subject . "/" . $test->labref . "/" . $test->repeat_status . "/" . $test->component_no .'/'. $test->test_id.'/'. $test->analyst_id ?>'>View Worksheet </a></td>

                    <?php };?>
                    <?php if($test->approval_status==='0' && $test->micro !='yes'){?>
                    <td style="color:black; font-weight: bolder;background: yellow">Not yet Approved/Rejected</td>
                    <?php }
                      elseif ($test->approval_status==='0' && $test->micro =='yes' ) {?>
                    <td style="color:black; font-weight: bolder;background: yellow">Not yet Approved | <a href='<?php echo site_url() ."analyst_uploads/" .$test->labref.'_'. $test->test_subject . ".xlsx"  ?>'>Open Excel</a> 
                    | <a href='<?php echo site_url() ."supervisors/approve/" .$test->labref.'/'.$test->repeat_status.'/'. $test->test_subject . "/". $test->test_id . "/". $test->analyst_id  ?>'>Approve </a>
                    <?php if($test->test_id =='49'){?>
                    | <a href='<?php echo site_url() ."supervisors/upload_microbial_assay/" .$test->labref.'/'.$test->repeat_status.'/'. $test->test_subject . "/". $test->test_id . "/". $test->analyst_id  ?>'>Upload Edited Workbook & Approve </a>
                    <?php }else{?>
                     | <a href='<?php echo site_url() ."supervisors/upload_bacterial_endotoxin/" .$test->labref.'/'.$test->repeat_status.'/'. $test->test_subject . "/". $test->test_id . "/". $test->analyst_id  ?>'>Upload Edited Workbook & Approve </a>
                    <?php };?>

                 </td>
                    <?php }elseif ($test->approval_status==='1'  && $test->micro !='yes') {?>
                    <td style="color:black; font-weight: bolder;background: greenyellow">Approved</td>
                    <?php }elseif ($test->approval_status==='1'  && $test->micro =='yes') {?>
                 <td style="color:black; font-weight: bolder;background: greenyellow">Approved | <a href='<?php echo site_url() ."analyst_uploads/" .$test->labref.'_'. $test->test_subject . ".xlsx"  ?>'>Download Worksheet </a> 

                    <?php }else{?>
                    <td style="color:black; font-weight: bolder;background: red">Rejected, Pending repeat</td>
                    <?php } ;?>
                     <?php //if($test->do_count >=2){?>
<!--                     <td style="text-align: center; font-weight: bolder; color: white; text-decoration: blink; background-color: red;">Yes</td>
                     <?php// } else{?>
                     <td style="text-align: center; font-weight: bolder; color: black;">No</td>-->
                     <?php //}?>
                    <?php if($test->priority==='1'){?>
                     <td><span id="high">High</span></td>
                     <?php }else{?>
                      <td><span id="low">Low</span></td>    
                     <?php }?>
                      
                      <td>
                          <?php echo anchor('micontroller/results/'.$test->labref.'/'.$test->test_id.'/'.$test->test_subject,'View Micro Results');?>
                      </td>
                    
            </tr>


        <?php } ?>



    </tbody>

</table>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.do_approve').click(function(){
		labref=$(this).attr('id');
		tid=$(this).attr('tid');
		aid=$(this).attr('aid');
				
				
		var txt;		
    var r = confirm(labref+"'s Assay test will be approved, Do you want to continue?");
    if (r === true) {
        	$.ajax({
					type:'post',
					url:"<?php echo base_url().'assay/approve/';?>"+labref+'/'+tid+'/'+aid,
					success:function(){
						window.location.href="<?php echo base_url().'supervisors/home/'.$this->session->userdata('lab');?>";
					},fail:function(){
						alert('An error occured. Kindly contact te system Administrator');
					}
				});
				
				
				
		
    } else {
        txt = "Approval Has been cancelled!";
    }
				
	
		
	});

	
	
   
        
        $('#analystable').dataTable({
            
            "bJQueryUI":true,
            "iDisplayLength":50
            
        }).rowGrouping({
            
            iGroupingColumnIndex: 0,
            sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 0,
            //bExpandableGrouping:true,
            bExpandSingleGroup: true,
            iExpandGroupOffset: -1
            
        })
    });

</script>

