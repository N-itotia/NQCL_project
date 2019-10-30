<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 
<script type="text/javascript">
function sendData()
{
 
    var data = new FormData($('#posting_comment')[0]);
 
 
     $.ajax({
               type:"POST",
               url:"<?php echo site_url('documentation/fileUpload');?>",
               data:data,
               mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
               success:function(data)
              {
                        console.log(data);
 
               }
       });
 
}
 
</script>
<form name="posting_comment" id="posting_comment" >
 
      <input id="file_upload" name="attachment_file" class="file_upload_icon" type="file"/>
      <input type="button" class="post postbtn" style="border: none;outline:none;" value="Post" onclick = "return sendData()"/>
</form>

