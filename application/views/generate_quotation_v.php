<html>
    <form id = "quotation" class = "methods">
        <h3>New Quotation Entry <?php echo $qn?><?php if($newstatus == 0){echo "&nbsp;|&nbsp;".$quotation_info[0]['Client_name'];} ?></h3> 
		<?php /*if($newstatus == 0) {$noe = $no_of_entries_done[0]['completed'] + 1; $noe2 = $no_of_entries[0]['no_of_entries'] + 1; if($no_of_entries != 0){ echo "<h4>Quotation entry ". $noe." of ".$noe2."</h4>"; }}*/?>
        <ul id = "quotation_ul">
		    <li class = "global">
                <fieldset >
                    <legend>Currency</legend>
                        <li>
							<?php foreach($currency as $c) { ?> 
								<label>
									<input id = "currency" name="currency" class ="validate[required]" title ="<?php echo $c['name']; ?>" type="radio" value="<?php echo $c['abbrev']; ?>" <?php if($newstatus == 0) {if($c['abbrev'] == $quotation_info[0]['Currency']){ echo "checked"; }} ?>  />&nbsp;<?php echo $c['abbrev']; ?>&nbsp;
								</label>
							<?php }?>
                        </li>
                </fieldset>
            </li>
            <li class = "global">
                <fieldset >
                    <legend>Client Info</legend>
                        <li>
                            <label>
                                <span>Client Name</span>
                                <input id = "client_name" name="client_name" class ="validate[required]" value = "<?php if ($newstatus==0){ echo $quotation_info[0]['Client_name']; }?>" placeholder ="e.g Kenya Pharma" type="text" />
                            </label>
                        </li>
                        <li>
                            <label>
                                <span>Client Email</span>
                                <input id = "client_email" name="client_email"  value = "<?php if($newstatus ==0) { echo $quotation_info[0]['email']; }?>" placeholder ="client@email.com" type="text" />
                            </label>
                        </li>
                    </fieldset>
                </li>
                <li id = "quotation_select" style = "list-style-type: none;" ></li>
                <li>
                    <fieldset class = "local">
                        <legend>Product Info</legend>
                        <li>
                            <label>
                                <span>Product Name</span>
                                <input id = "sample_name" name="sample_name" class ="validate[required]" placeholder ="e.g Panadol" type="text" />
                            </label>
                        </li>
                        <li>
                            <label>
                                <span>No. of Batches</span>
                                <input id = "no_of_batches" name="no_of_batches" class ="validate[required]" placeholder ="e.g 50" type="text" />
                            </label>
                        </li>
                </fieldset>
            </li> 
            <li>
                <fieldset id = "test_fieldset" class = "local">
                    <legend><span>Tests Info</span></legend>
                        <table id ="tests_table">
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
                                                        echo "<tr id =" . $wetchem->id . " ><td>" . $wetchem->Name . "</td><td><input type=checkbox id=" . $wetchem->Alias . " name=test[] value='$wetchem->id' title =" . $wetchem->Test_type . " /></td></tr>";
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
                                                        echo "<tr id =" . $microbiology->id . "><td>" . $microbiology->Name . "</td><td><input type=checkbox id=" . $microbiology->Alias . " name=test[] value= '$microbiology->id'  title =" . $microbiology->Test_type . " /></td></tr>";
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="AccordionPanel">
                                            <div class="AccordionPanelTab"><b>Medical Devices Unit</b></div>
                                            <div class="AccordionPanelContent">
                                                <table>
                                                        <?php foreach ($medicaldevices as $medical) { ?>
                                                        <?php echo "<tr id =" . $medical->id . "><td>" . $medical->Name . "</td><td><input type=checkbox id=" . $medical->Alias . " name=test[] value= '$medical->id'  title =" . $medical->Test_type . " /></td></tr>";
                                                        ?>

                                                    <?php } ?>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!-- End Accrodion--> 
                            </tr>
                     </table>
                    </fieldset>
                </li>
            </ul>
            <input name = "client_id" type = "hidden" id = "client_id" value = "<?php if($newstatus ==0) { echo $quotation_info[0]['Client_number']; }?>" />
			<input name = "quotation_no" type="hidden" id = "q_no" value = "<?php if($newstatus == 0){echo $qn;}else{echo "New";}?>"/>
			<?php if($newstatus == 0){?>
			<input name = "currency" type="hidden" value = "<?php echo $quotation_info[0]['Currency'];?>"/>
			<?php }?>	
        <div class = "clear" >		
            <div class = "left_align">
                <input type ="submit" value="Save" class="submit-button" />
            </div>
        </div>
    </form>	


<script language="JavaScript" type="text/javascript">
    
$('#quotation').validationEngine();

//Set Currency Radio to Default
$('input[type="radio"][value="KES"]').prop("checked", true);

