<div class ="content">
    <style type="text/css">
        .tg,.tig, .tk  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
        .tg ,.tig,.tig td, .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
        .tg ,.tig,.tg th, .tig th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
        .tg, .tig,.tg-ugh9{background-color:#C2FFD6}
        .tk,.tig, .tk td, .tig td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
        .tk,.tig, .tk th, .tig th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
        .tk ,.tig,.tg-ugh9{background-color:#C2FFD6}
        .other{
            display: none;
        }

        tr.even:hover td,
        #mtTable tr.even:hover td,
        #mtTable tr.even:hover td.sorting_1 { background-color: #00CC33;
                                              border-top: 2px solid #00CC33;
                                              border-bottom: 2px solid #00CC33; }

        tr.odd:hover td,
        #mtTable tr.odd:hover td,
        #mtTable tr.odd:hover td.sorting_1 { background-color: #00CC33;
                                             border-top: 2px solid #00CC33;
                                             border-bottom: 2px solid #00CC33; }
        </style>


        <div id="test_filter" style="display: none;">
        <form id="test_f">
            <table class="tg" style="width:200px; ">

                <tr>
                    <td><strong>Test</strong></td>
                    <td><select name="testname" id="testname" >
                            <option value="">--Select Test--</option>
                            <?php foreach ($tests as $t): ?>
                                <option value="<?php echo $t->id; ?>" ><?php echo $t->name; ?></option>
                            <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td class="tg-031e">Date From</td>
                    <td class="tg-031e">
                        <input type ="text" class="filter_date" id="f_date_from"/>

                    </td>   
                </tr>

                <tr>
                    <td class="tg-031e">Date To</td>
                    <td class="tg-031e">
                        <input type ="text" class="filter_date" id="f_date_to"/>		

                    </td>   
                </tr>
                <tr>
                    <td></td>
                    <td><input type ="button" class="submit" value="Genarate" id="generate_tests"/> &nbsp; <input type ="button" value="Cancel" id="cancel_generate"/></td>
                </tr>


            </table>


        </form>
    </div>



    <div id="period_filter" style="display: none;">
        <form id="period_f">
            <table class="tg" style="width:250px; ">

              <tr>
                    <td class="tg-031e">Date From</td>
                    <td class="tg-031e">
                        <input type ="text" class="filter_date" id="f_date_from1"/>

                    </td>   
                </tr>

                <tr>
                    <td class="tg-031e">Date To</td>
                    <td class="tg-031e">
                        <input type ="text" class="filter_date" id="f_date_to1"/>        

                    </td>   
                </tr>
                    <td></td>
                    <td><input type ="button" class="submit" value="Genarate" id="generate_period"/></td>
                </tr>


            </table>


        </form>
    </div>





    <div id="sample_update_1" style="display: none;">
        <form id="request_update">
            <table class="tg" id="table_update" style="width:1000px;  height:60px;">

                <tr>
                    <td colspan="2"><strong>Sample Number: <input type="text" readonly name="sample_req" id="sample_req" readonly>
                      
                       </td>
						<td colspan="2"><strong>Recover To: <select name="location" id="location" >
						   <option value=''></option>
                           <option value='1'>Documentation Before Sample Review Stage</option>
						   <option value='2'>Documentation Before COA Review Stage</option>
                        </select></td>
						<td><input type="button" id="get_sample" value="Recover Sample"/></td>
						<td><input type="button" id="cancel" value="Close"/></td>

                </tr>
                
			
            </table>
			
			<table id='tracker'>
			
			</table>
          

        </form>
    </div>

    
</div>
<style>
.fancybox-wrap{
	height:500px !important;
}
</style>

<!--<div id = "nav_left_container">
        <ul id = "nav_ul_left" >
                <li class = "first">
                        <span><legend><a href = "<?php echo base_url() . 'request_management/add' ?>" >Add New</a></legend></span>
                </li>
                <li class = "role" >
                        <legend><a id ="gen_label" href = "<?php echo base_url() . 'request_management/add' ?>" >Generate Label</a></legend>
                </li>
                <li class = "role">
                        <legend><a id ="gen_quotation">Generate Quotation</a></legend>
                </li>
                <li class = "role">
                        <legend><a id ="gen_req_data">Generate Request Report</a></legend>
                </li>
                      <li class = "role">
                        <legend><a href ="<?php echo base_url(); ?>coa_scans">COA SCANS MANAGEMENT</a></legend>
                </li>
<?php foreach ($filters as $f) { ?>
                    <li class = "role">
                            <legend><a href ="<?php echo base_url() . 'request_management/samples/' . $f['name']; ?>"><?php echo ucfirst($f['name']); ?> Samples</a></legend>
                    </li>
<?php } ?>
        </ul>
</div>-->
<table id = "requests" class="hover table-stripped">
<p>
<hr>
<?php
$startY =2013;
$endY=date('Y');
$endYk = (int)$endY;

for($i=$startY;$i<=$endY;$i++){?>
	<input type="button" id="<?php echo $i;?>" value="<?php echo $i;?>" class="ryear"/>
<?php }?>
<hr>
</p>

    <thead>
        <tr>
        </tr>
    </thead>
    <tbody>
        <tr>
        </tr>
    </tbody>
</table>

</div>
<div class = "hidden2" id = "fancybox_label" ></div>
<div id = "confirm" class = "hidden2" >Mark Selected as OOS?</div>

<script type="text/javascript">
$(document).ready(function(){
	


    unit = '<?php echo $this->session->userdata('user_unit') ?>';
    tag = "<?php echo @$tag; ?>";
    if (tag === '') {
        url = "<?php echo site_url() . "request_management/requests_list_current/" ?>";
    } else {
        url = "<?php echo site_url() . "request_management/requests_list_all/" ?>" + tag;
    }
	
	
		getData();

 $(document).on('click', '.s_ue', function () {
id = $(this).attr('id');
$('#sample_req').val(id);	   

	   $.fancybox({
                href: "#sample_update_1",
				height:"300px",
                modal: true,
                closeBtn: 'true',
            });
 });

   
	
	$('#get_sample').click(function(){
		$data='';
		$sample_name= $('#sample_req').val();
		$samplelocaton= $('#location').val();
		$samplelocaton1= $('#location').text();
		table =$('#tracker');
		
		if($samplelocaton==='1'){
			tablename='supervisor_approvals';
		}else{
			tablename='reviewer_documentation';
		}
		$.getJSON("<?php echo base_url();?>request_management/getlastplace/"+$sample_name+'/'+$samplelocaton,function(resp){
		   $data ="<tr><td>Database search scan for sample initiate...</td></tr>";
       		$data +="<tr><td>Determining last known activity..</td></tr>";  
           $data +="<tr><td>Activity determined <strong>"+resp[0].activity+"</strong></td></tr>"; 
         $data +="<tr><td>Retrieving sample to "+$samplelocaton1+"...</td></tr>"; 
		 $.post("<?php echo base_url();?>request_management/correctdata/"+tablename+'/'+$sample_name,function(resp1){
			   $data +="<tr><td>Completing the process...</td></tr>"; 
$data +="<tr><td>Sample found and successfully taken back to the selected location..</td></tr>"; 
$data +="<tr><td>Please go to the location you selected, the sample has been restored there...</td></tr>"; 
$data +="<tr><td>Completing processs..</td></tr>"; 	
$data +="<tr><td><strong>SUCCESSFULL!!</strong></td></tr>";   
table.empty();
table.append($data);
		 });
		 
     

      	   
		});
	})
	
	$('#cancel').click(function(){
		$.fancybox.close();
	});		




   
    function getData() {
        db_data = '';
        var rtable = ''

        rtable = $('#requests').DataTable({
            "dom": 'TC<"clear">lfrtip',
            tableTools: {
                "sRowSelect": "multi",
                "aButtons": [
                    {
                        "sExtends": "text",
                        "sButtonText": "Mark Selected as OOS",
                        "fnClick": function (nButton, oConfig, oFlash) {
                            var data = TableTools.fnGetInstance('requests');

                            //Get data from the selected rows
                            var selected_data = data.fnGetSelectedData();

                            //Initialize array to hold refsub ids
                            request_ids = [];

                            //Loop through the selected data
                            for (var i = 0; i < selected_data.length; i++) {

                                //Push ids of selected refsubs into above initialized array
                                request_ids.push(selected_data[i].request_id);
                            }

                            //Conver array of ids into a string
                            var ids = JSON.stringify(request_ids);

                            //Replace,remove forward slashes, quotation marks and square brackets and underscores from new string
                            sanitized_ids = ids.replace(/[,]/g, "/").replace(/[\[\]""]/g, "").replace(/ /g, "_");

                            //Url to generate pdf
                            update_url = '<?php echo base_url() . "request_management/markSelectedAsOos" ?>' + "/" + sanitized_ids

                            console.log(update_url);

                            //Confirm
                            console.log($('#confirm').dialog({
                                resizable: false,
                                modal: true,
                                title: "Mark as OOS",
                                buttons: {
                                    "Yes": function () {
                                        $(this).dialog("close");

                                        //Ajax function to pass ids to above gen url
                                        $.ajax({
                                            type: 'POST',
                                            url: update_url
                                        }).done(function (response) {
                                            noty({
                                                text: selected_data.length + ' successfully marked as OOS.',
                                                type: 'success',
                                                timeout: true,
                                                callback: {
                                                    afterShow: function () {
                                                        getData();
                                                    }

                                                }
                                            })
                                        })

                                    },
                                    "No": function () {
                                        $(this).dialog("close");
                                    }
                                }

                            }));

                        }

                    }
                ]
            },
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
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                if (aData.assign_status == "1") {
                    $('td', nRow).css('background-color', '#d5edcd');
                }
            },
            "fnCreatedRow":function (nRow, aData, iDataIndex) {
                if (unit != '5') {
                   // $('td a', nRow).not('.more_info, .a_detail_rev').replaceWith('<span>N/A</span>');
                }
            },
                    "fnDrawCallback": function (nRow, aData, iDataIndex) {
                        $('#requests tbody tr').each(function (i, k) {
                            var sTitle;
                            var text2 = '';
                            var nTds = $('td', this);
                            var labref = $(nTds[0]).text();
                            if (labref == '') {
                                console.log('Blank');
                            } else {
                                $.ajax({
                                    Type: 'get',
                                    url: "<?php echo base_url() . 'request_management/load_test_requested/' ?>" + labref,
                                    dataType: 'json',
                                    success: function (response) {
                                        console.log(response)
                                        $.each(response, function (i, data) {
                                            text = data.name;
                                            text2 += text + ",    ";
                                            sTitle = text2.replace('undefined', '->');

                                        });

                                        k.setAttribute('title', "Tests Requested for " + sAg + " : " + sTitle);
                                    }, error: function () {
                                        console.log('An error occured');
                                    }
                                });
                            }


                            var sAg = $(nTds[1]).text();
                            var sEm = $(nTds[5]).text();
                            var sPh = $(nTds[4]).text();
                            var sUpv = $(nTds[3]).text();




                        });

                        /* Apply the tooltips */
                        rtable = $('#requests').DataTable();
                        rtable.$('tr').tooltip({
                            placement: '',
                            html: true
                        });
                    },
            "bJQueryUI": true,
            "scrollX": true,
            "order": [[0, "DESC"]],
            "aoColumns": [
                {"sTitle": "id", "mData": "id", "visible": false, "bSortable": true},
                {"sTitle": "Reference Number", "mData": "request_id"
                    , "mRender": function (data, type, row) {
                        //if(row.assign_status == "0" && row.quotation_status == "0"){
                        return '<a class="a_detail_rev" href = "#' + row.request_id + '" id = ' + row.request_id + ' >' + row.request_id + '</a>';
                        /*}
                         else{
                         return 'N/A';
                         }*/
                    }},
                {"sTitle": "Product Name", "mData": "product_name"},
                {"sTitle": "Active Ingredient", "mData": "active_ing"},
                {"sTitle": "Client", "sClass": "client", "mData": "Clients.Name"},
             
                {"sTitle": "Disaster Recovery", "mData": null,
                    
                    "mRender": function (data, type, row) {
                        //if(row.assign_status == "0" && row.quotation_status == "0"){
                        //<a class="s_u" href = "#sample_update" id='+row.request_id+' >+Add </a> ||
                        return '<a class="s_ue" href = "#Edit_log" id=' + row.request_id + ' >Find & Recover</a>'; 

                        /*}
                         else{
                         return 'N/A';
                         }*/
                    }
                },
               
            ],
            "sScrollY": "300px",
            "sScrollX": "100%",
            "bDeferRender": true,
            "bProcessing": true,
            "bDestroy": true,
            "bLengthChange": true,
            "bStateSave": true,
            "iDisplayLength": 10,
            "sAjaxDataProp": "",
            "sAjaxSource": url,
        });



    }
	
	
	 
	 $(document).on('click','.ryear',function(){
		  $(".ryear").css('background','greenyellow');
		 year = $(this).attr('id');
		 $(this).css('background','green');
		  url = "<?php echo site_url() . "request_management/requests_list_year/" ?>" + year;
		  $("#requests").empty();
          $('#requests').dataTable().fnDestroy();
		  getDataPerYear(url);
	 })
	
	
	
	   function getDataPerYear(url) {
         db_data = '';
        var rtable = ''

        rtable = $('#requests').DataTable({
            "dom": 'TC<"clear">lfrtip',
            tableTools: {
                "sRowSelect": "multi",
                "aButtons": [
                    {
                        "sExtends": "text",
                        "sButtonText": "Mark Selected as OOS",
                        "fnClick": function (nButton, oConfig, oFlash) {
                            var data = TableTools.fnGetInstance('requests');

                            //Get data from the selected rows
                            var selected_data = data.fnGetSelectedData();

                            //Initialize array to hold refsub ids
                            request_ids = [];

                            //Loop through the selected data
                            for (var i = 0; i < selected_data.length; i++) {

                                //Push ids of selected refsubs into above initialized array
                                request_ids.push(selected_data[i].request_id);
                            }

                            //Conver array of ids into a string
                            var ids = JSON.stringify(request_ids);

                            //Replace,remove forward slashes, quotation marks and square brackets and underscores from new string
                            sanitized_ids = ids.replace(/[,]/g, "/").replace(/[\[\]""]/g, "").replace(/ /g, "_");

                            //Url to generate pdf
                            update_url = '<?php echo base_url() . "request_management/markSelectedAsOos" ?>' + "/" + sanitized_ids

                            console.log(update_url);

                            //Confirm
                            console.log($('#confirm').dialog({
                                resizable: false,
                                modal: true,
                                title: "Mark as OOS",
                                buttons: {
                                    "Yes": function () {
                                        $(this).dialog("close");

                                        //Ajax function to pass ids to above gen url
                                        $.ajax({
                                            type: 'POST',
                                            url: update_url
                                        }).done(function (response) {
                                            noty({
                                                text: selected_data.length + ' successfully marked as OOS.',
                                                type: 'success',
                                                timeout: true,
                                                callback: {
                                                    afterShow: function () {
                                                        getData();
                                                    }

                                                }
                                            })
                                        })

                                    },
                                    "No": function () {
                                        $(this).dialog("close");
                                    }
                                }

                            }));

                        }

                    }
                ]
            },
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
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                if (aData.assign_status == "1") {
                    $('td', nRow).css('background-color', '#d5edcd');
                }
            },
            "fnCreatedRow":function (nRow, aData, iDataIndex) {
                if (unit != '5') {
                   // $('td a', nRow).not('.more_info, .a_detail_rev').replaceWith('<span>N/A</span>');
                }
            },
                    "fnDrawCallback": function (nRow, aData, iDataIndex) {
                        $('#requests tbody tr').each(function (i, k) {
                            var sTitle;
                            var text2 = '';
                            var nTds = $('td', this);
                            var labref = $(nTds[0]).text();
                            if (labref == '') {
                                console.log('Blank');
                            } else {
                                $.ajax({
                                    Type: 'get',
                                    url: "<?php echo base_url() . 'request_management/load_test_requested/' ?>" + labref,
                                    dataType: 'json',
                                    success: function (response) {
                                        console.log(response)
                                        $.each(response, function (i, data) {
                                            text = data.name;
                                            text2 += text + ",    ";
                                            sTitle = text2.replace('undefined', '->');

                                        });

                                        k.setAttribute('title', "Tests Requested for " + sAg + " : " + sTitle);
                                    }, error: function () {
                                        console.log('An error occured');
                                    }
                                });
                            }


                            var sAg = $(nTds[1]).text();
                            var sEm = $(nTds[5]).text();
                            var sPh = $(nTds[4]).text();
                            var sUpv = $(nTds[3]).text();




                        });

                        /* Apply the tooltips */
                        rtable = $('#requests').DataTable();
                        rtable.$('tr').tooltip({
                            placement: '',
                            html: true
                        });
                    },
            "bJQueryUI": true,
            "scrollX": true,
            "order": [[0, "DESC"]],
            "aoColumns": [
                {"sTitle": "id", "mData": "id", "visible": false, "bSortable": true},
                {"sTitle": "Reference Number", "mData": "request_id"
                    , "mRender": function (data, type, row) {
                        //if(row.assign_status == "0" && row.quotation_status == "0"){
                        return '<a class="a_detail_rev" href = "#' + row.request_id + '" id = ' + row.request_id + ' >' + row.request_id + '</a>';
                        /*}
                         else{
                         return 'N/A';
                         }*/
                    }},
                {"sTitle": "Product Name", "mData": "product_name"},
                {"sTitle": "Active Ingredient", "mData": "active_ing"},
                {"sTitle": "Client", "sClass": "client", "mData": "Clients.Name"},
             
                {"sTitle": "Disaster Recovery", "mData": null,
                    
                    "mRender": function (data, type, row) {
                        //if(row.assign_status == "0" && row.quotation_status == "0"){
                        //<a class="s_u" href = "#sample_update" id='+row.request_id+' >+Add </a> ||
                        return '<a class="s_ue" href = "#Edit_log" id=' + row.request_id + ' >Find & Recover</a>'; 

                        /*}
                         else{
                         return 'N/A';
                         }*/
                    }
                },
               
            ],
            "sScrollY": "300px",
            "sScrollX": "100%",
            "bDeferRender": true,
            "bProcessing": true,
            "bDestroy": true,
            "bLengthChange": true,
            "bStateSave": true,
            "iDisplayLength": 10,
            "sAjaxDataProp": "",
            "sAjaxSource": url,
        });


    


 
  
    }
});

</script>
