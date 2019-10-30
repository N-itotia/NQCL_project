
<div><legend><span class = "link_highlight" >Charges Breakdown&nbsp;|&nbsp;<?php echo $rid; ?>&nbsp;|&nbsp;</span><span id = "total" ></span></legend></div>

<?php
//Set currency
$c = $currency[0]['Currency']; 

?>

<hr>
					<table id = "breakdown">
						<thead>
							<tr>
							</tr>
						</thead>
						<tbody>
							<tr>
							</tr>
						</tbody>
					</table>
	<?php if($client_id != 'q_entry'){?>
	<form class = "methods">
		<ul>
			<li>
				<fieldset>
					<legend>Finish</legend>
						<li>
							<label>
								<span>
									<input type = "button" data-submitId = "print_later" class = "submit-button leftie print_invoice" value = "Next Quotation Entry" data-table = "<?php echo $table; ?>"
									<hr>
									<input type = "button" data-submitId = "print_now" class = "submit-button-alt print_invoice" value = "Print Quotation So far" data-table = "<?php echo $table; ?>" />
									<hr>
									<input type = "button" data-submitId = "view_all" class = "submit-button-alt print_invoice" value = "View All Quotations" data-table = "<?php echo $table; ?>" />
								</span>
							</label>
						</li>
				</fieldset>
			</li>
		</ul>
	</form>
	<?php }?>
<script type="text/javascript">

$(document).ready(function(){


	//Convert PHP array of multicomponent tests to Javascript Array
	var multiTestsArray = [<?php echo json_encode($multi_tests); ?>]
	mt_array = multiTestsArray.toString();
	
	//Datatable
	 var ttable = $('#breakdown').DataTable({
		"aoColumns": [
			{"sTitle":"Test","mData":"tests[].id",
				"mRender":function(data, type, row){
					return '<a>+</a>';
				},
				"className":"rowDetails"
			},
			{"sTitle":"Test","mData":"tests[].Name"},
			{"sTitle":"Compendia","mData":"compendia[].name"},
			{"sTitle":"Method","mData":"test_methods[].name",
				"mRender":function(data, type, full){
					if(data == ''){
						return 'N/A';
					}
					else{
						return data;
					}
				}
			},
			{"sTitle":"Method Charge (<?php echo $c; ?>)","mData":"method_charge",
				"mRender":function(data, type, full){
					if(data == 0){
						return 'N/A';
					}
					else{
						return accounting.formatMoney(data, { format: "%v" });
					}
				}
			},
			{"sTitle":"Test Total (<?php echo $c; ?>)","mData":null,
				"mRender":function(data, type, row){
					return accounting.formatMoney(parseInt(row.method_charge), { format: "%v"}); 
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			}],
			"columnDefs":[
				{"className": "dt-center", "targets": "_all"}
			],
		"bJQueryUI":true,
		"bScrollCollapse":true,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"paging":false,
		"bFilter":false,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/breakdown/$rid/$table/$table2/$table3/$client_id"?>',
		"fnFooterCallback":function(nRow, aaData, iStart, iEnd, aiDisplay){
			//Initialize variable to hold total
			var total = 0;
			var table = "<?php echo $table ?>";

			//Loop through data in table while doing addition of method and tests charges
			for(var i =0; i<aaData.length; i++){
				total += parseFloat(aaData[i].method_charge) + parseFloat(aaData[i].test_charge);
			}
			//Format total as money,currency
			f_total = accounting.formatMoney(total, {symbol : "<?php echo $c; ?>", format: "%s %v" });
			
			if(table == "request"){
				//Set total to specified selector
				$('#total').html(f_total);

				discount =10;

				$('#discount_tag').html('10%');

				discounted_f = total*90/100;

				discounted = accounting.formatMoney(discounted_f, {symbol : "<?php echo $c; ?>", format: "%s %v" });

				$('#discounted').html('<b>'+discounted+'</b>');
			}
			else{
				$('#total').html('<b>'+f_total+'</b>');
				$('#discount_tag').html('0%');
				$('#discounted').html('<b>'+f_total+'</b>');
			}
		}
	});


	//Child Row , Methods Display
	$('#breakdown tbody').on("click", "td.rowDetails" function(e){
		e.preventDefault();

		//Get test id
		var test_id = $(this).attr("data-id");
		
		//Get row,tr
		var tr = $(this).closest('tr');
        var row = ttable.row( tr );
		
		//Open, close row
		if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
			$(this).text('+');
        }
        else {
			
			/*https://datatables.net/forums/discussion/31107/load-child-rows-from-external-data-source-in-html*/
			$.ajax({
                type: 'GET',
                url: '<?php echo base_url()."quotation/listallComponentMethods/".$rid."/"?>'+test_id+'<?php echo "/$table/$c"; ?>',
                 
                success: function (response) {
                    row.child( response ).show();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    row.child( 'Error loading content: ' + thrownError ).show();
                }
            });
            tr.addClass('shown');
			$(this).text('-');
        }
		
	})






$('.print_invoice').live("click", function(){
	
	submit_id=  $(this).attr("data-submitId");
	console.log(submit_id);
	
	table = $(this).attr("data-table");
	console.log(table)

	
	if(table == 'request'){
	    	href = '<?php echo base_url()."quotation/invoiceExtras/$rid/$table/$table2/$table3/"; ?>'
			save_url = '<?php echo base_url()."quotation/saveProforma/$rid/$table/$table2/$table3/"; ?>'
	}
	else if(table == 'quotations'){
		if(submit_id == 'print_now') {
			href = '<?php echo base_url()."quotation/quotationExtras/$qt_no/$table/$table2/$table3/"; ?>'
			save_url = '<?php echo base_url()."quotation/saveQuotation/$rid/$table/$table2/$table3/"; ?>'
		}
		else if(submit_id == 'view_all'){
			href = '<?php echo base_url()."quotation/listall/"; ?>' 
			save_url = '<?php echo base_url()."quotation/saveQuotation/$rid/$table/$table2/$table3/"; ?>'
		}
		else if(submit_id == 'print_later'){
			href = '<?php echo base_url()."quotation/generate/$rid/$table/$table2/$table3/"; ?>' + "/<?php echo $qt_no;?>" 
			save_url = '<?php echo base_url()."quotation/saveQuotation/$rid/$table/$table2/$table3/"; ?>'
		}
	}
	else if(table == "invoice"){
		href = '<?php echo base_url()."quotation/invoiceExtras/$rid/$table/$table2/$table3/"; ?>'
		save_url = '<?php echo base_url()."quotation/saveInvoice/$rid/$table/$table2/$table3/"; ?>'
	}

	$.ajax({
		type:'POST',
		url: save_url
	}).done(function(response){

		//Depending on button clicked redirect appropriately
		if(submit_id =='print_now'){
			parent.$.fancybox.open({
		        href: href,
		        type: 'iframe',
		        autoSize: false,
		        height: 842,
		        width: 595,
		        'afterClose':function(){
				    $('#list_quotation').DataTable().ajax.reload();
				}
            })
		}
		else{
			parent.$.fancybox.close();
			parent.location.href = href;
		}	
	})
})

})


</script>
