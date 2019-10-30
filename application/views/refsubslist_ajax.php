<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<a href="<?php echo site_url()."inventory/refSublist"; ?>">Reference Substances List</a>&nbsp;|&nbsp;<span class ="link_highlight">Reference Substances Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd"; ?>">Add Reference Substance</a>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd_i"; ?>">Add Reference Substance to Inventory</a></legend>
<div>&nbsp;</div>
<script>
    $(document).ready(function(){
        
 $('#print_data').click(function(){
     $(this).hide();
    $('#selector').slideDown('slow');
    });
    $('#get_report').click(function(){
        status=$('#status_data').val();
        $.ajax({
            type:"get",
            url:"<?php echo base_url() ?>refsubs_printer/generate/"+status,
            success:function(success){
                window.location.href="<?php echo base_url(); ?>refsubs_template/"+status+"_standards.xlsx";
            },error:function(e){
                alert('An error Occurred')
                    }


                });
            })
        });
    

    </script>
    
<div id="selector" class = "hidden2" >
    <select name="status" id="status_data">
        <option value="">--Select Status--</option>
        <option value="Primary">PRS</option>
		<option value="USP">USP</option>
        <option value="Working">WRS</option>
        <option value="Expired">Expired</option>
		<option value="Effective">Effective</option>
		<option value="Duplicated">Duplicated</option>
		<option value="Duplicated-Expired">Duplicated Expired</option>
		<!--option value="New">New</option>
		<option value="New_Batch">New By Batch</option-->
    </select><br>
    <button id="get_report" class = "submit-button">Print</button>
</div>
<div id="certUploadForm" class = "hidden2" >
	<form id = "certBatchUpload" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>Select certificates to upload.</legend>
			<input title = "Certificate should be coded with respective NQCL Code."  type = "file" class = "validate[required]" name ="batch_certs[]" multiple />
		</fieldset>
		<input type = "submit" class = "submit-button leftie" value = "Upload" >
	</form>
</div>

<table id = "refsubs">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>

<div id = "confirm" class = "hidden2" >Are you sure?</div>


<script type="text/javascript">

//Upload files
$('#certBatchUpload').submit(function(e){
	e.preventDefault();
		
		//Check if input is empty
		var inputs = $("#certBatchUpload").find('input').not(':hidden').filter(function(){
			return this.value === "";
		});

	if (inputs.length) {
		n = noty({
			"type":"error",
			"message": "Please select at least one file."
		})

		n;
	}
	
		//If not empty
	else{

		//Get form Data
		form = document.getElementById('certBatchUpload');
		var formData = new FormData(form);

		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."refsubs_management/certBatchUpload" ?>',
			data:formData,
			dataType: "json",
			contentType:false,
			processData:false,
			success:function(response){
				if(response.status === "success"){
					parent.$.fancybox.close();
					$('#refsubs').DataTable().ajax.reload();
				}
				noty({
					"type":response.status,
					"text":response.message
				})
			}

		})


	}
})




