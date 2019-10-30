<html>

<button id="print" onclick="printDiv('printSingleQuotation')">Print</button>
<div id = "printSingleQuotation">
<?php $this -> load -> view("document_header_v");?>
<h2>Quotation</h2>
	<div>
	<form class="methods">
		<ul>
			<li>
			<fieldset>
				<legend>Quotation Summary</legend>
					<?php foreach($quotation_summary[0] as $key => $value) { ?>
						<li>
							<?php if(!empty($value) && ($key != 'id' )) { ?>
								<label><?php echo $value; ?></label>
							<?php }?>
						</li>
					<?php } ?>
				</fieldset>
			</li>
		</ul>	
	</form>
	</div>
	<iframe style="height: 100%; width:100%; border: none" src="<?php echo base_url().'client_billing_management/showBillPerTest/'."$quotations_id".'/quotations/tests/q_request_details/q_entry'?>"></iframe>
</div>
</html>


<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>