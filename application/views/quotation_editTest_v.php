<form class="methods" id="editTest<?php echo $test_id ?>">
		<nav class="panel container">
			<p class="panel-heading">Edit <?php echo $test_name; ?> for <?php echo $quotations_id; ?></p>
				<div class="column control is-2">
					<div class="field">
						<label class="label" >Test</label>
						<input class="input" id="test_name" type="text" name="test" value="<?php echo $test_name ?>">
					</div>
				</div>
				<!--Hidden test id field-->
				<input type="hidden" name="test_id" id="test<?php echo $test_id ?>">
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
	$('#test_name').autocomplete({
		source: function(request, response) {
			$.ajax({	
				url: '<?php echo base_url(); ?>quotation/testsSearch/',
				data: {term: $('#test_name').val()},
				dataType: "json",
				type:"POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
		delay: 200,
		select: function(event, ui){
			$('#test<?php echo $test_id ?>').val(ui.item.value);
		}
	})


$('#editTest<?php echo $test_id ?>').submit(function(e){
	e.preventDefault();
	
	//Get form
	var form = $("editTest<?php echo $test_id ?>");

	//Submit Url
	var url = "<?php echo base_url().'quotation/updateTest'?>";

	//Get formdata
	var formData = new FormData(form[0]);
	//console.log(formdata)

	//Pass to server via Axios
	axios.post(url, formData).
	then(function(response){
		$.fancybox.close();
	}).
	catch(function(error){
		console.log(error);
	})

})




})

</script>