var rtable;
function getData(){
	if (typeof rtable == 'undefined') {
	rtable = $('#refsubs').DataTable({
		dom:'T<"clear">lfrtip',
		tableTools:{
			"sRowSelect": "multi",
			"aButtons":[
				{
					"sExtends":"text",
					"sButtonText": "Print labels of selected.",
					"fnClick": function(nButton, oConfig, oFlash) {
							var data = TableTools.fnGetInstance('refsubs');
							
							//Get data from the selected rows
							var selected_data = data.fnGetSelectedData();
							
							//Initialize array to hold refsub ids
							refsub_ids = [];

							//Loop through the selected data
							for(var i=0;i<selected_data.length;i++){

								//Push ids of selected refsubs into above initialized array
								refsub_ids.push(selected_data[i].id);
							}

							//Conver array of ids into a string
							var ids = JSON.stringify(refsub_ids);

							//Replace,remove forward slashes, quotation marks and square brackets and underscores from new string
							sanitized_ids = ids.replace(/[,]/g, "/").replace(/[\[\]""]/g, "").replace(/ /g, "_");
							
							//Remove back slashes to produce single string , to be used as unique identifier for the label.
							label_id = sanitized_ids.replace(/\//g, '');
							
							console.log(label_id);

							//Url to generate pdf
							gen_labels_url = '<?php echo base_url()."refsubs_management/printPdfLabel" ?>' + '/' + selected_data.length +  "/" + label_id + "/" + sanitized_ids
							generated_labels_url = '<?php echo base_url()."labels/refsubs" ?>' + '/' + '<?php echo "Label".date('Ymd'); ?>' + label_id + '.pdf'
							console.log(generated_labels_url);

							//Ajax function to pass ids to above gen url
							$.ajax({
								type:'POST',
								url:gen_labels_url
							}).done(function(response){
								parent.$.fancybox.open({
									href: generated_labels_url,
									type: 'iframe',
									autoSize: false,
									height: 842,
									width: 595
								})
							})
					}
				},
				{
					"sExtends":"text",
					"sButtonText":"Export to Excel",
					"fnClick":function(nButton, oConfig, oFlash){
						$.fancybox.open({
							href:'#selector'
						});
					}
				},
				{
					"sExtends":"text",
					"sButtonText":"Delete selected.",
					"fnClick":function(nButton, oConfig, oFlash){
						var data = TableTools.fnGetInstance('refsubs');
							
						//Get data from the selected rows
						var selected_data = data.fnGetSelectedData();
							
													//Initialize array to hold refsub ids
							refsub_ids = [];

							//Loop through the selected data
							for(var i=0;i<selected_data.length;i++){

								//Push ids of selected refsubs into above initialized array
								refsub_ids.push(selected_data[i].id);
							}

							//Conver array of ids into a string
							var ids = JSON.stringify(refsub_ids);

							//Replace,remove forward slashes, quotation marks and square brackets and underscores from new string
							sanitized_ids = ids.replace(/[,]/g, "/").replace(/[\[\]""]/g, "").replace(/ /g, "_");

							//Url to generate pdf
							delete_url = '<?php echo base_url()."refsubs_management/delete" ?>' + "/" + sanitized_ids

							console.log(delete_url);

							//Confirm
							console.log($('#confirm').dialog({
								resizable:false,
								modal:true,
								title: "Delete standards.",
								buttons:{
									"Yes":function(){
										$(this).dialog("close");

											//Ajax function to pass ids to above gen url
												$.ajax({
													type:'POST',
													url:delete_url
												}).done(function(response){
													noty({
														text: selected_data.length + ' standards deleted successfully.',
														type: 'success',
														timeout:true,
														callback:{
															afterShow: function() {
																window.location.href = '<?php echo base_url() ?>inventory/refSubslist'
															}
															
															}
													})
												})

											},
									"No":function(){
										$(this).dialog("close");
									}
								}

						}));

					}

				},
				{
					"sExtends":"text",
					"sButtonText":"Upload Certificates.",
					"fnClick":function(nButton, oConfig, oFlash){
						$.fancybox.open({
							href:'#certUploadForm',
							autoSize: false,
							autoDimensions : false,
							width:400,
							height: 160,
							'beforeClose' : function(){
								//On close reload DataTable source ajax
								$('#refsubs').DataTable().ajax.reload();
							}
						});
					}
				}
			]
		},		
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"Name","mData":"name"},
	{"sTitle":"Standard Type","mData":"standard_type"},
	{"sTitle":"Source","mData":"source"},
	{"sTitle":"Batch No.","mData":"batch_no"},
	{"sTitle":"NQCL No.","mData":"rs_code"},
	{"sTitle":"Date Received","mData":"date_received"},
	{"sTitle":"Date of Expiry","mData":"date_of_expiry",
							
							"mRender":function(data, type, row){
							if(row.standard_type == 'Primary'){
								return 'N/A';
							}
							else{
								return data;
							}
						},
		"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
			var date_of_expiry = $.datepicker.parseDate("yy-mm-dd", sData);
			//var today = $.datepicker.formatDate("yy-mm-dd", new Date());
			today = new Date();	
			monthBeforeExpiry = new Date();
			monthBeforeExpiry.setDate(date_of_expiry.getDate() - 30); 
			console.log(oData)
			if(oData.standard_type == 'Working'){
				if(monthBeforeExpiry <= today ){
						$(nTd).css({"background-color":"#FF885B", "color":"white"});
					}
				if(today > date_of_expiry){
						if(sData != '1970-01-01'){
							$(nTd).css({"background-color":"#FF3C00", "color":"white"});
						}
						else{
							$(nTd).css({"background-color":"#f1c40f", "color":"white"});
						}
					}
				}
				else{
					$(nTd).css({"background-color":"##a9a9a9", "color":"white"});
				}
			}
		},
	{"sTitle":"Potency","mData":null,
		"mRender":function(data, type, row){
			return row.potency + " " + row.potency_unit;
		}},
	{"sTitle":"Potency Type","mData":null,
		"mRender":function(data, type, row){
			if(row.potency_type != null){
				return row.potency_type;
			}
			else{
				return 'As Such';
			}
	}},
	{"sTitle":"Quantity","mData":"quantity"},	
	{"sTitle":"Weight/Volume","mData":null, "mRender":function(data, type, row){
			return row.init_mass + " " + row.init_mass_unit;
	}},
	{"sTitle":"Certificate","mData":"rs_code",
		"mRender":function(data, type, row){
			if(row.cert_status == '1'){
				return '<a class = "cert" id = '+data+'>View</a>'
			}
			else{
				return '<span title = "Click Edit to Upload Cert." >N/A</span>'
			}
		}
	},
	{"sTitle":"Status","mData":"status"},
	{"sTitle":"Restandardisation Status","mData":"restandardisation_status"},
	{"sTitle":"Application","mData":"application"},
	{"sTitle":"Edit","mData":"id",
		"mRender":function(data, type, full){
			return '<a class="edit" id = '+data+' >Edit</a>';
		}
	},
	{"sTitle":"Edit History","mData":"id",
		"mRender":function(data, type, row){
			if(row.edit_status == '1'){
				return '<a class="history" id = '+data+' >Show</a>';	
			}
					else{
				return 'No Edits';
			}
		}
	}
	],
    /*"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

        if(aData[6] == '1970-01-01'){ 
				$('td:eq(7)', nRow).css('background-color', 'red');
        }
        return nRow;
      },*/
	"sScrollY": "300px",
    "sScrollX": "100%",
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"stateSave":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."inventory/crslist"?>'	
});
	}
