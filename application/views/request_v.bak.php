<script>
/*$(document).ready(function() {

	
        function addLeadingZeros(n, length)
        {
            var str = (n > 0 ? n : -n) + "";
            var zeros = "";
            for (var i = length - str.length; i > 0; i--)
                zeros += "0";
            zeros += str;
            return n >= 0 ? zeros : "-" + zeros;
        }
        setInterval(function() {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>request_management/ajax_loader",
                dataType: "JSON",
                success: function(actual) {
                    var lastid = parseInt(actual[0].id) + 1;
                    var padded_id = addLeadingZeros(lastid, 3);
                    var saffix = 'NDQ';
                    var year = "<?php echo date('Y'); ?>";
                    var month = "<?php echo date('m'); ?>";
                    var client = $('#clientT').val();
                    var full_labref = saffix + client + year + month + padded_id;
                    $('#labref_no').text(full_labref);
                    $('#lab_ref_no').val(full_labref);
                    $('#ndqno').val(full_labref);
                    $('#clientT').change(function() {
                        $('#labref_no').text(full_labref);
                        var client = $('#clientT').val();
                        var full_labref1 = saffix + client + year + month + padded_id;
                        $('#lab_ref_no').val(full_labref1);
                    });

                },
                error: function(data) {
                   // alert('An error occured, kindly try later');
                }
            });
        }, 500);
  
    });*/
	

</script>


<script>

$(function(){
$('#clientform').submit(function(e){
	e.preventDefault();

		var empty_inputs = $("#clientform").find('input').not('#crn').filter(function(){
		return this.value === "";
		});

		var empty_textarea =  $('#clientform').find('textarea').filter(function(){
		return this.value === "";
		})

		var empty_select = $("#clientform").find('select').filter(function(){
		return this.value === "";
		});

	if (empty_inputs.length || empty_select.length || empty_textarea.length) {	

	alert("Please fill all required fields to proceed.");
	
	}

	else {

	form_url = '<?php echo site_url(). "client_management/save" ; ?>'
	$.ajax({
		type: 'POST',
		url: form_url,
		data: $('#clientform').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){
				$("#entry_form, #neworreturning").dialog("close"); 
				var clientdata = $.parseJSON(response.array);
				$('#applicant_name').val(clientdata.client_name);
				$('#applicant_address').val(clientdata.client_address);
				$('#contact_name').val(clientdata.contact_person);
				$('#contact_telephone').val(clientdata.contact_phone);
				$('#appl_ref_no').val(clientdata.client_ref_no);
				$('#c_id').val(clientdata.id);
			}
			else if(response.status === "error"){
					alert(response[0].message);
			}
		},
		error:function(){
		}
	})

 }	

})


$("#clientform").validationEngine('attach', {promptPosition : "bottomLeft", scroll:true});

})

</script>
<script>
 
</script>
<form id = "analysisreq" action = "<?php echo site_url()."request_management/save" ?>">

<input type="hidden" name="client_type" id="client_types" value="<?php //echo end($lastClient); ?>" />

<p class="labrefno">Analysis Request Register&nbsp;&rarr;&nbsp;<!--label class="labrefno" id="labref_no"></label--><label id = "labref_no">Lab Reference Number</label>
	&nbsp;<!--label id="urgent">Urgent</label>&nbsp;&rarr;&nbsp;<input type = "checkbox" name= "urgency" value="1" /-->
</p>

<table id="tests" class="">
<!--tr>
	<th style="font-size: 13px">ANALYSIS REQUEST REGISTER</th>
</tr-->

<legend><hr /></legend>

<tr></tr>

<input type ="hidden" id = "c_id" name = "clientid"  />
<!--input type ="text" id = "clientid_old" name = "clientid_old" /-->

<input type = "hidden" name = "lab_ref_no" id = "lab_ref_no" />

<tr id = "dateformatitle">
<td><span class = "misc-title smalltext gray_out">Urgency<hr></span></td>
</tr>

<tr>
<td><input type = "checkbox" name = "urgency" value = "1" >
</td>
</tr>
<tr>&nbsp;<td><hr></td></tr>


<tr id = "dateformatitle">
<td><span class = "misc-title smalltext gray_out">Product Details<hr></span></td>
</tr>

