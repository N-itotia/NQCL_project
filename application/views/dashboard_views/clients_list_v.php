<script src="<?php echo base_url(); ?>dashboard_assets/js/jquery-1.10.2.min.js"></script>
<link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css' ?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css' ?>" type="text/css" rel="stylesheet"/>
<style>
    div.dataTables_length  {
        width: 100%;
    }
    div.dataTables_length label {
        display: none;
    }
</style>
<style>

</style>
<div class="row-fluid top_span_info">

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3"> 
        <i class="icon-check blue"></i>
        <span class="title">All Samples</span>
        <span class="value"><a href = "#" id="all"><?php echo $all_samples->count; ?></a></span>
    </div>

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
        <i class="icon-check orange"></i>
        <span class="title">Past 21 Days</span>
        <span class="value"><a href = "#" id="near_expired" ><?php echo $near_expiry[0]->count; ?></a></span>
    </div>

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
        <i class="icon-check red"></i>
        <span class="title">Past 42 Days</span>
        <span class="value"><a href = "#" id="expired"><?php echo $expired ?></a></span>
    </div>
</div>
<div class = "row-fluid">
					<a href = "<?php echo base_url().'main_dashboard/client_list' ?>" class = "btn btn-lg btn-success pull-right " ><i class = "icon icon-zoom-in" >View Clients List</i></a>
					<a href = "<?php echo base_url().'main_dashboard/samples_list' ?>" class = "btn btn-lg btn-primary pull-right " ><i class = "icon icon-zoom-in" >View Samples List</i></a>

</div>  
<div class="row-fluid"> 
	
    <select id="year1" style="width:70px;">
	<option value = "">All</option>
        <?php foreach ($years as $every_year): ?>
            <option value="<?php echo $every_year; ?>" ><?php echo $every_year; ?></option>
        <?php endforeach; ?>
    </select><br>
</div>

<div class="row-fluid">
	 <table id = "requests">
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

<div id="more_data" style="display:none">
<div class="row-fluid"> 	
    <select id="year2" style="width:70px;">
	<option value = "">All</option>
        <?php foreach ($years as $every_year): ?>
            <option value="<?php echo $every_year; ?>" ><?php echo $every_year; ?></option>
        <?php endforeach; ?>
    </select><br>
</div>
<table id = "requests2">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>
<input type = "hidden" id="h_year" />
</div>


