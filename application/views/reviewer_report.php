<title>
REVIEWER REPORT
</title>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery-ui-1.11.4.custom/jquery-ui.min.css"></script>

<style type="text/css">
   body{
	   padding:0;
	   margin:0;
	   font-type:"Book Antiqua"
	   font-size:12px;
   }
   @page { size : portrait }
   @page rotated { size : landscape }
   table { page : rotated}
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:bolder;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}

#date{
	margin-left:980px;
	font-weight:bolder;
	font-size:21px;
}
#title{
	
	font-weight:bolder;
	font-size:23px;
	margin-top:25px;
}
</style>
 <p id="date"><?php echo date('jS F Y');?></p>

<body>
<a href="<?php echo base_url();?>reviewer">Back</a>
<input type="text" class="datepicker" id="month" placeholder="Start Date" />
<input type="text" class="datepicker" id="year" placeholder="End Date" />
<center>
 
 <p id="title">ACKNOWLEDGEMENT OF RECEIPT OF WORKSHEETS AND CERTIFICATE DRAFTS</p>
 <p>Kindly acknowledge receipt of worksheets and certificate draft for the listed samples and authorize the processing of the final analysis report</p>



<table class="tg" style="width:1200px;">
  <tr>
    <th class="tg-yw4l">No.</th>
    <th class="tg-yw4l">Product</th>
    <th class="tg-yw4l">Laboratory Reference Number</th>
    <th class="tg-yw4l">CAN No.</th>
    <th class="tg-yw4l">Date Released</th>
    <th class="tg-yw4l">Directors Signature</th>
  </tr>
 
  
  <?php 
  if(empty($samples)){?>
	  <tr>
    <td class="tg-yw4l" colspan="6" style="text-align:center; font-weight:bolder;">No Data</td>
   
  </tr>  
 <?php }else{
  $i=1;
  foreach($samples as $sa):?>
   <tr>
    <td class="tg-yw4l"><?php echo $i;?></td>
    <td class="tg-yw4l"width="400px;"><?php echo $sa->product_name;?></td>
    <td class="tg-yw4l" width="150px;"><?php echo $sa->labref;?></td>
    <td class="tg-yw4l" width="150px;"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <?php 
  $i++;
  endforeach;
 }?>
  
</table>
</center>
<p style="margin-left:120px;">Reviewed by: <span style="font-weight:bolder; text-decoration:underline; "><?php echo $user[0]->title." ".$user[0]->fname." ".$user[0]->lname;?></span></p>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>


<script>

  $(document).ready(function(){
	  $('.datepicker').datepicker({dateFormat:'yy-mm-dd'});
	 
	  $('#year').change(function(){
		   month = $('#month').val();
	  year = $('#year').val();
		  //alert(year)
		 window.location.href="<?php echo base_url();?>reviewer/revewerSubmissionReport/"+month+'/'+year; 
	  });
  });
</script>