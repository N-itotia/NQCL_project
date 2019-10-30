<form class="methods" id="editTest<?php echo $test_id ?>">
		<nav class="panel container">
			<p class="panel-heading">Edit <?php echo $test_name; ?> for <?php echo $quotations_id; ?></p>
				<div class="column control is-2">
					<div class="field">
						<label class="label" >Test</label>
						<input class="input" type="text" name="test" value="<?php echo $test_name ?>">
					</div>
				</div>
				<div class="column control is-4">
					<div class="field">
						<label class="label" >Compendia</label>	
						<select class="select is-multiple" name="compendia">
							<option value="">Select Compendia</option>
								<?php foreach($compendia as $compendium){?>
									<option value="<?php echo $compendium['id'] ?>"><?php echo $compendium['name'] ?></option>
								<?php }?>
						</select>
					</div>
				</div>
			<?php foreach($components as $component){ ?>
					<div class="panel-block">
							<div class="columns">
								<div class="control column is-3">
									<div class="field">
										<label class="label"><?php echo $component['component']; ?></label>
										<input class="input" type="text" name="component" value="<?php echo $component['component']; ?>">
									</div>
								</div>
								<div class="column control is-3">
									<div class="field">
										<label class="label"><?php echo $component['Test_methods'][0]['name'] ?></label>
										<select class="select is-multiple">
											<option value="">Select Method</option>
										</select>
									</div>
								</div>

							</div>
						</div>
				<?php }?>
				<div class="column control is-2">
					<div class="field">
						<input type="submit" class="button is-primary" value="Update">	
					</div>
				</div>
		</nav>
</form>