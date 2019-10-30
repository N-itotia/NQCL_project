<html>
<body>
	<form id = "systems_wizard" >
	<?php var_dump($multi_tests); foreach($multi_tests as $m) { ?>
		<?php if(in_array($m["id"], $tests_checked)) { ?>   
			<fieldset>
					<legend><?php echo $m["Name"] ?></legend>
					<span class = "smalltext" >Choose System for <?php echo $m["Name"] ?></span>
					<hr>
					<ul class = "no_style">
						<li><input type = "radio" name = "system_<?php echo $m["id"]; ?>" value = "1" >Batch</li>
						<li><input type = "radio" name = "system_<?php echo $m["id"]; ?>" value = "2" >Individual</li>
					</ul>
					<?php if($m["id"] == '2') {?>
					<span class = "smalltext" >Enter no. of stages.</span>
					<hr>
					<label><span>No. of Stages</span>
					<input name = "no_of_stages" type = "text" >
					</label>
					<?php } ?>	
			</fieldset>
	<?php } } ?>
			<fieldset>
				<legend>Save</legend>
			</fieldset>		
	</form>
	<script type="text/javascript">
		
		//Have wizard to loop through Assay and Dissolution
		$("#systems_wizard").jWizard({
				menu:false,
				finishButtonType: 'submit'		
		});

			//On submitting the wizard form
			$('#systems_wizard').submit(function(e){
				e.preventDefault();
				$('.fancybox-inner').unwrap();
					var systems_href = '<?php echo base_url()."quotation/updateSystem/$reqid/$table/$table2/$table3/$client_id" ?>';
					var table = '<?php echo $table; ?>';
					console.log(table)
					console.log(systems_href)
				//POST via ajax
				$.ajax({
					type:'POST',
					url: systems_href,
					data:$("#systems_wizard").serialize()
					}).done(function(response){
						console.log(table);
						if(table != 'invoice'){
							href = '<?php echo base_url()."client_billing_management/showBillPerTest/$reqid/$table/$table2/$table3/$client_id" ?>'
								parent.$.fancybox.open({
		                            href:href,
		                            type: 'iframe',
		                            autoSize:false,
		                            autoDimensions:false,
		                            width:700,
		                            height:490,
		                            'beforeClose':function(){
		                                //getData();
		                            }
	                         })
						}
						else{
							parent.$.fancybox.close();
						}
					}).fail(function(response){
						console.log(response);
					})
				})



	</script>
	</body>
</html>