<script>
   $(document).ready(function() {
var url = 'getAllClientsReportAll';
getData(url);
$('#year1').on('change', function(){
	temp_url = $(this).val();
	url1 ='getAllClientsReport/'+temp_url;
	console.log(url1)
	$('#year2').val(temp_url);
	
	//$('#request').
	 //$("#requests").empty();
     $('#requests').dataTable().fnDestroy();

	getData(url1);
	
	//$('#requests').DataTable.ajax.url(url1).load();
})

$('#year2').on('change', function(){
	temp_url = $(this).val();
	id = $('#h_year').val();
	//url1 ='client_samplesFiltered/'+year+"/"+temp_url;
	//console.log(url1)
	//$('#year2').val(temp_url);
	
	//$('#request').
	 //$("#requests").empty();
     $('#requests2').dataTable().fnDestroy();

	getData1(id, temp_url);
	
	//$('#requests').DataTable.ajax.url(url1).load();
})


var i = 0;
function getData(url){
      db_data =''; 
	if (typeof rtable == 'undefined') {
		var rtable = $('#requests').DataTable({
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
		/*"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(aData.assign_status == "1" ){
				$('td',nRow).css('background-color', '#d5edcd');
			}
		},*/	
	"dom": 'C<"clear">lfrtip',		
	"bJQueryUI": true,
	"scrollX": true,
	"order": [[ 2, "desc" ]],
	"aoColumns": [
	{"sTitle":"Number","mData":null,
		"mRender":function(data, type, row, i){
			return row.client_id;
		}
	},
	{"sTitle":"Client", "sClass":"client","mData":"name"},
	{"sTitle":"No. of Samples", "sClass":"client","mData":"all_samples"},
	{"sTitle":"More Info","mData":"client_id",
		"mRender":function(data, type, row){
			return '<a class="more_info" href = "#'+data+'" id = '+data+' >More Info</a>';
		}
	}
	],
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"bStateSave":true,
	"iDisplayLength":10,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."main_dashboard/"?>'+url,		
		});
		$('#requests').css('width', '100%');
	}
else {
	rtable.fnDraw();
	}

	}
})



    $(document).ready(function() {
	$(document).on('click','.more_info',function(){
id=$(this).attr('id');
$('#h_year').val(id);
year2 = $('#year2').val();
var url = 'client_samples'
getData1(id,year2);
$.fancybox({
href:"#more_data",
autoDimensions: false,
autoSize:false,
width: 1000
});

});	

$('#request').css('width','100%');
        $('.top_span_info a').on("click",function(e) {
            e.preventDefault();
            var columns = new Array();
            id = $(this).attr("id");
            console.log(id);
        
            //Define url and table tr td variables for DataTable       
            var url = '<?php echo site_url()."main_dashboard/getSamplesExpired/"?>' + id 
            var columns = [
                        {"sTitle":"Reference Number", "mData":"request_id"},
                        {"sTitle":"Product", "mData":"product_name"},
                        {"sTitle":"Active Ingredient", "mData":"active_ing"},
                        {"sTitle":"Date of Expiry", "mData":"exp_date"},
                        {"sTitle":"Client", "mData":"name"}
                    ]

                //Call Fancybox
                openFancyBox(url, columns);  

            })

        //openFancyBox
        function openFancyBox(url, columns){
            $.fancybox.open({
                    href:'#details_table',
                    autoSize: false,
                    autoDimensions : false,
                    width:700,
                    height:490,
                    'beforeLoad':function(){
                        getTableData(url, columns);
                    }
                })
            }


        //getTableData
        function getTableData(url, columns){
            if(typeof stable == 'undefined'){
                var stable = $('#stable').dataTable({
                    "bJQueryUI":true,
                    "aoColumns":columns,
                    "bDeferRender":true,
                    "bProcessing":true,
                    "bDestroy":true,
                    "bLengthChange":true,
                    "bStateSave":true,
                    "iDisplayLength":16,
                    "sAjaxDataProp": "",
                    "sAjaxSource": url
                })
            }
            else{
                stable.fnDraw()
            }
        }   

	

    });
	
	function getData1(i, y){
	if(y!=''){
	 url = "client_samplesFiltered/"+i+"/"+y;
    }
	else{
	 url = "client_samplesFiltered1/"+i;
	}
	  db_data =''; 
	if (typeof rtable == 'undefined') {
		var rtable = $('#requests2').dataTable({
		"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(aData.days_past < 21 ){
				$('td',nRow).css('background-color', '#86F7A3');
			}
			if(aData.days_past > 21 && aData.days_past < 42){
				$('td',nRow).css('background-color', '#FF9E5E');
			}
			else if(aData.days_past > 42){
				$('td',nRow).css('background-color', '#F75D59');	
			}
		},
		
		//If Sample is already assigned, colour code entry a light green.	
	"dom": 'C<"clear">lfrtip',		
	"bJQueryUI": true,
	"scrollX": true,
	"order": [[ 3, "desc" ]],
	"aoColumns": [
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
	{"sTitle":"Batch No.","mData":"batch_no"},
	{"sTitle":"Date Received","mData":"designation_date"},
	{"sTitle":"Days Past","mData":"days_past"},
	{"sTitle":"More Info","mData":"request_id",
		"mRender":function(data, type, row){
			return '<a class="more_info2" href = "#singleout" id = '+row.request_id+' >More</a>';
		}
	},
	],
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"bStateSave":true,
	"iDisplayLength":10,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."main_dashboard/"?>' + url,		
		});
		
	$('#requests2').css('width', '100%');
	
	}
else {
	rtable.fnDraw();
	}

	
	 $('.more_info2').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == 'More'){
							
						   $(this).text("Less");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('main_dashboard/more_info'); ?>" + "/" + id , function(more){
								
								rtable.fnOpen(nTr, more, 'More');
							})
							
						}
						
					else{

							rtable.fnClose(nTr);
							
							$(this).text("More");	
							
						}
		})


}
</script>

</script>

</div>