<tr>
	<td>NDQ Number</td>
	<td><input type="text" name ="ndqno" id = "ndqno_readony_input" class = "validate[required]" /></td>
	<td>Client Type</td>
	<td><select id="clientT" name="clientT"  class = "validate[required]">
        <option value="">-Select Type-</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
    </select>
</td>
</tr>

<tr>
<td>Applicant Name</td>
<td><textarea name = "client_name" id = "applicant_name" class = "validate[required]" ></textarea></td>
<td>Applicant Address</td>
<td><textarea name="client_address" id="applicant_address" class = "validate[required]" ></textarea></td>
</tr>

<tr>
<td>Contact Name</td>
<td><input type="text" id="contact_name" name="contact_person" class = "validate[required]" ></label>
</td>

<td>Contact Telephone</td>
<td><input type="text" name="contact_phone" id="contact_telephone" class = "validate[required]" /></td>
</tr>

<tr>
<td>Product Name</td>
<td><textarea name="product_name" id="product_name" class = "validate[required]"></textarea></td>

<td>Dosage Form</td>
<td><select name="dosage_form" id="dosage_form" class = "validate[required]" />
	<option value=""></option>
	<?php foreach ($dosageforms as $dosageform) {?>	
	<option value="<?php echo $dosageform -> id ?>"><?php echo $dosageform -> name ?></option>
	<?php } ?>
	</select>
</td>
</tr>	

<tr>
	<td>Active Ingredients</td>
	<td><textarea name="active_ingredients"  ></textarea></td>
	<td>Quantity Submitted</td>
	<td><input type="text" name="quantity" class = "validate[required]" /></td>
	<td><select name = "packaging">
		<option value=""></option>
		<?php foreach ($packages as $package) {?>	
		<option value="<?php echo $package -> id ?>"><?php echo $package -> name ?></option>
		<?php } ?></select></td>
</tr>

<tr>
<td>Label Claim</td>
<td>
<textarea name="label_claim" id="label_claim"  ></textarea>
</td>
</tr>


<tr id = "dateformatitle">
<td><span class = "misc-title smalltext gray_out">Choose Date of Manufacture & Date of Expiry Date Format<hr></span></td>
</tr>

<tr id="dateformat">
<td id = "dmy"><span>Day-Month-Year</span></td>
<td><input type= "checkbox" name = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "dmy" /></td>
<td id = "my"><span>Month-Year</span></td>
<td><input type= "checkbox" name = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "my" /></td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

<tr id="dmy" class = "hidden2" >
<td>Manufacture Date</td>
<td><input type = "text" id = "date_m" name ="date_m" readonly class = "validate[required] datepicker" /></td>


<td>Expiry Date</td>
<td><input type = "text" id = "date_e" name = "date_e" readonly class = "validate[required] datepicker" /></td>
<tr>

<tr id="my" class = "hidden2" >
<td>Manufacture Date&nbsp;</td>
<td><input type = "text" id = "m_date" 	name ="m_date" readonly class = "validate[required] datepicker" data-month = "monthpicker" /></td>


<td>Expiry Date</td>
<td><input type = "text" id = "e_date" name = "e_date" readonly class = "validate[required] datepicker" data-month = "monthpicker" /></td>
<tr>


<tr><td><span class = "misc-title smalltext gray_out">Other things submitted<hr></span></td></tr>

<tr>
<td>Method of Analysis</td>
<td><input type ="checkbox" name ="moa" value ="moa"/></td>
<td>Chemical Reference Substance</td>
<td><input type ="checkbox" name ="crs" value ="crs" /></td>
</tr>
</table>

<!-- Selection of Tests Table Begins Here -->

<table>

<tr id = "teststabletitle">
<td><span class = "misc-title smalltext gray_out">Departmental Tests<hr></span></td>
</tr>


