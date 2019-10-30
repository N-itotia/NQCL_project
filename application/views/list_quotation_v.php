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
			dom:'Bfrtip',
			buttons:[
				{
					text: 'Add New',
					action: function(e, dt, node, config){
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
					},
					className:"green"
				}
			],
			"order":[[4,'desc']],
			"aoColumns": [
			{"sTitle":"+","mData":"Quotation_no",
				"mRender": function ( data, type, row ) {
					return '<a>+</a>';
				},
				"className":"details"
			},
			{"sTitle":"Source","mData":"Quotations_final[].source_status",
				"mRender": function ( data, type, row ) {
					if(data == 0){
						return '<span class="tag is-light">System</span>';
					}
					else if(data == 1){
						return '<span class="tag is-warning">Client New</span>';
					}else if(data == 2){
						return '<span class="tag is-info">Client</span>';
					}
				},
				"className":"details"
			},
			{"sTitle":"Quotation No.","mData":"Quotation_no",
				"mRender":function(data, type, row){
					if(row.Quotations_final[0].print_status == '1'){
						return '<a>'+data+'</a>';
					}
					else{
						return data;
					}
				},
				"className":"quotationView"
			},
			{"sTitle":"Client","mData":"Client_name",
				"mRender": function(data, type, row){
					return '<a>'+data+'</a>';
				},
				"className":"client"
			},
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
				},
			},
			],
			"columnDefs":[
				{"className": "dt-center", "targets": "_all"}
			],
		"bScrollCollapse":true,
		"bDeferRender":true,
		"bProcessing":true,
		"destroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()?>quotation/getlist',
		initComplete:function(settings, json){
			$(this).DataTable().buttons().container().insertBefore('#list_quotation_filter')
		}
	});


	//Add buttons to table
	//qtable.buttons().container().insertBefore('#list_quotation_filter');
	
	//Add New Entry to Quotation
	 $('#list_quotation tbody').on("click", "a.add_entry", function (e) {
		 
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
                'afterClose':function(){
                  	qtable.ajax.reload();
                }
            })
        })


	 $('#list_quotation tbody').on("click", "td.client", function (e) {
		 
			
	 		//Get row,tr
			var tr = $(this).closest('tr');
        	var row = qtable.row( tr );

			//Get quotation no
			quotation_no = row.data().client_id;


			e.preventDefault();
            var href = '<?php echo base_url() . "quotation/editClient/" ?>'+quotation_no;
			
			console.log(href);
			
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 850,
                'afterClose':function(){
                  	qtable.ajax.reload();
                }
            })
        })



	 //Print to Pdf
	 $('#list_quotation tbody').on("click", "td.quotationView", function (e) {
		 

	 		//Get row,tr
			var tr = $(this).closest('tr');
        	var row = qtable.row( tr );

			//Get quotation no
			quotation_no = row.data().Quotation_no;
			
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
	 $('#list_quotation tbody').on("click", "a.print", function (e) {
		 
			//Get quotation no
			quotation_no = $(this).attr("data-id");
			
			e.preventDefault();
            var href = '<?php echo base_url() . "quotation/quotationExtras/" ?>'+quotation_no;
			
			console.log(href);
			
            $.fancybox.open({
                href: href,
                type: 'iframe',
                width: 1200,
                'afterClose':function(){
                 	qtable.ajax.reload();
                }
            })
        })

	
	//Child Row Display
	$('#list_quotation tbody').on("click","td.details", function(e){
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