//Determine if quotation is new or not set global inputs to disabled
newstatus = "<?php echo $newstatus; ?>";
if(newstatus == 0){
	$(".global input ").prop("readonly", true);
}

var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");

$(function() {
	
	//Initialize local storage
	storage = $.localStorage;
	
	//Get Currency Radios
	var currencyRadios = $('input[name="currency"]');
	
	//Get all tests, in an array
	var allTests = new Array();
	allTests = $('input[name="test[]"'); 
	console.log(allTests);
	
	//Save input values to localstorage
	function quotationInfoToLocalstorage(){

		storage.set('currency', $('input[name="currency"]:checked').val());
        storage.set('quotation_entries', $('#quotation_entries').val());
        storage.set('client_name', $('#client_name').val());
        storage.set('client_email', $('#client_email').val());
        storage.set('sample_name', $('#sample_name').val());
		storage.set('no_of_batches', $('#no_of_batches').val());
		storage.set('tests', $('input[name="test[]"]:checked').val());
	}
	
	//Set quotation generate inputs with localstorage values
	function setInputsWithLsValues(){
			//Get Currency Radios, Set Localstorage, Check match, Set checked status
			var curr = storage.get('currency');
			if(curr != null){
				for(i=0;i<currencyRadios.length;i++){
					if(currencyRadios[i].value == curr){
						currencyRadios[i].checked = true;
					}
				}
			}
			
			//Get stored tests values
			aTests = storage.get('tests');
			console.log(aTests);
			/*if(aTests != null){
				for(i=0;i<allTests.length;i++){
					if(allTests[i].value == aTests[i].value){
						allTests[i].checked = true;
					}
				}
			}*/
			$('#quotation_entries').val(storage.get('quotation_entries'));
            $('#client_name').val(storage.get('client_name'));
			$('#client_email').val(storage.get('client_email'));
            $('#sample_name').val(storage.get('sample_name'));
            $('#no_of_batches').val(storage.get('no_of_batches'));
		
	}
	
	//On page load set localstorage values to inputs
	//setInputsWithLsValues();
	
    $('#quotation').submit(function(e){
    e.preventDefault();
    
	//Call function to save input values to localstorage
    //quotationInfoToLocalstorage();

	
    var client = $('#client_name').val();
    var product = $('#sample_name').val();
    var tests =  $('input[type = "checkbox"]:checked').val();
    var no_of_batches = $('#no_of_batches').val();
 
    var inputs = $("#quotation").find('input').not(':hidden').filter(function(){
         return this.value === "";
    });

    if (inputs.length) {

    console.log(inputs);

    }

        else {
            $('<div><ul class = "no_style"><li>Confirm</li><b><li>'+client+'</li><li>'+product+'</li><li>'+tests+'</li></b><li>&nbsp;?</li></ul></div>').dialog({
            resizable:false,
            title: "Quote Confirmation " + client,
            modal:true,
            buttons:{
                "Yes":function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url()."quotation/save/" ?>'+newstatus+'/<?php echo $qn; ?>',
                data: $('#quotation').serialize(),
                dataType: "json",
                success:function(response){
                    if(response.status === "success"){

                        //Close fancybox
                        parent.$.fancybox.close('#quotation');

                    }
                    else if(response.status === "error"){
                            alert(response.message);
                    }
                },
                error:function(response){
                    console.log(response);
                }
            })

            $(this).dialog("close");
        },
                "No":function(){
                    $(this).dialog("close");
                }
            }

        })         

        }
    })


    $(function() {
        $("#client_name").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('request_management/suggestions'); ?>",
                    data: {term: $("#client_name").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(e, ui) {
                var href = '<?php echo base_url()."request_management/getCodes/"; ?>'
                //console.log(href);
                $.getJSON( href + ui.item.value, function(codes) {
                    var codesarray = codes;
                    console.log(codesarray);
                    for (var i = 0; i < codesarray.length; i++) {
                        var object = codesarray[i];
                        for (var key in object) {

                            var attrName = key;
                            var attrValue = object[key];

                            switch (attrName) {

                                case 'id':

                                $('#client_id').val(attrValue);

                                 var options_href = '<?php echo base_url()."quotation/getQuotationNos/"; ?>'+ attrValue
                                    console.log(options_href);
                                        $.getJSON(options_href, function(options){

                                            var options_array = options;
                                            console.log(options_array);
                                            var o_array = ["<option value = 'New' >New</option>"];
                                            for(var i = 0; i < options_array.length; i++){
                                                o_array.push("<option value ='"+options_array[i].Quotation_no+"'>"+options_array[i].Quotation_no+"</option>");
                                            }

                                            select_elem = "<select name = 'quotation_no' >"+o_array+"</select>";


                                            $('#qno').html(o_array);
                                    })

                                break;

                                case 'email':

                                $('#client_email').val(attrValue);

                                break;

                            }
                        }        
                    }
                })        
            }
        })
    })

})
</script>
</html>