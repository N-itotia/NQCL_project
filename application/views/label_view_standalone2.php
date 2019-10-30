<html>
		<?php for($i=0; $i < $prints_no; $i++) {?>
			<table>
				<thead></thead>
				<tbody>
				<?php $newline_count = 1;?>		
					<tr class = "tr_formating bordered centred_text pagebreak">	
						<td class = "fixed centred_text" >
							<small class = "centred_text" ><?php echo strtoupper($reqid)?><small/>
							<br>	
							<?php 
							$key1 = 1;
							foreach($tests as $key => $value){ 
								if($key1%2){	?>			 
									<span class = "small-text" ><small><?php echo ucfirst(str_replace("_", " ", $value)).","; ?></small></span>
								<?php } else {?>	
									<span class = "small-text" ><small><?php echo ucfirst(str_replace("_", " ", $value))."<br />"; ?></small></span>
								<?php } $key1++; ?>	
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
border-style: dotted dotted dotted dotted;
border-width: thin thin thin thin;

}

.pagebreak{
page-break-before: always;
}

table td {
	table-layout: fixed;
	overflow:hidden;
	text-align:center;
}

table {
	height:109.44px;
	width:230.4px;
}

html { 
	   margin-top:0.0in;
	   margin-bottom:0.02in;
	   text-align:center;
	}

</style>