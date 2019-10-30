<?php $this->load->view('template_v');?>
<script>
$(document).ready(function(){
	$('#print').click(function(){
		window.print();
	});
});
</script>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;border-top-width:1px;border-bottom-width:1px;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;border-top-width:1px;border-bottom-width:1px;}
.tg .tg-ugh9{background-color:#C2FFD6; font-weight:bolder;}
table{
	text-align:center;
	}
</style>
<center>
<table class="tg">
  <tr>    
    <th class="tg-031e" colspan='4'>SAMPLES REPORT BETWEEN <?php echo $start;?>  AND <?php echo $end;?></th>
  </tr>
  <tr>
    <td class="tg-ugh9">Received</td>
    <td class="tg-ugh9">Total Assigned</td>
    <td class="tg-ugh9">Assigned (Wet Chemistry)</td>
    <td class="tg-ugh9">Assigned (Microbiology)</td>
  </tr>
  <tr>
    <td class="tg-031e"><?php echo $received[0]->received;?></td>
    <td class="tg-031e"><?php echo $all_assigned[0]->all_assigned;?></td>
    <td class="tg-031e"><?php echo $assigned_wet[0]->assigned_wet;?>  <a href="<?php echo base_url().'assigned_report/getReport/'.$start.'/'.$end.'/1';?> " target="_blank">View Details</a></td>
    <td class="tg-031e"><?php echo $assigned_mic[0]->assigned_mic;?>  <a href="<?php echo base_url().'assigned_report/getReport/'.$start.'/'.$end.'/2';?>" target="_blank">View Details</a></td>
  </tr>
   <tr>
    <td class="tg-031e" colspan="4"><center><input type="button" value="print" id="print"/></center></td>
    
  </tr>
</table>
</center>
