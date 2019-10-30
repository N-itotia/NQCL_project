	
	<!--Get Currency-->	
	<?php $c = $currency[0]['currency']; ?>

		<div class="container is-fluid">
			<form class = "methods" id = "quotation_extras">
				<ul class="menu-list">
					<?php //if($entries[0]['Quotation_entries'] == $completed[0]['completed'] ){ ?>
					<li>
						<fieldset class="box">
							<legend>Client Info</legend>
							<?php foreach($client_info[0] as $key => $value) { ?>
								<li>
									<?php if(!empty($value) && ($key != 'id' )) { ?>
										<?php if($key == 'Name'){ ?>	
											<button class="is-link" id = "editClient">Edit <?php echo $value ?></button>
										<?php } else {?>
											<label><?php echo $value ?></label>
									<?php } }?>
								</li>
							<?php } ?>	
						</fieldset>
					</li>
					<li>
						<fieldset class="box">
							<legend>Quotation Summary</legend>
							<?php foreach($quotation_summary[0] as $key => $value) { ?>
								<li>
									<?php if(!empty($value) && ($key != 'id' ) && ($key != 'Client_name') && ($key != 'Currency') && ($key != 'Quotation_no')) { ?>
										<?php if($key == 'Sample_name' || $key == 'Quotation_date') {?>
											<label><input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>" <?php if($key == 'Quotation_date'){ echo "class = 'datepicker' id='quotation_date'"; }?> ></label>
										<?php } else {?>
											<label><?php echo $value ?></label>
										<?php }?>
									<?php }?>
								</li>
							<?php } ?>	
						</fieldset>
					</li>
					<li>
						<fieldset class="box">
							<legend>Extras</legend>	
							<small>Reporting fee and discount are percentages of total test charges &nbsp;<b><?php echo $c; ?>&nbsp;</b><b id="total"><?php echo $quotation_total[0]['sum']; ?>&nbsp;</b>.Admin fee is an amount in <b><?php echo $c; ?></b>. <e>Enter 0 if does not apply.</e></small>	
							<?php foreach($extra_columns as $xc) { ?>
								<li>
									<label>
										<span><?php echo ucwords(str_replace("_", " ",$xc['column'])); if(!empty($extras)) { echo "&nbsp;<small><b>(".$extras[0][$xc['column']].")</b></small>"; } ?></span>
										<input name = "<?php echo $xc['column']; ?>" id = "<?php echo $xc['column']; ?>" placeholder = "<?php echo $xc['comment'] ?>" value = <?php if(!empty($extras)) { echo $extras[0][$xc['column']]; }?> >
										<?php echo $xc['comment']; ?>
									</label>
								</li>
							<?php }?>
						</fieldset>
					</li>
					<li>
						<fieldset>
							<legend>Notes</legend>	
							<?php if(!empty($quotation_notes))
								{ foreach($quotation_notes as $qn) { ?>
								<li>
									<label>
										<textarea style="width:800px; height:150px;" name = 'quotation_note'><?php echo $qn['system_note'] ?></textarea>
									</label>
								</li>
							<?php }} else {?>
										<textarea style="width:800px; height:150px;" name = 'quotation_note'></textarea>
							<?php } ?>
						</fieldset>
					</li>
					<li>
						<fieldset>
							<legend>Signatory Selection</legend>
							<li>
								<label>
									<span>Signatory</span>
									<select id = "signatory_name" name = "signatory_name">
										<?php foreach($signatories as $s) { ?>
											<option value = "<?php echo $s["fname"].' '.$s["lname"]; ?>" data-title = "<?php echo $s["Users_types"][0]["User_type"][0]["name"]; ?>" ><?php echo $s["fname"].' '.$s["lname"]; ?></option>
										<?php } ?>	
									</select>
								</label>
							</li>
						</fieldset>
					</li>
					<?php //}?>
					<li>
						<fieldset>
							<legend>Finish</legend>
								<li>
									<label>
										<span>
											<input type = "submit" data-submitId = "print" class = "submit-button leftie print_invoice" value = "Print" data-table = "<?php echo $table; ?>"
										</span>
									</label>
								</li>
						</fieldset>
					</li>
				</ul>
			</form>
		</div>

<script type="text/javascript">
	$(document).ready(function(){

	//Initialize datepicker
	$('#quotation_date').datepicker({
        dateFormat: "yy-mm-dd"
    });


	//Pop up client editing form
	$('#editClient').on('click', function(){
		parent.$.fancybox.open({
			href:'<?php echo base_url()."quotation/editClient/".$client_id ?>',
			type:'iframe',
			height: 850,
			width:750,			
			afterClose:function(){
				$('#list_quotation').DataTable().ajax.reload();
			}
		})
	})



	//On submitting the form
	$('#quotation_extras').submit(function(e){
	
	e.preventDefault();

	submit_id=  $(this).attr("data-submitId");
	console.log(submit_id);
	
	//Get Signatories
	signatory = $('#signatory_name').val();
	signatory_title = $('#signatory_name option:selected').attr("data-title");
		
	//Get Extras
	var extras = [];
	<?php foreach($extra_columns as $xc) { ?>
	val = $('#<?php echo $xc['column'] ?>').val()
	extras.push(val);
	<?php }?>
	
	//Replace commas with slashes
	xt = extras.toString();
    xt = xt.replace(/,/g , '/');
	
	gen_invoice_href = '<?php echo base_url()."quotation/printQuotation/$rid/quotations/"; ?>' + signatory_title + "/" + signatory + "/" + xt
	show_invoice_href = '<?php echo base_url()."quotations/" ?>' + "Quotation_" + '<?php echo $rid; ?>' + ".pdf";
	
		$.ajax({
            type:'POST',
            url:gen_invoice_href,
            data:$("#quotation_extras").serialize()
        }).done(function(response) {
                console.log(show_invoice_href);
                parent.$.fancybox.open({
                    href: show_invoice_href,
                    type: 'iframe',
                    autoSize: false,
                    height: 842,
                    width: 595 
                });
            }) 
		})
	})

</script>