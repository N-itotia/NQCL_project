<fieldset><legend>
    <a href="<?php echo base_url(); ?>supervisors" >Home</a> 
     
    || <a href="<?php echo base_url(); ?>supervisors" >Pending</a> 
    || <a href="<?php echo base_url(); ?>supervisors/approved_samples" >Approved</a> 
    || <a href="<?php echo base_url(); ?>report_engine/Analyst_report_hod" >Analyst Report</a> 
    || <a href="<?php echo base_url(); ?>report_engine/dreport" >Departmant Report</a> 
</legend>

<hr />
<center><p class="title"> Departmental Reports  <?php echo date('Y')-1;?></p></center>

<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }
    .sampleAreea{
    	width:250px;
    	height:160px;
    	background: greenyellow;
    	padding: 5px;
    	border: 1px solid black;
    	float: left;
    	position: relative;;
    	margin-right: 20px;
    }
    .title{
    	font-weight: bolder;
    	color:black;
    	font-size:18px;
    }
    .wetchem{
    	position: relative;
    	float: left;
    	margin-right: 40px;
    }
    .dtitle{
    	font-weight: bold;
    }




</style>
<hr/>
<p><strong><u>Analysis Samples Report </u></strong><p>
<hr/>
<div class="sampleAreea">
   <p class="title">Total Samples Assigned to</p>
   <hr>
   <a href="<?php echo base_url()."report_engine/pataReporti/all/1";?>">
   <div class="wetchem">

   	<p class="dtitle">Wetchemistry</p>
   	<hr>
         <center><?php echo number_format($wrec);?></center>
   </div>
</a>
 <a href="<?php echo base_url()."report_engine/pataReporti/all/2";?>">
   <div class="wetchem">

   	<p class="dtitle">Microbiology</p>
   	<hr>
        <center><span class="badge-info"><?php echo number_format($mrec);?></span></center>

   </div>
</a>
</div>

<div class="sampleAreea">
   <p class="title">Samples Completed</p>
    <hr>
   <a href="<?php echo base_url()."report_engine/pataReporti/com/1";?>">
   <div class="wetchem">

   	<p class="dtitle">Wetchemistry</p>
   	<hr>
         <center><?php echo number_format($wcom);?></center>
   </div>
</a>
 <a href="<?php echo base_url()."report_engine/pataReporti/com/2";?>">
   <div class="wetchem">

   	<p class="dtitle">Microbiology</p>
   	<hr>
       <center><?php echo number_format($mcom);?></center>

   </div>
</a>
</div>

<div class="sampleAreea">
   <p class="title">Samples Pending</p>
    <hr>
   <a href="<?php echo base_url()."report_engine/pataReporti/pen/1";?>">
   <div class="wetchem">

   	<p class="dtitle">Wetchemistry</p>
   	<hr>
         <center><?php echo number_format($wpen);?></center>
   </div>
</a>
 <a href="<?php echo base_url()."report_engine/pataReporti/pen/2";?>">
   <div class="wetchem">

   	<p class="dtitle">Microbiology</p>
   	<hr>
       <center><?php echo number_format($mpen);?></center>

   </div>
</a>
</div>

</fieldset>


<hr/>
<p><strong><u>Supervisor Samples Report</u></strong><p>
<hr/>
<div class="sampleAreea">
   <p class="title">Total Samples Assigned to</p>
   <hr>
   <center><a href="<?php echo base_url()."report_engine/pataReportis/all/x";?>">
   <div class="wetchem">

   	<p class="dtitle"><?php echo $per;?></p>
   	<hr>
         <center><?php echo number_format($srec);?></center>
   </div>
</a></center>

</div>

<div class="sampleAreea">
   <p class="title">Samples Completed</p>
    <hr>
 <center><a href="<?php echo base_url()."report_engine/pataReportis/allc/1";?>">
   <div class="wetchem">

   	<p class="dtitle"><?php echo $per;?></p>
   	<hr>
         <center><?php echo number_format($sred);?></center>
   </div>
</a></center>
</div>

<div class="sampleAreea">
   <p class="title">Samples Pending</p>
    <hr>
 <center><a href="<?php echo base_url()."report_engine/pataReportis/allp/0";?>">
   <div class="wetchem">

   	<p class="dtitle"><?php echo $per;?></p>
   	<hr>
         <center><?php echo number_format($srep);?></center>
   </div>
</a></center>
</div>

</fieldset>






