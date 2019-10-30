<html>	
	<?php for($i=0; $i < $prints_no; $i++) {?>
		<table>
			<thead></thead>
			<tbody>
			<?php $newline_count = 1;?>
			<tr class = "tr_formating centred_text">	
					<td class = "fixed centred_text" >
						<small class = "centred_text" ><?php echo strtoupper($reqid)?><small/>
						<br>	
						<?php 
						$tests = Request_details::getTestsNames($reqid);
						$key = 1;
						//var_dump($tests);
						foreach($tests as $test){ 
							if($key%2){	?>			 
								<span class = "small-text" ><small><?php echo ucfirst($test['Name']).","; ?></small></span>
							<?php } else {?>	
								<span class = "small-text" ><small><?php echo ucfirst($test['Name'])."<br />"; ?></small></span>
							<?php } $key++; ?>	
						<?php } ?>
					</td>
					<?php $newline_count++; ?> 	
					
				</tr>
			</tbody>
		</table>
	<?php } ?>
</html>						

<style media="screen" type="text/css">

.centred_text {
	text-align:center;
	font-size:1.1em;
}

.bordered {
border-style: dotted;
border-width: thin;
}

table td {
	table-layout: fixed;
	overflow:hidden;
}

table {
	height:109.44px;
	width:230.4px;
}


html {
	   margin-top:0.0in;
	   margin-bottom:0.02in;
	}

</style>