<table id = "list_quotation_invoices">
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
		
		
		//Attach DataTable
		var childTable= $('#list_quotation_invoices').DataTable({
			"order":[[3,'asc']],
			"aoColumns": [
			{"sTitle":"Invoice Id.","mData":"Quotations_id",
				"mRender":function(data, type, row){
					return '<a>'+data+'</a>';
				},
				"className":"viewQuotationEntry"
			},
			{"sTitle":"Product","mData":"Sample_name"},
			{"sTitle":"Amount","mData":"Amount",
				"mRender": function (data, type, row) {
                    return accounting.formatMoney(data, { format: "%v" }); 
                },
                "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFFF0", "color":"black"});
				}
			},
			{"sTitle":"Batch","mData":"Batch_id"},
			{"sTitle":"NDQ Ref.","mData":"ndq_ref",
				"mRender": function (data, type, row) {
                    if(data != null){
                    	return data
                    }
                    else{
                    	return '<a class = "add_ref" title=" Add NDQD Number attached to this quotation."  data-id= '+row.Quotations_id+'>Add</a>'	
                    }
                },
                "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFFF0", "color":"black"});
				}
			},
			{"sTitle":"Actions","mData":"Quotations_id",
				"mRender": function (data, type, row) {
                    return '<a class = "edit_quotation"  data-id= '+data+'>Edit</a>&nbsp;|&nbsp;<a class = "print_quotation"  data-id= '+data+'>Print</a>';
                }
			},
			{"sTitle":"Currency","mData":"Currency", "visible":false},
			],
			"columnDefs":[
				{"className": "dt-center", "targets": "_all"}
			],
			"sDom": 'lfrtip',
			"bJqueryUI":false,
			"filtering":false,
			"searching":false,
			"info":false,
			"paging":false,
			"ordering":false,
			"sAjaxDataProp": "",
			"sAjaxSource": '<?php echo base_url()."quotation/getInvoices/"?>'
		});
		
		//Add Reference to Quotation
		 $('#list_quotation_invoices tbody').on("click", "a.add_reference", function (e) {
			 
				//Get quotation no
				quotation_no = $(this).attr("data-id");
				
				e.preventDefault();
	            var href = '<?php echo base_url() . "quotation/add_reference/" ?>'+quotation_no;
				
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

		 	//Add New Entry to Quotation
		 $('#list_quotation_invoices tbody').on("click", "a.edit_quotation", function (e) {
			 
				//Get quotation no
				quotation_no = $(this).attr("data-id");
				
				e.preventDefault();
	            var href = '<?php echo base_url() . "quotation/edit/" ?>'+quotation_no;
				
				console.log(href);
				
	            $.fancybox.open({
	                href: href,
	                type: 'iframe',
	                autoSize: false,
	                autoDimensions: false,
	                width: 360,
	                'afterClose':function(){
	                	childTable.ajax.reload();	
	                }
	            })
	        })


		 //Print Quotation Breakdown to Pdf
		 $('#list_quotation_invoices tbody').on("click", "td.viewQuotationEntry", function (e) {
		
	 		//Get row,tr
			var tr = $(this).closest('tr');
        	var row = childTable.row( tr );

			//Get quotation id
			quotation_no = row.data().Quotations_id;
			
			e.preventDefault();
            var href = '<?php echo base_url() . "client_billing_management/showBillPerTest/" ?>'+quotation_no+'/quotations/tests/q_request_details/q_entry/invoice';


			console.log(href);
			
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 900,
                height: 1200
                //'beforeClose':function(){
                //getData();
                //}
            })
        })


		 //Print Quotation
		 $('#list_quotation_child_invoices tbody').on("click", "a.print_quotation", function (e) {
			 
				//Get quotation no
				quotation_no = $(this).attr("data-id");
				
				e.preventDefault();
	            var href = '<?php echo base_url() . "quotation/printSingleQuotation/" ?>'+quotation_no;
				
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

	})
</script>