<tr>
<!--Accrodion-->
<td>
<div class="Accordion" id="sampleAccordion" tabindex="0">
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Wet Chemistry Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php

				foreach ($wetchemistry as $wetchem) {
					echo "<tr id =" . $wetchem -> id . " ><td>" . $wetchem -> Name . "</td><td><input type=checkbox id=" . $wetchem -> Alias . " name=test[] value=" . $wetchem -> id. " title =" . $wetchem -> Test_type . " /></td></tr>";
				}
			?>
			</table>
		</div>
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Biological Analysis Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php

				foreach ($microbiologicalanalysis as $microbiology) {
					echo "<tr id =" . $microbiology -> id . "><td>" . $microbiology -> Name . "</td><td><input type=checkbox id=" . $microbiology -> Alias . " name=test[] value=" . $microbiology -> id . " title =" . $microbiology -> Test_type . " /></td></tr>";
				}
				?>
			</table>
		</div>
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Medical Devices Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
			<?php

			foreach ($medicaldevices as $medical) {?>
			<?php echo "<tr id =" . $medical -> id ."><td>" . $medical -> Name . "</td><td><input type=checkbox id=" . $medical -> Alias . " name=test[] value=" . $medical -> id . " title =" . $medical -> Test_type . " /></td></tr>";
			?>

			<?php } ?>
			
			</table>
		</div>
	</div>
</div>
</td>
<!-- End Accrodion-->
<td>Full Monographs <input type="checkbox" name="fullmonograph" id="fullmonograph" value="fullmonograph" /></td>
</tr>
<tr><td><hr /></td></tr>
</table>

<!-- Link to show other details (hidden by default) -->
<div>
<legend><a href = "" id = "show-other-details">+ Other Details</a></legend>
</div>

<!--  Optional Fields Begin Here  -->

<table class = "hidden2" id= "other-details" >

<tr><td><span class = "misc-title smalltext gray_out">More Product Details<hr></span></td></tr>

<tr>
<td><label>Co-Packaged:</label></td>
<td><input type = "radio" name ="co-pack" value ="1">Yes&nbsp;<input type = "radio" name ="co-pack" value ="0">No</td>
</tr>

<tr>
<td><label>Product License No</label></td>
<td><input type="text" name="product_lic_no" placeholder="e.g Raj./ No .1640"  /></td>
<td>Batch/Lot Number</td>
<td><input type="text" name="batch_no" /></td>
</tr>
<tr>
<td id="date_of_receipt">Date of Receipt</td>
<td><input type="text" name="designation_date" id="designation_date" class = "validate[required] datepicker"  /></td>
<td id="ref_no_td">Client Sample Reference Number</td>
<td><input type="text" name="applicant_reference_number" id="appl_ref_no"  /></td>
</tr>

<tr><td><span class = "misc-title smalltext gray_out">Origin Details<hr></span></td></tr>
<tr>
<td>Manufacturer Name</td>
<td><input type="text" name="manufacturer_name" class = "validate[required]" /></td>

<td>Manufacturer Address</td>
<td><textarea name="manufacturer_address" id="manufacturer_address" class = "validate[required]" ></textarea></td>
</tr>

<tr>	
<td><label>Country of Origin</label></td>
<td><input type="text" name="country_of_origin" placeholder="e.g India"  class = "validate[required]"  id="country_of_origin"/></td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

</tr>

<tr><td><span class = "misc-title smalltext gray_out">Person Authorizing Request<hr></span></td></tr>
<tr>
<td>Name</td>
<td><input type ="text" name ="dsgntr" /></td>
<td>Designation</td>
<td><input type ="text" name ="dsgntn" /></td>
</tr>

</table>

<table>
<tr>
	<td><input class="submit-button" name="submit" type="submit" value="Save Request"></td>
</tr>
</table>

<input type="hidden" name="designator_name" value="<?php 

$userarray = $this->session->userdata;
$user_name = $userarray['username'];
echo $user_name ?>" /> 

<input type ="hidden" name="designation" value="<?php echo $userarray['usertype_id']; ?>"/>
	
<!--input type="hidden" name="designation_date" id="designation_date" value="<?php //echo date('y-m-d') ?>"/-->


</form>

<div id ="fancybox_label" class = "hidden2" >
  <form id = "print_label">
  	<input type = "hidden" name="ndqno" id ="label_ndqno" class = "label_ndqno" />	
	<div>
	<fieldset>
			<legend><span>Label for </span><span id ="ndqno" class = "label_ndqno"></span></legend>
			<ul id = "testlist"></ul>
	</fieldset>
	</div>
	<div class = "clear">
		<div class = "left_align">
			<label for = "no_of_prints">No. of Prints</label>
		</div>
	</div>

	<div class = "clear" >
		<div class = "left_align">
				<input type ="text" id="no_of_prints" name="no_of_prints" class="validate[required]" />
		</div>
	</div>
	<div class = "clear" >		
		<div class = "left_align">
			<input type ="submit" value="print" class="submit-button" />
		</div>
	</div>	
	</form>	
