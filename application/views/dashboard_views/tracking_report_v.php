<?php error_reporting(1);?>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb; width: 70%; margin:0 auto 0 auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ufsm{font-size:13px;font-family:"Arial Black", Gadget, sans-serif !important; font-weight: bolder;}
.tg .tg-ugh9{background-color:#C2FFD6}
#head td {font-weight: bolder; text-align: center;}
</style>
<table class="tg  table-hover table-condensed">
  <tr>
      <th><a href="<?php echo base_url();?>coa/generateCoa_dash/<?php echo $labref;?>" class="btn btn-small btn-primary"><< Back to COA</a></th>
    <th class="tg-ufsm" colspan="4">TRACKING LOG &#187 <?php echo $labref;?> </th>
  </tr>
  <tr id="head">
    <td class="tg-031e">No.</td>
    <td class="tg-ugh9">ACTIVITY</td>
    <td class="tg-031e">FROM</td>
    <td class="tg-ugh9">TO</td>
    <td class="tg-031e">DATE</td>
  </tr>
  <?php  
  $i=1;
  
 
  foreach($tracking_one as $track_one):?>
  <tr>
    <td class="tg-031e"><?php echo $i;?></td>
    <td class="tg-ugh9"><?php  echo $track_one->activity;?></td>
    <td class="tg-031e"><?php echo $track_one->from_who;?></td>
    <td class="tg-ugh9"><?php echo $track_one->to_who;?></td>
    <td class="tg-031e"><?php echo $track_one->date_added;?></td>
  </tr>
  <?php

    $i++;
endforeach;?>
  <tr>
      <th class="tg-ufsm"></th>
         <th class="tg-ufsm" colspan="2">DATE  SAMPLE RECEIVED &#187 <?php echo $recdate[0]->designation_date_1;?> </th> 
          <th class="tg-ufsm">DURATION BEFORE COA</th>
          <th class="tg-ufsm"><?php echo $diff . ' Day(s)';?> </th>
  </tr>
</table>



