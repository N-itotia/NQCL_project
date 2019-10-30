
<nav class="panel container">
	<p class="panel-heading"> Edit <?php echo $client_info[0]['Name'] ?></p>
	<div class="column is-2">
		<div class="field">
			<label class="label">Client</label>
			<input class="input" type="input" name="client" value="<?php echo $client_info[0]['Name'] ?>">
		</div>
	</div>
	<div class="column is-2">
		<div class="field">
			<label class="label">Client Type</label>
			<select name="client_type">
				
			</select>
		</div>
		<div class="field">
			<label class="label">Address</label>
			<input class = "input" type="input" name="client" value="<?php echo $client_info[0]['Address'] ?>">
		</div>
		<div class="field">
			<label class="label">Telephone</label>
			<input class="input"> type="input" name="client" value="<?php echo $client_info[0]['Name'] ?>">
		</div>
		<div class="field">
			
		</div>

		<?php if(!empty($client_info[0]['Client_contacts'])){ ?>
			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Contact Person</label>
				</div>
				<div class="field-body">
					<div class="field">
						<p class="control is-expanded has-icons-left">
							<input class="input" type="text" name="contact_person[]" placeholder="Name">
							<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
							</span>
						</p>
					</div>
					<div class="field">
						<p class="control is-expanded has-icons-left has-icons-right">
							<input class="input" type="text" name="contact_role[]" placeholder="Role" value="<?php echo $cc['contact_role'] ?>">
							<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
							</span>
						</p>
					</div>
					<div class="field">
						<p class="control is-expanded has-icons-left has-icons-right">
							<input class="input" type="text" name="contact_email[]" placeholder="Email">
							<span class="icon is-small is-left">
								<i class="fas fa-envelope"></i>
							</span>
						</p>
					</div>
					<div class="field is-expanded has-addons">
						<p class="control">
							<a class="button is-static">+254</a>
						</p>
						<p class="control is-expanded">
							<input class="input" type="tel" placeholder="Phone" name="contact_phone">
						</p>
					</div>
				</div>
			</div>
		<?php } else {?>
		<?php foreach($client_info[0]['Client_contacts'] as $cc){ ?>
			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Contact Person</label>
				</div>
				<div class="field-body">
					<div class="field">
						<p class="control is-expanded has-icons-left">
							<input class="input" type="text" name="contact_person" placeholder="Name" value="<?php echo $cc['contact_name'] ?>">
							<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
							</span>
						</p>
					</div>
					<div class="field">
						<p class="control is-expanded has-icons-left has-icons-right">
							<input class="input" type="text" name="contact_role" placeholder="Role" value="<?php echo $cc['contact_role'] ?>">
							<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
							</span>
						</p>
					</div>
					<div class="field">
						<p class="control is-expanded has-icons-left has-icons-right">
							<input class="input" type="text" name="contact_email" placeholder="Email" value="<?php echo $cc['contact_email']; ?>">
							<span class="icon is-small is-left">
								<i class="fas fa-envelope"></i>
							</span>
						</p>
					</div>
					<div class="field is-expanded has-addons">
						<p class="control">
							<a class="button is-static">+254</a>
						</p>
						<p class="control is-expanded">
							<input class="input" type="tel" placeholder="Telephone" value="<?php echo $cc['contact_role']; ?>">
						</p>
					</div>
				</div>
			</div>
		<?php }?>
		<div class="field">
			<label class="label">Contact Email</label>
			<input class="input" type="input" name="contact_email" value="Save">
		</div>
	</div>		
</nav>