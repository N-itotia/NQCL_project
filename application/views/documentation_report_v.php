<div><legend><span class = "link_highlight" >Documentation Report</span></legend></div>


	<div class = "clear">
		<div class = "left_align">
				<label>Start</label>&nbsp;<input id = "s_date" name = "start_date" placeholder = "Start Date" value="<?php echo $start_date; ?>" required />
				<label>End</label>&nbsp;<input id = "e_date" name = "end_date" placeholder = "End Date" value="<?php echo $end_date; ?>" required />
				<input type="submit" value ="Query" id = "report_generate" />
		</div>
	</div>
	
<table id = "doc_report">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript" >

//On clicking query regenerate report with new dates as parameters
$('#report_generate').on("click", function(){
	var start_date = $('#s_date').val();
	var end_date = $('#e_date').val();
	var href = "<?php echo site_url(); ?>request_management/documentationReportAjax/" + start_date + "/" + end_date
	$('#doc_report').DataTable().ajax.url(href).load();
	console.log(href);
})

//Set datepicker 
 $('#s_date').datepicker({
     changeYear: true,
     dateFormat: "yy-mm-dd",
	 defaultDate: '<?php echo $start_date; ?>',
 });
 
 $('#e_date').datepicker({
     changeYear: true,
     dateFormat: "yy-mm-dd",
	 defaultDate: '<?php echo $end_date; ?>',
	 maxDate:'<?php echo date('Y-m-d'); ?>'
 }); 

//Set dates to javascript variables, get dynamic url
var start_date = $('#s_date').val();
var end_date = $('#e_date').val();
var href = "<?php echo site_url(); ?>request_management/documentationReportAjax/" + start_date + "/" + end_date
console.log(href)

//Configure DataTable
var rtable;
	function getData(){
		if (typeof rtable == 'undefined') {
			rtable = $('#doc_report').DataTable({
		"bJQueryUI": true,
		"aoColumns": [
		<?php foreach($columns as $c){?>
			{"sTitle":"<?php echo ucwords(str_replace('_', ' ', $c)); ?>","mData":"<?php echo $c; ?>"},
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
		"sAjaxSource":  href
	});
		}
	else {
		rtable.fnDraw();
		}
	}
	getData();
</script>