</div>

<!--  div id ="copackaging">
	<form id = "cp_no" >
	
	<div title = "Co-Packaging Details" >	
		<div class = "clear" ><hr></div>
			<div class ="right_align" >
				<input type = "text" name = "no_of_packages" placeholder = "e.g 3" />
			</div>	
		</div>
		
		<div title = "Co-Packaging Details 2" >
		<div class = "clear" ><hr></div>
			<div class ="right_align" >
				<input type = "text" name = "no_of_packages" placeholder = "e.g 3" />
			</div>	
		</div>
	
	</form>	
</div-->


<div id = "no_of_packs" class = "hidden2" >
<div class = "clear" ><legend class = "misc-title" >No. of Co-packages</legend></div>
<div class = "clear" ><hr></div>
	<form id = "no_of_packages" >
	<div class = "clear" >
		<input type = "text" name = "no_of_packs" placeholder = "e.g 3 "  title = "Enter Number of Co-packages" class = "validate[required]"  />
	</div>	
		<div class = "clear left_align" >
			<input type ="submit" value = "Save" class = "submit-button" />
		</div>
	</form>
</div>


<div id = "pack_details" class ="hidden2" >
<div class = "clear" ><legend class = "misc-title" >Details of Co-package&nbsp;<span id = "cpno" >1</span></legend></div>
<div class = "clear" ><hr></div>
	<form id = "package_details" >
	<div class = "clear" >
		<input type = "text" name = "cp_name" placeholder = "e.g Water of Injection "  title = "Water of Injection" class = "validate[required]"  />
	</div>
	<div>&nbsp;</div>
	<div class = "clear" >
		<input type = "text" name = "cp_batch_no" placeholder = "e.g Batch Number "  title = "Batch Number" class = "validate[required]"  />
	</div>
	<div>&nbsp;</div>
	<div class = "clear" >
		<input type = "text" class = "cp_date" name = "cp_mfg_date" placeholder = "Mfg Date e.g 05-May-2013"  title = "Manufacture Date" class = "validate[required]"  />
	</div>
	<div>&nbsp;</div>
	<div class = "clear" >
		<input type = "text"  class = "cp_date" name = "cp_exp_date" placeholder = "Exp Date e.g 06-June-2015"  title = "Expiry Date" class = "validate[required]"  />
	</div>
	<div>&nbsp;</div>
	<div class = "clear" >
		<input type = "text" name = "cp_quantity" placeholder = "Quantity e.g 100 "  title = "Quantity" class = "validate[required]"  />
	</div>
	<div>&nbsp;</div>
	<div class = "clear" >
		<select name = "cp_unit" title = "Unit" class = "validate[required]">
			<option value = "ml" >ml</option>
			<option value = "mg" >mg</option>
		</select> 
	</div>
	<div>&nbsp;</div>
	<span id = "nop" ></span>
		
	<div class = "clear left_align" >
		<input type ="submit" value = "Save" class = "submit-button " />
	</div>

	</form>

</div>

<div class ="hidden2" id ="confirm" >
	<span>Add another co-package?</span>
</div>


<form id = "copack">
<div id = "copackaging" class ="hidden2" >



<div title = "Details">
		<input type = "text" name = "no_of_packages" placeholder = "e.g 3" />
		<input type = "text" name = "no_of_packages" placeholder = "e.g 3" />
		<input type = "text" name = "no_of_packages" placeholder = "e.g 3" />
		<input type = "text" name = "no_of_packages" placeholder = "e.g 3" />
		<input type = "text" name = "no_of_packages" placeholder = "e.g 3" />
</div>
	
</div>
</form>

<script language="JavaScript" type="text/javascript">

