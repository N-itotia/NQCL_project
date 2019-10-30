
<style type="text/css">
    div.upload{
        width: 400px;
        height: 200px;
        background-color: #E5E5E5;
        margin: auto;
        padding-top: 50px;
        padding-left: 80px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: 3px solid;
        border-color: #009900;

    }
    div.upload1{
        margin: auto;
    }
    h2{
        margin: auto;
        color:green;
    
    }
    div.error{
        color: red;
        font-family: sans-serif;
        font-weight: bolder;
        text-decoration-style: solid;
        
    }
    
</style>

<p><strong><center>ANALYST BATCH PROCESSING WORKSHEET CENTER</center></strong></p><hr>
<legend><a href="<?php echo base_url().'analyst_controller/worksheet_center';?>">Repository</a> &#187 <a href="<?php echo base_url().'analyst_controller/worksheet_uploads';?>">Upload sheets</a> &#187 <a href="<?php echo base_url().'analyst_controller/my_repo';?>">My Repository</a></legend>
<hr />
<div class="upload">

<p><?php echo @$error;?></p>

<?php echo form_open_multipart('analyst_controller/upload')?>
    
<p><h2>Kindly upload your pdf Master File</h2><p>
<!--<p> File Name: <input type="text" name="wkname" required/></p>-->

<input type="file" name="worksheet" size="20" required />

<br /><br />

<input type="submit" value="upload" />
   
</form>
</div>

