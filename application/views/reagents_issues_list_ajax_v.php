
<div class ="content">

<legend><a href="<?php echo site_url()."inventory/reagentslist"; ?>">Reagents Inventory List</a>&nbsp;<span class = "link_highlight" >|</span><a href="<?php echo site_url()."inventory/reagent_issues_list"; ?>">Issues List</a>&nbsp;<span class = "link_highlight" >|</span><a href="<?php echo site_url()."inventory/reagentlist"; ?>">Reagent Episodes List</a>&nbsp;&larr;&nbsp;<a href="<?php echo site_url()."inventory/reagentadd"; ?>">Add Reagents</a>
&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/reagentsadd";?>">Add Reagents to Inventory</a></legend>

<div>&nbsp;</div>
<table id = "rgnts">
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

var rtable;
function getData(){
	if (typeof rtable == 'undefined') {
		rtable = $('#rgnts').dataTable({
	"bJQueryUI": true,
	"aoColumnDefs": [{
							"sClass": "center light-blue",
							"aTargets": [0,1,2,3,4,5,6]
			},
			{		"sClass": "center bold light-orange",
					"aTargets":[7,8,9,10,11]
			}],
	"aoColumns": [
	{"sTitle":"Reagent Name","mData":"reagent_name"},
	{"sTitle":"Manufacturer","mData":"manufacturer"},
	{"sTitle":"Batch No.","mData":"reagent_batch"},
	{"sTitle":"Reorder Level","mData":"reorder_level"},
	{"sTitle":"Quantity Received","mData":"quantity",
		"mRender":function(data, type, row){
			return data + " " + row.packaging;
		}
	},
	{"sTitle":"Date Received","mData":"reagent_rdate"},
	{"sTitle":"S11 Voucher","mData":"s11_number",
		"mRender":function(data, type, row){
			if(data!=null){
				return data;
			}
			else{
				return 'NA';
			}
		}
	},
	{"sTitle":"S13 Voucher","mData":"s13_number",
		"mRender":function(data, type, row){
			if(data!=null){
				return data;
			}
			else{
				return 'N/A';
			}
		}
	},
	{"sTitle":"Quantity Issued","mData":"quantity_issued",
		"mRender":function(data, type, row){
			return data + " " + row.packaging;
		}
	},
	{"sTitle":"Issued To","mData":"issuee_name"},
	{"sTitle":"Issued By","mData":"issuer_name"},
	{"sTitle":"Date Issued","mData":"date_issued"},
	{"sTitle":"Date Opened.","mData":"date_opened",
		"mRender":function(data, type, row){
			if(data!=null){
				return data;
			}
			else{
				return 'N/A'
			}
		}
	}
	],

	"bDeferRender":true,
	"bProcessing":true,

	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."inventory/rgnt_issue_list_all"?>',
});
	}
else {
	rtable.fnDraw();
	}
}


$(document).ready(function(){
	$('.edit').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."inventory/reagents_fancybox/" ?>' + $(this).attr('id')
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:400,
			height: 500,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})
	getData();

	//Pop issuance dialogue
	$('.issue').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."inventory/reagents_issue_view/" ?>' + $(this).attr('id')
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:600,
			height: 500,
			'beforeClose' : function(){
				getData();
			}
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

							$.post("<?php echo site_url('inventory/reagents_showHistory'); ?>" + "/" + id , function(history){

								rtable.fnOpen(nTr, history, 'history');
							})


						}


						else{

							rtable.fnClose(nTr);

							$(this).text("Show");

						}
		})

getData();

})
</script>
