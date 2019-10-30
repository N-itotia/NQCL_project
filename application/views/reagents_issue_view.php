<?php
/*$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
*/?>

<head></head>

<div class = " popupform" id = "refsub<?php echo $reagent[0] -> id ?>" >
	<div>
		<legend>Issuance History for <?php echo $reagent[0] -> name; ?></legend>
		<hr/>
		<table id = "rgnts_issuance">
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
	<div>&nbsp;<br></div>
<form id = "editrefsub<?php echo $reagent[0] -> id ?>">
	<div>
		<legend>Issue &nbsp;&nbsp;<?php  echo $reagent[0]  -> name ?></legend>
		<hr />
	</div>

	<div id = "add_success" class ="hidden2" >
		<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
	</div>

	<div class = "clear">
		<div class = "left_align">
		<label for = "name">S11 Number</label>
		</div>
		<div class = "right_align">
		<input name = "s11_number" required />
		</div>
	</div>

	<div class = "clear">
	<div class = "left_align">
	<label for = "name">Quantity<small>(<?php echo $reagent[0]  -> packaging ?>)</small></label>
	</div>
	<div class = "right_align">
	<input name = "quantity_issued" required />
	</div>
	</div>

	<div class = "clear">
	<div class = "left_align">
	<label for = "manufacturer">Issuee</label>
	</div>
	<div class = "right_align">
		<select name = "issuee_id">
			<?php foreach($analysts as $analyst){?>
				<option value="<?php echo $analyst['id']; ?>"><?php echo $analyst['fname'] ." ".$analyst['lname']; ?></option>
			<?php }?>
		</select>
	</div>
	</div>

	<div class ="clear left_align">
			<input name ="Save" type = "submit" class = "submit-button" value = "Save" />
	</div>
	<input type = "hidden" name = "issuer_id" value = "<?php $custodian = $this->session->userdata('user_id'); echo $custodian; ?>" />
	<input type = "hidden" name = "issuer_name" value = "<?php $custodian = $this->session->userdata('full_name'); echo $custodian; ?>" />
	<input type = "hidden" name = "reagent_id" value = "<?php echo $reagent[0] -> id ?>" />
	</form>
</div>

<script type="text/javascript">
$(function(){
	var ri_table;
	function getData_r(){
		if (typeof ri_table == 'undefined') {
			ri_table = $('#rgnts_issuance').dataTable({
		"aoColumns": [
		{"sTitle":"S11","mData":"s11_number"},
		{"sTitle":"Quantity Issued","mData":"quantity_issued",
			"mRender":function(data, type, row){
					return data +" "+"<?php echo $reagent[0]['packaging']; ?>"
			}
		},
		{"sTitle":"To","mData":"issuee_name"},
		{"sTitle":"By","mData":"issuer_name"},
		{"sTitle":"Date","mData":"date_issued"}
		],
		"bPaginate":false,
		"bFilter":false,
		"bSort":false,
		"bInfo":false,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo site_url()."inventory/rgnt_issue_list/".$reagent[0] -> id;?>',
	});
		}
	else {
		ri_table.fnDraw();
		}
	}

	getData_r();


$('form').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url()."inventory/reagents_issue" ?>',
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){
				noty({ text: response.message,
							 type: 'success',
				});
			 setTimeout("parent.$.fancybox.close()", 1000);
			 $('#rgnts').DataTable().ajax.reload();
			}
			else if(response.status === "error"){
				noty({ text: response.message,
							 type: 'error',
				});
				}
			},
			error:function(){
			}
		})
	})
})
</script>
