

<script type="text/javascript">


function getData(i){
      db_data =''; 
	if (typeof rtable == 'undefined') {
		var rtable = $('#requests2').DataTable({
		/*"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(aData.split_status == "1" && aData.assign_status == "2"){
				$('td',nRow).css('background-color', '#f8b88e');
			}
			else if(aData.split_status == "1" && aData.assign_status == "0"){
				$('td',nRow).css('background-color', '#f9ddca');	
			}
			console.log(aData.assign_status);
		},*/
		
		//If Sample is already assigned, colour code entry a light green.
		"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(aData.assign_status == "1" ){
				$('td',nRow).css('background-color', '#d5edcd');
			}
		},
		"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(unit != '5'){
				$('td a', nRow).not('.more_info, .s_u, .s_ue,.s_uee,.a_detail').replaceWith('<span>N/A</span>');
			}
		},	
	"dom": 'C<"clear">lfrtip',		
	"bJQueryUI": true,
	"scrollX": true,
	"order": [[ 0, "desc" ]],
	"aoColumns": [
	{"sTitle":"id","mData":"id","visible":false,"bSortable":true},
	{"sTitle":"Reference Number","mData":"request_id"
        ,"mRender":function(data, type, row){
			//if(row.assign_status == "0" && row.quotation_status == "0"){
				return '<a class="a_detail" href = "#'+row.request_id+'" id = '+row.request_id+' >'+row.request_id+'</a>';
			/*}
			else{
				return 'N/A';
			}*/
		}},
	{"sTitle":"Product Name","mData":"product_name"},
	{"sTitle":"Active Ingredient","mData":"active_ing"},
	{"sTitle":"Batch No.","mData":"Batch_no"},
	{"sTitle":"Client Ref No.","mData":"clientsampleref"},
	{"sTitle":"Client", "sClass":"client","mData":"Clients.Name"},
	{"sTitle":"Manufacturer","mData":"Manufacturer_Name"},
	{"sTitle":"Date of Manufacture","mData":"Manufacture_date"},
	{"sTitle":"Date of Expiry","mData":"exp_date"},
	{"sTitle":"Date Received","mData":"Designation_date"},
	{"sTitle":"UpdateSample Details","mData":null, 
            	"fnCreatedRow":function(nRow, aData, iDataIndex) {
                 
//                        $.ajax({
//        type:"get",
//        url: "<?php echo base_url(); ?>request_management/check_su_stat/",
//        dataType: "json",
//        success:function(d){
//            alert(
//          $.each(d, function(i, row){
//            if(row.labref == aData[0]){
//                 $(nRow).css("background","yellow");	
//            }else{
//                 $(nRow).css("background","green");	
//            }
//          })
//     
//    },error:function(){
//    }
//    });
                    
		   				
			},
		"mRender":function(data, type, row){
			//if(row.assign_status == "0" && row.quotation_status == "0"){
				//<a class="s_u" href = "#sample_update" id='+row.request_id+' >+Add </a> || 
				return '<a class="s_ue" href = "#Edit_log" id='+row.request_id+' >+Add</a> || <a class="s_uee" href = "#Edit_log_1" id='+row.request_id+' >Edit</a>';
                                
			/*}
			else{
				return 'N/A';
			}*/
		}
	},
        
	{"sTitle":"Assign Status","mData":"assign_status",
		"bVisible":false,
		"mRender":function(data,type,row){
			if(data == "0"){
				return 'Unassigned';
			}
			else if(data == "1"){
				return 'Fully Assigned';
			}
			else if(data == "2"){
				return 'Partially Assigned'
			}
		},
	},
	{"sTitle":"Quantity","mData":null,
	     "mRender":function(data, type, row){
	     	if(row.Packaging != null){
	     		return row.sample_qty + " " + row.Packaging.name;
	     	}
	     	else{
	     		return " ";
	     	}
	     }
	 },
	{"sTitle":"Priority","mData":"priority"},
    {"sTitle":"Quote","mData":null,
     "mRender":function(data, type, row){
	     	if(row.quotation_status == '0'){
	     		if(row.component_status == '0' ){
	     			return '<a class="quote" id = '+row.request_id+' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = '+row.client_id+' >Quote</a>';
	     		}
	     		else{
	     			if(row.coa_done_status  == '0'){
	     				return '<a class="set_components" id = '+row.request_id+' >Quote</a>';
	     			}
	     		}
	     			
	     	}
	     	else{
	     		return '<a class="quoted" id = '+row.request_id+' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = '+row.client_id+' >View</a>';
	     	}
	     }

    	 

 	},
	{"sTitle":"Edit","mData":"id",

		"mRender":function(data, type, row){
			if(row.assign_status == "0" && row.quotation_status == "0"){
				return '<a class="edit" href = "<?php echo base_url()."request_management/edit/" ?>'+row.request_id+'" id = '+row.request_id+' >Edit</a>';
			}
			else{
								return '<a class="edit" href = "<?php echo base_url()."request_management/edit/" ?>'+row.request_id+'" id = '+row.request_id+' >Edit</a>';

				//return 'N/A';
			}
		}
	},

	{"sTitle":"More Info","mData":"id",
		"mRender":function(data, type, row){
			return '<a class="more_info" href = "<?php echo base_url()."request_management/more_info/" ?>'+row.request_id+'" id = '+row.request_id+' >More Info</a>';
		}
	},


	{"sTitle":"Print Label","mData":"id",
		"mRender":function(data, type, row){
			if(row.label_status == "0"){	
				return '<a class = "labels" id = '+data+' data-labelstatus = '+row.label_status+' data-printsno = '+row.sample_qty+' data-reqid ='+row.request_id+' >Print</a>';
			}
			else{
				return '<a class = "labels" id = '+data+' data-labelstatus = '+row.label_status+' data-printsno = '+row.sample_qty+' data-reqid ='+row.request_id+' >View</a>';
			}
		}
	},
	{"sTitle":"Assign","mData":"id",
		"mRender":function(data, type, row){
			if(row.coa_done_status != 1){
				return '<a class = "assign" id = '+data+' data-reqid ='+row.request_id+' data-client = '+row.client_id+' >Assign</a>';
			}
			else{
				return 'N/A';
			}
		}
	},
	{"sTitle":"Invoice","mData":"id",
		"mRender":function(data, type, row){
			if(row.invoice_status != 1){
				return '<a class = "invoice" id = '+data+' data-reqid ='+row.request_id+' data-client = '+row.client_id+' data-table1 = "invoice" data-table2 = "tests" data-table3 = "request_details" >Show</a>';		
			}
			else{
				return '<span class = "gray_out" >Pending</span>';
			}
		}
	},
		{"sTitle":"Compliance","mData":"compliance"},

	],
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"bStateSave":true,
	"iDisplayLength":10,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."request_management/getAllClientsReport"?>',		
		});
	}
else {
	rtable.fnDraw();
	}

	



}

$(document).ready(function(){
getData();
})

</script>