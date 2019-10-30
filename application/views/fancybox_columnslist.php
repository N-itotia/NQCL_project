<div class = " popupform" id = "col<?php echo $column[0]['id'] ?>" >
		<form id = "editcol<?php echo $column[0]['id'] ?>" data-formid = "editcol" >
			<div>
				<legend>Edit. <?php  echo $column[0]['column_types']['column_type'] ?>&nbsp;<?php echo $column[0]['serial_no']  ?></legend>
				<hr />
			</div>
			<div id = "add_success" class ="hidden2" >
				<span class = "misc-title small-text padded" ><?php print_r($_POST) ?></span>
			</div>	

			<div class = "clear">
				<div class = "left_align">
					<label for = "type">Type</label>
				</div>
				<div class = "right_align">
					<textarea name = "type" required ><?php  echo $column[0]['column_types']['column_type'] ?></textarea>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "serial_no">Serial No.</label>
				</div>
				<div class = "right_align">
					<input name = "serial_no" required value = "<?php  echo $column[0]['serial_no'] ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "column_dimensions">Dimensions</label>
				</div>
				<div class = "right_align">
					<input name = "column_dimensions" required value = "<?php  echo $column[0]['column_types']['column_dimensions'] ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "manufacturer">Manufacturer</label>
				</div>
				<div class = "right_align">
					<input name = "manufacturer" required value = "<?php  echo $column[0]['column_types']['manufacturer'] ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "date_r">Date Received</label>
				</div>
				<div class = "right_align">
					<input name = "date_r" required value = "<?php  echo $column[0]['column_types']['date_received'] ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "quant_r">Quantity Received</label>
				</div>
				<div class = "right_align">
					<input name = "quant_r" required value = "<?php  echo $column[0]['column_types']['quantity_received'] ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "issued_to">Issued To</label>
				</div>
				<div class = "right_align">
					<select name = "issued_to" id="issued_to<?php echo $column[0]['id'] ?>" >
						<option value = "0" > </option>
						<?php foreach($analysts as $analyst) { ?>
							<option value = "<?php echo $analyst['id'] ?>" ><?php echo $analyst['fname'] . " " . $analyst['lname']; ?></option>
						<?php } ?>	
					</select>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "status">Status</label>
				</div>
				<div class = "right_align">
					<select name = "status" id = "status<?php echo $column[0]['id'] ?>" >
						<option value = "1" >In Use</option>
						<option value = "0" >Decommissioned</option>
					</select>	
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "comment">Comment</label>
				</div>
				<div class = "right_align">
					<textarea name = "comment" ><?php echo $column[0]['comment']; ?></textarea>	
				</div>
			</div>
			<input type = "hidden" name = "dbid" value = "<?php echo $column[0]['id']  ?>" />
			<input type = "hidden" name = "column_type_id" value = "<?php echo $column[0]['column_type_id']; ?>"
			<input type = "hidden" name ="date_r2" id = "colstatus<?php echo $column[0]['id']  ?>" value ="<?php echo date('d-M-y') ?>" />
			<input type = "hidden" name = "dbissued_to" id = "dbissued_to<?php echo $column[0]['id'] ?>" value="<?php echo $column[0]['column_issue']['analyst_id'] ?>" />
			<input type = "hidden" id = "dbstatus<?php echo $column[0]['id'] ?>" value="<?php echo $column[0]['column_status'] ?>" />
			<div class = "clear" >
				<div class = "right_align">
					<input type = "submit" value = "Save" class = "submit-button" />
				</div>
			</div>
			     <input type = "hidden" id = "colstatus<?php echo $column[0]['id'] ?>" value ="<?php echo $column[0]['column_status'] ?>" />
			</div>
		</form>
	</div>

<script type="text/javascript">

$(function(){   

$("#issued_to<?php echo $column[0]['id'] ?> option").each(function(){
if($(this).val() == $("#dbissued_to<?php echo $column[0]['id'] ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#status<?php echo $column[0]['id'] ?> option").each(function(){
if($(this).val() == $("#status<?php echo $column[0]['id'] ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$('.edit').fancybox();	
$('.issue').fancybox();
$('.issued').fancybox();

	var cols = $('#cols').DataTable({
		"bJQueryUI": true,
		"bDeferRender":true
	});

 $('[data-formid = "editcol"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "inventory/column_edit/". $column[0]['column_status'] ?>',
		data: $('[data-formid = "editcol"]').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){
				//$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				parent.$.fancybox.close();
				cols.ajax.reload();
				window.location.reload(true);	
			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

})



$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy",
});


var cols;



})

</script>
	