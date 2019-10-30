<fieldset><legend>
    <a href="<?php echo base_url(); ?>supervisors" >Home</a> 
     
    || <a href="<?php echo base_url(); ?>supervisors" >Pending</a> 
    || <a href="<?php echo base_url(); ?>supervisors/approved_samples" >Approved</a> 
    || <a href="<?php echo base_url(); ?>report_engine/Analyst_report_hod" >Analyst Report</a> 
    || <a href="<?php echo base_url(); ?>report_engine/dreport" >Departmant Report</a> 
</legend>

<hr />

<center>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg">
    <tr><td colspan="3"><a href="<?php echo base_url().'dreport/supervisor/'.date('Y')?>"><< Back to Previous Page</a></td></tr>
  <tr>
      <th class="tg-yw4l" colspan=5><center><strong><?php echo str_replace('%20', ' ', $heading)  .' ('.$se.')';?> </strong></center></th>

    
  </tr>
  
    <tr>
        <th class="tg-yw4l" colspan=5><center><strong>Approved Samples</strong></center></th>

    
  </tr>
   <tr>
    <th class="tg-yw4l">No.</th>
    <th class="tg-yw4l">Request ID</th>
    <th class="tg-yw4l">Product Name</th>
    <th class="tg-yw4l">Date Assigned</th>
 
  </tr>
  <?php $i=1; foreach ($content as $c) {?>
    <tr>
    <td class="tg-yw4l"><?php echo $i;?></td>
    <td class="tg-yw4l"><?php echo $c->labref;?></td>
    <td class="tg-yw4l"><?php echo $c->product_name;?></td>
    <td class="tg-yw4l"><?php echo $c->received;?></td>
  
  </tr>
  <?php $i++; } ?>
  <tr><td colspan="5"></td></tr>
  
      <tr>
          <th class="tg-yw4l" colspan=5><center><strong>Samples Pending Approval</strong></center></th>

    
  </tr>
   <tr>
    <th class="tg-yw4l">No.</th>
    <th class="tg-yw4l">Request ID</th>
    <th class="tg-yw4l">Product Name</th>
    <th class="tg-yw4l">Date Assigned</th>
 
  </tr>
  <?php $i=1; foreach ($content1 as $c) {?>
    <tr>
    <td class="tg-yw4l"><?php echo $i;?></td>
    <td class="tg-yw4l"><?php echo $c->labref;?></td>
    <td class="tg-yw4l"><?php echo $c->product_name;?></td>
    <td class="tg-yw4l"><?php echo $c->received;?></td>
  
  </tr>
  <?php $i++; } ?>


</table>

</center>
</fieldset>