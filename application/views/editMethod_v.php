<form class="methods" id="editMethods<?php echo $component_id.$test_id ?>">
	<ul style="list-style: none;">
		<li>
			<fieldset>
				<legend>Edit Method | <?php echo $quotations_id; ?> | <?php echo $test_name[0]['Name']; ?> | <?php echo $component_name; ?></legend>
				<li>
					<label>
						<span>
							<select name="method">
								<?php foreach($method_data as $method){ ?>
									<option value="<?php echo $method['id'] ?>"  <?php if($method['id'] == $method_id){ echo "selected";} ?>  ><?php echo $method['name'] ?></option>
								<?php }?>
								<option value="42" >None</option>
							</select>
							&nbsp;
							<input type="submit" class=" save_changes submmit_button leftie" value="Save Changes">
						</span>
					</label>
				</li>
			</fieldset>
		</li>
	</ul>
</form>


<div class ="hidden2" id ="confirmBatch" >
    <span>Apply changes to this batch only or to all batches?</span>
</div>



<script type="text/javascript">
	$(document).ready(function(){

		//Serverside action via Axios on submitting form 
		$('#editMethods<?php echo $component_id.$test_id ?>').submit(function(e){
			
			//Prevent default redirect behaviour on submit
			e.preventDefault();

			//Get Form
			var form  = $('#editMethods<?php echo $component_id.$test_id ?>');
			console.log(form);

		   	//pass actual form, not jQuery object (hence the [0] after form variable ) to FormData 
		   	var formData = new FormData(form[0]);
		   	console.log(formData);

		   	var batch_status;

			//Confirm whether to affect batch or this particular batch only
			$('#confirmBatch').dialog({
				resizable:false,
				modal:true,
				title: "Edit This Batch / All Batches",
				buttons:{
					"This Only":function(){
						
						//Set batch no.
						batch_status = 0;

					   	//Close dialog
					   	$(this).dialog("close");

					},
					"All Batches":function(){
						

						//Set batch no.
						batch_status = 1;

						//Close dialog
						$(this).dialog("close");
						
					}
				},
				close:function(event, ui){

						//Get submit href
						editurl = "<?php echo base_url().'quotation/editMethod/'.$method_id.'/'.$test_id.'/'.$quotations_id.'/'.$component_id.'/'.$component_name.'/'.$quotation_id.'/'.$no_of_batches.'/'.$quotation_no?>/"+batch_status+'/<?php echo $currency; ?>'

						//Inspect URL
						console.log(editurl);

						//Pass to server via Axios
					   	axios.post(editurl, formData).
					   	then(function(response){
					   		window.location.reload();
					   	}).
					   	catch(function(error){
					   		console.log(error);
					});
				}
			})





		 })

		})
</script>