$('input[data-rename ="dateformat"]').on('click', function(){
fmt = $(this).val();
console.log(fmt);
if($(this).is(':checked')){
	console.log($('tr[id = "'+fmt+'"]').show());
	if(fmt == 'dmy'){
		$('input[value = "my"]'). hide();
		$('td[id = "my"]').hide();
	}
	else if(fmt == 'my'){
		$('input[value = "dmy"]').hide();
		$('td[id = "dmy"]').hide();
	}
}
else{
	$('tr[id = "'+fmt+'"]').hide();
	if(fmt == 'dmy'){
		$('input[value = "my"]'). show();
		$('td[id = "my"]').show();
	}
	else if(fmt == 'my'){
		$('input[value = "dmy"]').show();
		$('td[id = "dmy"]').show();
	}
}

})

	
$('#analysisreq').validationEngine();

		var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");

			$(function() {
		$( "#country_of_origin" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('sample_controller/suggestions'); ?>",
				data: { term: $("#country_of_origin").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
                                    Delay : 200
		});
	});
	
	$(function() {
		$( "#manufacturer_address" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('request_management/suggestions1'); ?>",
				data: { term: $("#manufacturer_address").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
                                    Delay : 200
		});
	});

$(function() {
		$( "#label_claim" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('request_management/suggestions2'); ?>",
				data: { term: $("#label_claim").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
                                    Delay : 100
		});
	});

