<html>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <body>
        <form id = "methods" class = "method_samthing"  >
            <?php foreach ($tests as $test) { ?>
                <fieldset>
                    <legend class = "small-text"><?php echo $reqid; ?>&nbsp;|&nbsp;<?php echo $sample_info[0]['Clients']['Name']; ?></legend>
                    
                    <p>
                    <span class="smalltext misc_text">Compendia for <?php echo $test['Name'] ?></span>
                    <select name="compendia_<?php echo $test['id'] ?>" class ="compendia" >
                        <option data-name="" >--</option>
                        <?php foreach($compendia as $c) {?>                            
                            <option data-name = "<?php echo $c['id']; ?>" value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
                        <?php }?>
                    </select>
                    </p>
                    
                    <p>                    
                    <span class = "smalltext misc_text" ><?php echo $sample_info[0]['product_name']; ?>&nbsp;|&nbsp;Choose method for <?php echo $test['Name'] ?></span>
                    </p>
                    <?php 
	
					/*If components are more than one, show breakdown*/
					if(count($components) > 1 && in_array($test['id'], $mc_tests)) { foreach ($components as $component){ ?>
					
                    <span class = "smalltext misc_text"><?php echo $component['component'] ?></span>
                    <ul  class = "no_style" >
                        <?php foreach ($test['Test_methods'] as $method) { ?>
                            <li id ="method-<?php echo $method['id'] ?>"  > 
                                <label for = "<?php echo $method['id'] ?>" >
                                    <input class = "methodRadios" data-cost ="<?php echo $method[$charge] ?>" type = "radio" data-name = "<?php echo $method['name'] ?>" name = "methods_<?php echo str_replace(' ', '_', $component['component'] ); ?>_<?php echo $test['id']; ?>" value = "<?php echo $method['id'] ?>" title = "<?php echo $method['name'] ?>"  data-test = "<?php echo $method['test_id'] ?>"  />
                                    <?php echo $method['name'] ?>&nbsp;<span class ="charge" id ="charges<?php echo $method['id']; ?>" ></span>
                                </label>
                            </li>
                            <script>
                                //Format values as currency
                                 formattedMoney = accounting.formatMoney("<?php echo $method['charge']; ?>",{ symbol:"KES", format: "%s %v" } );
                                 $("#charge<?php echo $method['id']?>").text(formattedMoney);
                            </script>	
                        <?php } ?>
                            <li id="method-42">
                                <label for = "42">
                                    <input class="methodRadios" data-cost="0" type="radio" data-name="none" name="methods_<?php echo str_replace(' ', '_', $component['component'] ); ?>_<?php echo $test['id']; ?>" value="42" title="none" data-test = "<?php echo $method['test_id'] ?>" /> None
                                </label>
                            </li>
                    </ul>
                    <?php } } else {?>
                        <ul  class = "no_style" >
                        <?php foreach ($test['Test_methods'] as $method) { ?>
                            <li id ="method-<?php echo $method['id'] ?>"  > 
                                <label for = "<?php echo $method['id'] ?>" >
                                    <input class = "methodRadios" data-cost ="<?php echo $method[$charge] ?>" type = "radio" data-name = "<?php echo $method['name'] ?>" name = "methods_<?php echo $test['id']; ?>" value = "<?php echo $method['id'] ?>" title = "<?php echo $method['name'] ?>"  data-test = "<?php echo $method['test_id'] ?>"  />
                                    <?php echo $method['name'] ?>&nbsp;<span class ="charge" id ="charges<?php echo $method['id']; ?>" ></span>
                                </label>
                            </li>
                            <script>
                                //Format values as currency
                                 formattedMoney = accounting.formatMoney("<?php echo $method['charge']; ?>",{ symbol:"KES", format: "%s %v" } );
                                 $("#charge<?php echo $method['id']?>").text(formattedMoney);
                            </script>   
                        <?php } ?>
                            <li id="method-42">
                                <label for = "42">
                                    <input class="methodRadios" data-cost="0" type="radio" data-name="none" name = "methods_<?php echo $test['id']; ?>" value="42" title="none" data-test = "<?php echo $method['test_id'] ?>" /> None
                                </label>
                            </li>

                    </ul>
                     <?php } ?>
                    <input type = "hidden" name ="tests[]" value = "<?php echo $test['id'] ?>" />
                </fieldset>
            <?php } ?>
            <fieldset>
                <legend class="small-text"><?php echo $reqid; ?>&nbsp;|&nbsp;<?php echo $sample_info[0]['Clients']['Name'];?>&nbsp;|&nbsp;<?php echo $sample_info[0]['product_name']; ?> Method Summary</legend>
                <div>
                    <table id="methods_summary">
                        <thead>
                            <tr>
                                <th>Test</th>
                                <th>Compendia</th>
                                <th>Method(s)</th>
                                <!--th>Test Total (KES)</th-->
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; foreach($tests as $test){ ?>
                            <tr>
                                <td><?php echo $test['Name'] ?></td>
                                <td id="compendia_<?php echo $test['id'] ?>"></td>
                                <td id="method_component_summary">
                                    <table class="components_summary" id="methods_summary_<?php echo $test['id'] ?>">
                                        <?php if($i==0){?>
                                            <thead>
                                                <th>Component</th>
                                                <th>Method</th>
                                                <th>Cost (<?php echo $currency; ?>)</th>
                                            </thead>
                                        <?php } ?>
                                            <tbody>
                                                <?php if(count($components) > 1 && in_array($test['id'], $mc_tests )) {foreach ($components as $component){ ?> 
                                                    <tr>
                                                            <td><?php echo $component['component'] ?></td>
                                                            <td id="methods_<?php echo str_replace(' ', '_', $component['component'] )."_".$test['id']?>"></td>
                                                            <td class="cost" id="methods_<?php echo str_replace(' ', '_', $component['component'] )."_".$test['id']?>_cost"></td>
                                                    </tr>    
                                                <?php } } else { ?>            
                                                    <tr>
                                                            <td><?php echo $sample_info[0]['product_name']?></td>
                                                            <td id="methods_<?php echo $test['id']?>"></td>
                                                            <td class="cost" id="methods_<?php echo $test['id']?>_cost"></td>
                                                    </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                    <script type="text/javascript">
                                            $('#methods_summary').DataTable({
                                                "footerCallback": function(tfoot, data, start, end, display){
                                                    var api = this.api();
                                                    $(api.column(2).footer()).html(
                                                        api.column(2).data().reduce(function(a,b){
                                                            return a + b;
                                                        }, 0)
                                                    )
                                                },
                                                "sDom": 'lfrtip',
                                                "bJqueryUI":false,
                                                "filtering":false,
                                                "searching":false,
                                                "info":false,
                                                "paging":false,
                                                "ordering":false
                                            });
                                    </script>
                                </td>
                                <!--td class ="tests_summary" id="test_summary_<?php //echo $test['id'] ?>"></td-->
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td id="grand_total"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </fieldset>
        </form>
    </body>
</html>

<script type = "text/javascript" >
    $(function() {


    //Format Methods Summary Table
    $('#methods_summary').DataTable({
        "sDom": 'lfrtip',
        "bJqueryUI":false,
        "filtering":false,
        "searching":false,
        "info":false,
        "paging":false,
        "ordering":false
    });




    //Assign Jwizard configurations/initialization options to a variable.    
            $('#methods').jWizard({
                menu: false,
                finishButtonType: 'submit'
            });


    //Submit #methods form data
            $('#methods').submit(function(e) {
                e.preventDefault();
                var saveMethods_href = '<?php echo base_url() . "tests_management/updateClientBilling/" . $reqid . "/". $table ."/". $client_id ?>';
                $.ajax({
                    type: 'POST',
                    url: saveMethods_href,
                    data: $('#methods').serialize()
                }).done(function(response) {
                    var table = '<?php echo $table; ?>';
                    var components_count ='<?php echo $components_count ?>';
                    console.log(components_count);
                        //If sample is multicomponent, redirect to page to choose system of payment
                        /*if(components_count > 1){
                            href = '<?php //echo base_url()."quotation/chooseSystem/$reqid/$table/$table2/$table3/$client_id" ?>'
                        }
						//if sample is not multicomponent, show breakdown of test charges depending on the referring url i.e whether its a quotation or an invoice
                        else{*/
							if(table == 'quotations'){
								href = '<?php echo base_url()."client_billing_management/showBillPerTest/$reqid/$table/$table2/$table3/$client_id" ?>' 
							}
							else if (table == 'request'){
								href = '<?php echo base_url()."client_billing_management/showBillPerTestQuotation/$reqid/$table/$table2/$table3/$client_id" ?>'
							}
						//}

                        //If executing from quotations without request id or for sample with request id
                       // if(table != 'request'){
                       //$.fancybox.close();
                        var this_page = '<?php echo base_url() . "request_management" ?>'
                        console.log(table);
                        console.log(href);
                        //parent.location.href = this_page;
                   /* }
                    else{ */
					//If referring url table is request do not open fancybox, instead reload underlying datatable - 'As is for Invoicing at Reviewer Page'
					if(table != 'request'){
                        parent.$.fancybox.open({
                            href:href,
                            type: 'iframe',
                            autoSize:false,
                            autoDimensions:false,
                            width:1200,
                            height:1000,
                            'beforeClose':function(){
                                //getData();
                            }
                         })
					}
					else{
						//If referring url table is not 'request' reload datatable
						//$('#requests').DataTable().ajax.reload();
						parent.$.fancybox.close();
					}
                    //}
                }).fail({
                });
            })


            //On change compendia update summary table with value
            $('.compendia').on("change", function(){
                
                //Select attributes
                compendia_test = $(this).attr('name');
                compendia_value =$(this).find(":selected").text();
                
                //Update summary table
                $('td#'+compendia_test).html('<span>'+compendia_value+'</span');
                console.log(compendia_value);
            })


            //On change method update summary table with method and cost
            $('.methodRadios').on("change", function(){

                //Select attributes

                method_name = $(this).attr('name');
                method_value = $(this).attr('data-name');
                cost_value = $(this).attr('data-cost');


                //Update summary table
                $('td#'+method_name).html('<span>'+method_value+'</span');
                $('td#'+method_name+"_cost").html('<span>'+cost_value+'</span');

                test_total = cost_value


            })

            //console.log(costArray);

            var total = 0;

            $('.jw-button-next').on("click", function(){

                $('.cost').each(function(){

                    c = $(this).find('span').text();

                    if(c){
                         total += parseInt(c) ;
                    }
                    else{
                        total = total;
                    }
                    
                    console.log(total)
                   
                    //console.log(total)
            
                })

                 $('#grand_total').html('<span>'+total+'</span>')
            })
 

            //console.log(total);

           


            //Get total


            //Format all costs
            //formattedMoney = accounting.formatMoney($('.cost').text() ,{ symbol:"KES", format: "%s %v" } );


        })
</script>
