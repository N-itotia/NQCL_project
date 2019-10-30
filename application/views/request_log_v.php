<html>
	<div id = 'log_div'>
		<table id = "request_log_table">
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
	<script type="text/javascript" >
		var rtable;
function getData(){
	if (typeof rtable == 'undefined') {
		rtable = $('#request_log_table').dataTable({
	"bJQueryUI": true,
	"aoColumns": [
	<?php foreach($columns as $c){?>
		{"sTitle":"<?php echo $c['COLUMN_COMMENT']; ?>","mData":"<?php echo $c['COLUMN_NAME'] ?>"},
	<?php }?>
	],
	"sScrollY":"300px",
	"sScrollX": "100%",
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."request_management/requests_log/".$rlog_id."/new"?>',
});
	}
else {
	rtable.fnDraw();
	}
}
getData();
	</script>
</html>