$(function() {
		$( "#product_name" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('request_management/suggestions3'); ?>",
				data: { term: $("#product_name").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
                                    Delay : 100
		});
	});


	$(function() {
		$( "#product_desc" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('request_management/suggestions4'); ?>",
				data: { term: $("#product_desc").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
                                    Delay : 200
		});

		
	});


	//Other Details & Co-packaging
	
	$("#show-other-details").click(function(e){
		e.preventDefault();
	 	$("#other-details").toggle();
	});

	$("#copackaging").jWizard({
		menu:false,
		finishButtonType:'submit'	
		});
	
	$('[name = "co-pack"]').on("click", function(){
		if($(this).val() == '1' ){
			$.fancybox('#pack_details');
		}
	})
	
	/*$("#no_of_packages").submit(function(e){
		e.preventDefault();
		var cps_url = "<?php //echo site_url()."request_management/coPackageSave/" ?>" + 78;
		console.log(cps_url);
		$.ajax({
			type: 'POST',
			url: cps_url ,
			data: $('#no_of_packages').serialize(),
			dataType: "json"
		}).done(function(response){
					console.log(response.array);
					no_of_packs = $.parseJSON(response.array);
					$("#nop").text(no_of_packs.no_of_packs)
					//$.fancybox.close("#no_of_packs");
					//$.fancybox("#pack_details");
			})
	})*/	
	
	
	$("#package_details").submit(function(e){
		e.preventDefault();
		var i;
		var pd_url = "<?php echo site_url()."request_management/coPackageDetailsSave/"?>" + $('input[name ="ndqno"]').val() ;
		$.ajax({
			type: 'POST',
			url: pd_url,
			data: $('#package_details').serialize()
		}).done(function(response){
				$('form[id="pack_details"]').trigger("reset");
				$.fancybox.close('#pack_details');	
				$('#confirm').dialog({
						resizable:false,
						modal:true,
						title:"Additional Co-package/Diluent",
						buttons:{
								"Yes":function(){
										$(this).dialog("close");
										no_of_pack = parseInt($("#cpno").text()) + 1;
										$("#cpno").text(no_of_pack);	
										$.fancybox.open("#pack_details");
										
									},
								"No":function(){
										$(this).dialog("close");
									}	
							}
					});
			});
	})
		
		
	
		$(function() {
			$( "#applicant_name" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('request_management/suggestions'); ?>",
				data: { term: $("#applicant_name").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
		select: function(e, ui){
			//alert(ui.item.value);
			$.getJSON("getCodes/" + ui.item.value , function(codes){
				var codesarray = codes;
				for(var i = 0; i < codesarray.length; i++){
						var object = codesarray[i];
						for(var key in object){

							var attrName = key;
							var attrValue = object[key];

							switch(attrName) {

								case 'Clientid':

								//var dat=$('#clientid_old').val(attrValue);

								$('#c_id').val(attrValue);


								break;

								case 'Address':

								$('#applicant_address').val(attrValue);

								break;

								case 'Client_type':

								//$('#labref_no').text("NDQ"+attrValue+"<?php echo date('Y')?>" + "<?php echo date('m')?>" + "<?php $lrid = $last_req_id[0]['max'] + 1; if(strlen($lrid) < 3) { $lrz = sprintf('%03d', $lrid); echo $lrz; } else {echo $lrid;} ?>");
								//$('#lab_ref_no').val("NDQ"+attrValue+"<?php echo date('Y')?>" + "<?php echo date('m')?>" + "<?php $lrid = $last_req_id[0]['max'] + 1; if(strlen($lrid) < 3) { $lrz = sprintf('%03d', $lrid); echo $lrz; } else {echo $lrid;} ?>");

								$('#clientT').val(attrValue);
								break;

								case 'Contact_person':

								$('#contact_name').val(attrValue);

								break;

								case 'Contact_phone':

								$('#contact_telephone').val(attrValue);

								break;
							

							}

						}				

				}
				
					
				})
		},
        Delay : 200
		})


			$("#fullmonograph").change(function() {
				if($('#fullmonograph').is(':checked')) {
					document.getElementById("identification").checked = true;
					document.getElementById("dissolution").checked = true;
					document.getElementById("disintegration").checked = true;
					document.getElementById("friability").checked = true;
					document.getElementById("assay").checked = true;
					document.getElementById("uniformity").checked = true;
					document.getElementById("ph").checked = true;
					document.getElementById("contamination").checked = true;
					document.getElementById("sterility").checked = true;
					document.getElementById("endotoxin").checked = true;
					document.getElementById("integrity").checked = true;
					document.getElementById("viscosity").checked = true;
					document.getElementById("microbes").checked = true;
					document.getElementById("efficacy").checked = true;
					document.getElementById("melting").checked = true;
					document.getElementById("relativity").checked = true;
					document.getElementById("condom").checked = true;
					//document.getElementById("syringe").checked = true;
					document.getElementById("needle").checked = true;
					document.getElementById("glove").checked = true;
					document.getElementById("refractivity").checked = true;
				}
				
			});

$('#date_m, #date_e, #designation_date').datepicker({
changeYear:true,
dateFormat:"dd-M-yy"
});

$('#date_m').datepicker("option", "maxDate", '0');
$('#m_date').datepicker("option", "maxDate", '0');
$('#designation_date').datepicker("option", "maxDate", '0');


$('input[data-month = "monthpicker"]').datepicker({
	dateFormat: 'M yy',
	changeMonth:true,
	changeYear: true,
	showButtonPanel: true,

	onClose: function(dateText, inst){
		var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
		var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
		$(this).val($.datepicker.formatDate('M yy', new Date(year, month, 1)));
	}
});

$("#m_date, #e_date").focus( function() {
	$(".ui-datepicker-calendar").hide();
	$("#ui-datepicker-div").position({
		my: "center top",
		at: "center bottom",
		of: $(this)
	})
})

//Date Picker for Co-Package
$(".cp_date").datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy"
});

	$('#analysisreq').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url()."request_management/save" ?>',
		data: $('#analysisreq').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				$('form').each(function(){

					this.reset();
				})
				//console.log(response.array);
				requestdata = $.parseJSON(response.array);
				$(".label_ndqno").text(requestdata.ndqno);
				$("#label_ndqno").val(requestdata.ndqno);
				for(var i =0; i < requestdata.test.length; i++){
					 $.getJSON("<?php echo base_url().'request_management/getTestName/' ?>" + requestdata.test[i], function(data){
					 	//sdata = $.parseJSON(JSON.stringify(data));
					 	console.log(data[0].Name);
					 	$("<li><span>"+data[0].Name+"</span></li>").appendTo("#testlist");
					 })
				}

				$.fancybox('#fancybox_label');

			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})


})

$('#print_label').submit(function(e){
	
e.preventDefault();
var href = '<?php echo base_url()."request_management/getLabelPdf/" ?>' + $('#ndqno').text() + "/" +$('#no_of_prints').val();
//$.post(href);
var href2 = '<?php echo base_url()."labels/" ?>' + "Label" + $('#ndqno').text() + ".pdf";
$.ajax({
		type: 'POST',
		url: href,
		data: $('#print_label').serialize()
        }).done(function(){
        	console.log(href2);
        	console.log(href);
        	console.log($().jquery);
			$.fancybox.open({
				href: href2,
				type: 'iframe',
				autoSize: false,
				//content: '<embed src = "'+href2+'#nameddest=self&page=1&view=FitH, 0&zoom=80,0,0" type="application/pdf" height="99%" width="100%" />', 
				beforeClose: function(){
					$('.fancybox-inner').unwrap();
					window.location.href =  "<?php echo site_url() ?>request_management/listing";
				}
			});	
		})
	
	})

})

</script>