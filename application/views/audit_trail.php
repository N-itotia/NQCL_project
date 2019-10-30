<style type="text/css">

.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-4eph{background-color:#f9f9f9}
table{
    margin: 0 auto 0 auto;
    width: 80%;
}
.tg th{
    font-weight: bolder;
}
</style>
<center><table>
      <tr>
          <td class="tg-031e" colspan="12"><strong><u>NQCL AUDIT TRAIL FOR "<?php echo $labref;?>"</u></strong></td>

  </tr>
    </table></center>
<p style="width: 100%; height: 5px;"></p>
<hr>
<table class="tg">
  <tr>
    <th class="tg-031e">NO.</th>
    <th class="tg-031e">ACTION</th>
    <th class="tg-031e">DATE/TIME</th>
    <th class="tg-031e">REVISION</th>
    <th class="tg-031e">BY WHO</th>
    <th class="tg-031e">TEST NAME</th>
    <th class="tg-031e">METHOD</th>
    <th class="tg-031e">COMPENDIA</th>
    <th class="tg-031e">SPECIFICATION</th>
    <th class="tg-031e">CONCLUSION</th>
    <th class="tg-031e">STATUS</th>
  </tr>
  <?php
  $i=1;
  foreach($audit as $trail):?>
  <tr>
    <td class="tg-031e"><?php echo $i;?></td>
    <td class="tg-4eph"><?php echo $trail->action;?></td>
      <td class="tg-4eph"><?php echo $trail->dt_datetime;?></td>
    <td class="tg-031e"><?php echo $trail->revision;?></td>
    <td class="tg-031e"><?php echo $trail->by_who;?></td>
    <td class="tg-4eph"><?php echo $trail->test_name;?></td>
    <td class="tg-031e"><?php echo $trail->method;?></td>
    <td class="tg-4eph"><?php echo $trail->compedia;?></td>
    <td class="tg-031e"><?php echo $trail->specification;?></td>
    <td class="tg-4eph"><?php echo $trail->conclusion;?></td>
    <td class="tg-031e"><?php echo $trail->complies;?></td>
  </tr>
  <tr>
      <?php
      $i++;
      endforeach;?>
      <td class="tg-031e" colspan="12">Audit trail for <?php echo $labref;?> - NQCL &copy; <?php echo  date('Y');?></td>
  </tr>
</table>
