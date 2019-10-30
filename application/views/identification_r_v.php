<style>
            form input,select,textarea {
	//width: 70%;
	padding: 5px;
	border: 1px solid #d4d4d4;
	border-bottom-right-radius: 5px;
	border-top-right-radius: 4px;
	
	line-height: 1.5em;
	//float: right;
	
	/* some box shadow sauce :D */
	box-shadow: inset 0px 2px 2px #ececec;
}
form input:focus {
	/* No outline on focus */
	outline: 0;
	/* a darker border ? */
	border: 1px solid #bbb;
}
</style>
<script>
    $(document).ready(function() {
        loadRepeats();
        hide();
		    $.getJSON("<?php echo site_url('identification/load/'.$labref);?>/1",function(data){
           $('#procedure').val(data[0].description); 
            $('#specification').val(data[0].specification); 
             $('#findings').val(data[0].value3); 
        });
		
		$("input").bind("keydown", function(event) {
        if (event.which === 13) {
            event.stopPropagation();
            event.preventDefault();
            $(this).nextAll("input").eq(0).focus();
        }
    });
    
      $(function() {
        $("#specification").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('identification/Specifications_suggestions'); ?>",
                    data: {term: $("#specification").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
    });
    
          $(function() {
        $("#findings").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('identification/Findings_suggestions'); ?>",
                    data: {term: $("#findings").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
        
        $('#cancel').click(function(){
        window.location.href= '<?php echo base_url()?>analyst_controller';
        });
    });
    
          $(function() {
        $("#procedure").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('identification/procedure_suggestions'); ?>",
                    data: {term: $("#procedure").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
    });
		
        $('.reject').hide();

        $("#Inline").fancybox({
        });

        $('#dissolution_repeat').change(function() {
            repeat_uniformity = $(this).val();

            window.location.href = "<?php echo base_url() . 'identification/identification_r/' . $labref . '/' ?>" + repeat_uniformity + "/0";

        });
        function loadRepeats() {
            var select = $('#dissolution_repeat').empty();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>identification/repeats/<?php echo $labref; ?>",
                                dataType: "json",
                                success: function(data) {
                                    $.each(data, function(i, r) {
                                        select.append("<option value=" + r.repeat_status + ">" + r.repeat_status + "</option>");
                                    });
                                },
                                error: function() {

                                }
                            });

                        }
                    });
                    
                     function hide(){
            approved="<?php echo $done;?>";
            if(approved > 0){
               // $('.Inline,#Inline').hide();
            }else{
               // $('.Inline,#Inline').show();  
            }
            } 
			
			$(document).ready(function(){
     $('#update').hide(); 
    $('#i_repeat').change(function(){
       i_repeat=$(this).val();
       
       if(i_repeat ==''){
		   $('#Approve').show();
           $('#save').show();
        $('#update').hide(); 
       }else{
		   $('#Approve').show();
        $('#save').hide();
        $('#update').show();   
        }       
       
         $('#procedure').val(''); 
            $('#specification').val(''); 
             $('#findings').val(''); 
        
        $.getJSON("<?php echo site_url('identification/load/'.$labref);?>/"+i_repeat,function(data){
           $('#procedure').val(data[0].description); 
            $('#specification').val(data[0].specification); 
             $('#findings').val(data[0].value3); 
        });
        
    });
    
    $('#update').click(function(){
        data = $('#identi').serialize();
        i_repeat=$('#i_repeat').val();
        
        $.ajax({
  type: "POST",
  url: "<?php echo site_url('identification/saveDescriptionU/'.$labref);?>/"+i_repeat,
  data: data, 
 // dataType:"json",
   success: function(){
      
                $('#procedure').val(''); 
            $('#specification').val(''); 
             $('#findings').val(''); 
        
        $.getJSON("<?php echo site_url('identification/load/'.$labref);?>/"+i_repeat,function(data){
           $('#procedure').val(data[0].description); 
            $('#specification').val(data[0].specification); 
             $('#findings').val(data[0].value3); 
        });
            alert('Update Successfull'); 
   },error:function(){
       alert('An error occured while updating.')
   }
});
	})
			});
        
        
            
       
    
</script>
<p>
<p><h3><<<a href='<?php echo base_url() . 'supervisors/home/' . $labref; ?>'>Back</a></h3> 
<center><legend> <p>
            <?php if ($r > 1) {
                $repeat = $r - 1 ?>
            <p><center><legend><h2>Sample : <?php echo $labref; ?>&nbsp;|&nbsp; <?php echo 'Repeat ' . $repeat; ?> &nbsp;|&nbsp;Posted: <?php echo $identification[0]->date_time; ?>  </h2></legend></center></p>
        <?php } else { ?>
            <p><center><legend><h2>Sample : <?php echo $labref; ?>&nbsp;|&nbsp; &nbsp;Posted: <?php echo $identification[0]->date_time; ?>  </h2></legend></center></p>
<?php } ?>
        </p>
    </legend></center>
</p>
<p>Run no</p>
<select id="dissolution_repeat"></select>
<?php echo form_open('identification/approve/' . $labref . '/' . $r,array('id'=>'identi')); ?>
 

<center><div> 
           <select name="repeat" id="i_repeat">
                <option value="1">-Default-</option>
                 <option value="1">1</option>
                  <option value="2">2</option>
            </select>
            
         <label><h4>Describe the procedure Used</h4></label>
            <div class="identify" ><textarea id="procedure" name="description" cols="50" rows="5" required></textarea></div>
          
            <label><h4>State the Specification</h4></label>
            <div class="identify"><textarea id="specification" name="specification" cols="50" rows="5" required></textarea></div>
              <label><h4>Describe Findings</h4></label>
            <div class="identify"><textarea id="findings" name="findings" cols="50" rows="5" required></textarea></div>
    </div>
     <p><input type="button" value="Update" id="update"/> <input type="button" value="Cancel" id="cancel"/></p>

   <p><input type="submit" value="Approve" style="background-color: #33ff33;color: #ffffff; " class="Inline"/>&nbsp;&nbsp;<a href="<?php echo site_url('supervisors/reject_test/'.$labref.'/'.$test_id.'/'.$analyst_id.'/'.$test_name);?>" id="Inline1" style="background-color: #F00; color: #ffffff;">Reject</a></p>

</center>
</form>
<div class="reject">
    <div id="rejectSample">
<?php $this->load->view('compose_v_1'); ?>
    </div>
</div>
