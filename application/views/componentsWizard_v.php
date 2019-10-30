<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <?php
    $userarray = $this->session->userdata;
	$user_id = $userarray['user_id'];
    ?>

        <form id = "methods">
            <?php foreach ($components as $component) { ?>
                <fieldset>
                    <legend>Choose method for <?php echo ucfirst($test_name)." (".$component->name.")"; ?></legend>
                    <ul class = "no_style">
                        <?php foreach ($methods as $method) { ?>
                            <li  id ="method-<?php echo $method->name ?>"  >
                                <label for = "<?php echo $method->name ?>" >
                                    <input class = "methodRadios"  type = "radio" data-name = "<?php echo $method->name ?>" name = "component<?php echo $component->id ?>" value = "<?php echo $method->name ?>" title = "<?php echo $method->name ?>"  data-component = "<?php echo $component->name ?>"  />
                                    <?php echo $method->name ?>
                                </label>
                            </li>	
                        <?php } ?>
                    </ul>
                    <input type ="hidden" value ="<?php echo $component->id ?>" name = "component_ids[]" /> 
                </fieldset>
        
            <?php } ?>
                <fieldset>
                    <legend>Enter Limits</legend>
                    <label>
                        <textarea class = "limits" name="limits" placeholder="e.g 2.89% - 5.90%" ></textarea>
                    </label>
                </fieldset>
            <?php if(count($components) < 2) { ?>
                <fieldset>
                    <legend>Save Component</legend>
                </fieldset>
            <?php }?>    
        </form>
    

    <script type = "text/javascript" >
		
        $(function() {
console.log("rt");
            //Assign Jwizard configurations/initialization options to a variable.
            $('#methods').jWizard({
                menu: false,
                finishButtonType: 'submit'
            });

            //Call variable holding JWizard option

    //Initialize array to hold methods
            var methodsArray = [];


    //Set last_component to id of last element in $componentz array
            var last_component;

            /*On clicking a radio button in the fieldset of the last component in the wizard
             Loop through all the checked radio buttons , push the values of the data-name and data-component attributes to
             the methods array 
             */

            /*$('input[name = "component'+last_component+'"]').on("click", function(){
             $('<div></div>').appendTo('body').html('<p>Are you sure of your selection of methods?</p>').dialog({
             resizable:false,
             modal:true,
             buttons:{
             "Yes":function(){
             $('#methods input[type = "radio"]:checked').each(function(){
             method = $(this).attr("data-name");
             component = $(this).attr("data-component");
             var newPairing = {};
             newPairing[component] = method;
             methodsArray.push(newPairing);	
             })	
             console.log(methodsArray);
             $(this).dialog('close');
             },
             "No":function(){
             $(this).dialog('close');
             }
             }
             })
             })*/


            /*$('#selection_summary').dataTable({
             "bJQueryUI":true,
             "aaData":methodsArray,
             "aoColumns":[
             {"sTitle":"Name", "mData":"name"},
             {"sTitle":"Name", "mData":"name"},
             {"sTitle":"Name", "mData":"name"},
             ],
             "sScrollY": "300px",
             "sScrollX": "100%",
             "bDeferRender":true,
             "bProcessing":true,
             "bDestroy":true,
             "bLengthChange":true,
             "iDisplayLength":16
             //"sAjaxDataProp": "",
             //"sAjaxSource": methodsArray.json
         
             });*/


    //Submit #methods form data
            $('#methods').submit(function(e) {
                e.preventDefault();
                var saveMethods_href = '<?php echo base_url() . "request_management/updateMethods/" . $reqid . "/" . $test_id. "/".$user_id ?>';
                console.log(saveMethods_href)
				$.ajax({
                    type: 'POST',
                    url: saveMethods_href,
                    data: $('#methods').serialize(),
                    dataType: "json"
                }).done(function(response) {
                   
				   var table = 'request';
				   //var components_count = "<?php echo count($components) ?>";
				   var components_count = 1;
				   
				   href = '<?php echo base_url()."quotation/chooseSystem/$reqid/request/tests/client_billing/$client_id";?>'
				   
				   if(components_count > 1){
					   		parent.$.fancybox.open({
                            href:href,
                            type: 'iframe',
                            autoSize:false,
                            autoDimensions:false,
                            width:700,
                            height:490,
                            'beforeClose':function(){
                                //getData();
                            }
                         })
				   }
				   else{

					   var this_page = '<?php echo base_url() . "analyst_controller" ?>';
					   parent.location.href = this_page;
					   console.log(this_page)
					}
								
                }).fail(function(response){
                });
            })

        })
    </script>

</html>