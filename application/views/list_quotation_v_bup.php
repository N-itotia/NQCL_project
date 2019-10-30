<table id = "list_quotation">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>

<script type="text/javascript">

	//Datatable Definition
	$(function(){
	var qtable = $('#list_quotation').DataTable({
			dom:'T<"clear">lfrtip',
			tableTools:{
				"aButtons":[
				{
					"sExtends":"text",
					"sButtonText": "Generate New",
					"fnClick":function(nButton, oConfig, oFlash){
						var href = '<?php echo base_url() . "quotation/generate" ?>';
				            $.fancybox.open({
				                href: href,
				                type: 'iframe',
				                autoSize: false,
				                autoDimensions: false,
				                width: 360,
				                'afterClose':function(){
				                	$('#list_quotation').DataTable().ajax.reload();
				                }
				            })
					}
				}
				]
			},
			"order":[[4,'desc']],
			"aoColumns": [
			{"sTitle":"+","mData":"Quotation_no",
				"mRender": function ( data, type, row ) {
					return '<a class = "childToggle" data-id= '+row.id+' href="<?php echo base_url() ?>quotation/getQuotationEntries/'+data+'">+</a>';
				}
			},
			{"sTitle":"Quotation No.","mData":"Quotation_no",
				"mRender":function(data, type, row){
					if(row.Quotations_final[0].print_status == '1'){
						return '<a class = "viewQuotation" data-id= '+data+'>'+data+'</a>';
					}
					else{
						return data;
					}
				}
			},
			{"sTitle":"Client","mData":"Client_name"},
			{"sTitle":"Entries No.","mData":"Quotations_final[].quotation_entries"},
			{"sTitle":"Currency","mData":"Currency"},
			{"sTitle":"Amount","mData":"Quotations_final[].amount",
				"mRender": function ( data, type, row ) {
					return accounting.formatMoney(data, { format: "%v" });
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFFF0", "color":"black"});
				}	
			},
			{"sTitle":"Reporting Fee (%)","mData":"Quotations_final[].reporting_fee",
				"mRender": function ( data, type, row ) {

					percentage = data + "% (";
					amount = data * row.Quotations_final[0].amount / 100;

					return "+ "+ percentage + accounting.formatMoney(amount, { format: "%v" }) + ")";
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFFF0", "color":"black"});
				}		
			},
			{"sTitle":"Admin Fee","mData":"Quotations_final[].admin_fee",
				"mRender": function ( data, type, row ) {
					return accounting.formatMoney(data, { format: "%v" });
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFFF0", "color":"black"});
				}		
			},
			{"sTitle":"Discount(%)","mData":"Quotations_final[].discount",
				"mRender": function ( data, type, row ) {
					percentage = data + "% (";
					amount = data * row.Quotations_final[0].amount / 100;

					return "- "+ percentage + accounting.formatMoney(amount, { format: "%v" }) + ")";
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFFF0", "color":"black"});
				}			
			},
			{"sTitle":"Payable Amount","mData":"Quotations_final[].payable_amount",
				"mRender": function ( data, type, row ) {
					return accounting.formatMoney(data, { format: "%v" });
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFBB0", "color":"black"});
				}
			},
			{"sTitle":"Quotation Status","mData":"Quotations_final[].Quotation_status.status",
				"mRender": function ( data, type, row ) {
					return data;
				}	
			},
			{"sTitle":"Actions","mData":"Quotation_no",
				"mRender": function ( data, type, row ) {
					if(row.Quotations_final[0].quotation_entries < 2){
						return '<a class = "add_entry" data-id= '+data+'>Add Entry</a>' + ' | ' + '<a class = "print"  data-id= '+data+'>Pdf</a>';
					}
					else{
						return '<a class = "add_entry" data-id= '+data+'>Add Entry</a>' + ' | ' + '<a class = "print"  data-id= '+data+'>Print</a>';
					}
				}
			}
			],
		"bJQueryUI":true,
		"bScrollCollapse":true,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()?>quotation/getlist'
	});
	
	//Add New Entry to Quotation
	 $('.add_entry').on("click", function (e) {
		 
			//Get quotation no
			quotation_no = $(this).attr("data-id");
			
			e.preventDefault();
            var href = '<?php echo base_url() . "quotation/generate/add/" ?>'+quotation_no;
			
			console.log(href);
			
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 360,
                //'beforeClose':function(){
                //getData();
                //}
            })
        })


	 //Print to Pdf
	 $('.viewQuotation').on("click", function (e) {
		 
			//Get quotation no
			quotation_no = $(this).attr("data-id");
			
			e.preventDefault();
            var href = '<?php echo base_url() . "quotations/" ?>'+'Quotation_'+quotation_no+'.pdf';
			
			console.log(href);
			
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 600,
                height: 800
                //'beforeClose':function(){
                //getData();
                //}
            })
        })


	 //Print to Pdf
	 $('.print').on("click", function (e) {
		 
			//Get quotation no
			quotation_no = $(this).attr("data-id");
			
			e.preventDefault();
            var href = '<?php echo base_url() . "quotation/quotationExtras/" ?>'+quotation_no;
			
			console.log(href);
			
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 360,
                //'beforeClose':function(){
                //getData();
                //}
            })
        })

	
	//Child Row Display
	$('.childToggle').on("click", function(e){
		e.preventDefault();
		
		//Get row,tr
		var tr = $(this).closest('tr');
        var row = qtable.row( tr );
		
		
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
                url: "<?php echo base_url()?>quotation/listallchildren/"+row.data().Quotation_no,
                 
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

	})
</script>

