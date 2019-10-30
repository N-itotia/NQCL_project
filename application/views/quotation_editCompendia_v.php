<form class="methods" id="editTest<?php echo $test_id ?>">
		<nav class="panel container">
			<p class="panel-heading">Edit <?php echo $test_name; ?> for <?php echo $quotations_id; ?></p>
				<div class="column control is-4">
					<div class="field">
						<label class="label" >Compendia (<?php echo $current_compendium; ?>)</label>	
						<select class="select is-multiple" name="compendia">
							<option value="">Select Compendia</option>
								<?php foreach($compendia as $compendium){?>
									<option value="<?php echo $compendium['id'] ?>"  <?php if($compendium['id'] == $current_compendium){ echo "selected"; } ?> ><?php echo $compendium['name'] ?></option>
								<?php }?>
						</select>
					</div>
				</div>
				<div class="column control is-2">
					<div class="field">
						<input type="submit" class="button is-primary" value="Update">	
					</div>
				</div>
		</nav>
</form>

<script type="text/javascript">
	
	//On type, suggest
$(function(){


$('#editTest<?php echo $test_id ?>').submit(function(e){
	e.preventDefault();
	
	//Get form
	var form = $("#editTest<?php echo $test_id ?>");

	//Submit Url
	var url = "<?php echo base_url().'quotation/updateCompendia/'.$quotations_id.'/'.$test_id.'/'.$test_name.'/'.$currency?>";

	console.log(url);

	//Get formdata
	var formData = new FormData(form[0]);
	//console.log(formdata)

	//Pass to server via Axios
	axios.post(url, formData).
	then(function(response){
		parent.$.fancybox.close(true);
	}).
	catch(function(error){
		console.log(error);
	})

})




})

</script>