else {
		console.log(rtable.draw(false));
	}



}


$(document).ready(function(){


	$('.edit').live("click",function(e){
			var id = $(this).attr("id");
			var tds = new Array();
			$.each($(this).parent().siblings(), function(key, value){
					tds.push($(value).text())
			})
		
		e.preventDefault();
		var href = '<?php echo base_url()."inventory/refsublist_fancybox/" ?>' + $(this).attr('id')
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:400,
			height: 500,
			'beforeClose' : function(){
			console.log($("a[id = "+id+"]").parent().siblings())
			
				//Reload Table
				$('#refsubs').DataTable().ajax.reload();
				
					
				setTimeout(function(){	
					$.each($("a[id = "+id+"]").parent().siblings(), function(key, value){
						console.log(tds[key])
					})
				}, 3000);	
				
			}
		});
		return(false);
	})
	console.log(getData());
})


//On clicking view certificate
	$('.cert').live("click",function(e){
			var id = $(this).attr("id");
			console.log(id);
		
		e.preventDefault();
		var href = '<?php echo base_url()."scans/standards/" ?>' + $(this).attr('id')+'.pdf'
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:700,
			height: 500
		});
		return(false);
	})




$('.history').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == 'Show'){
							
						   $(this).text("Hide");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('inventory/refsubs_showHistory'); ?>" + "/" + id , function(history){
								
								rtable.fnOpen(nTr, history, 'history');
							})
							
							
						}
						
						
						else{

							rtable.fnClose(nTr);
							
							$(this).text("Show");	
							
						}
		})
</script>