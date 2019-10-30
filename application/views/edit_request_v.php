<style>


.select2-container {
  box-sizing: border-box;
  display: inline-block;
  margin: 0;
  position: relative;
  vertical-align: middle; }
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container .select2-selection--single .select2-selection__rendered {
      display: block;
      padding-left: 8px;
      padding-right: 20px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap; }
    .select2-container .select2-selection--single .select2-selection__clear {
      position: relative; }
  .select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered {
    padding-right: 8px;
    padding-left: 20px; }
  .select2-container .select2-selection--multiple {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    min-height: 32px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container .select2-selection--multiple .select2-selection__rendered {
      display: inline-block;
      overflow: hidden;
      padding-left: 8px;
      text-overflow: ellipsis;
      white-space: nowrap; }
  .select2-container .select2-search--inline {
    float: left; }
    .select2-container .select2-search--inline .select2-search__field {
      box-sizing: border-box;
      border: none;
      font-size: 100%;
      margin-top: 5px;
      padding: 0; }
      .select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button {
        -webkit-appearance: none; }

.select2-dropdown {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  box-sizing: border-box;
  display: block;
  position: absolute;
  left: -100000px;
  width: 100%;
  z-index: 1051; }

.select2-results {
  display: block; }

.select2-results__options {
  list-style: none;
  margin: 0;
  padding: 0; }

.select2-results__option {
  padding: 6px;
  user-select: none;
  -webkit-user-select: none; }
  .select2-results__option[aria-selected] {
    cursor: pointer; }

.select2-container--open .select2-dropdown {
  left: 0; }

.select2-container--open .select2-dropdown--above {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--open .select2-dropdown--below {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-search--dropdown {
  display: block;
  padding: 4px; }
  .select2-search--dropdown .select2-search__field {
    padding: 4px;
    width: 100%;
    box-sizing: border-box; }
    .select2-search--dropdown .select2-search__field::-webkit-search-cancel-button {
      -webkit-appearance: none; }
  .select2-search--dropdown.select2-search--hide {
    display: none; }

.select2-close-mask {
  border: 0;
  margin: 0;
  padding: 0;
  display: block;
  position: fixed;
  left: 0;
  top: 0;
  min-height: 100%;
  min-width: 100%;
  height: auto;
  width: auto;
  opacity: 0;
  z-index: 99;
  background-color: #fff;
  filter: alpha(opacity=0); }

.select2-hidden-accessible {
  border: 0 !important;
  clip: rect(0 0 0 0) !important;
  height: 1px !important;
  margin: -1px !important;
  overflow: hidden !important;
  padding: 0 !important;
  position: absolute !important;
  width: 1px !important; }

.select2-container--default .select2-selection--single {
  background-color: #fff;
  border: 1px solid #aaa;
  border-radius: 4px; }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px; }
  .select2-container--default .select2-selection--single .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold; }
  .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #999; }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px; }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      border-color: #888 transparent transparent transparent;
      border-style: solid;
      border-width: 5px 4px 0 4px;
      height: 0;
      left: 50%;
      margin-left: -4px;
      margin-top: -2px;
      position: absolute;
      top: 50%;
      width: 0; }

.select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__clear {
  float: left; }

.select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__arrow {
  left: 1px;
  right: auto; }

.select2-container--default.select2-container--disabled .select2-selection--single {
  background-color: #eee;
  cursor: default; }
  .select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear {
    display: none; }

.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
  border-color: transparent transparent #888 transparent;
  border-width: 0 4px 5px 4px; }

.select2-container--default .select2-selection--multiple {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  cursor: text; }
  .select2-container--default .select2-selection--multiple .select2-selection__rendered {
    box-sizing: border-box;
    list-style: none;
    margin: 0;
    padding: 0 5px;
    width: 100%; }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
      list-style: none; }
  .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
    color: #999;
    margin-top: 5px;
    float: left; }
  .select2-container--default .select2-selection--multiple .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold;
    margin-top: 5px;
    margin-right: 10px; }
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px; }
  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #999;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px; }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
      color: #333; }

.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice, .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__placeholder, .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-search--inline {
  float: right; }

.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
  margin-left: 5px;
  margin-right: auto; }

.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
  margin-left: 2px;
  margin-right: auto; }

.select2-container--default.select2-container--focus .select2-selection--multiple {
  border: solid black 1px;
  outline: 0; }

.select2-container--default.select2-container--disabled .select2-selection--multiple {
  background-color: #eee;
  cursor: default; }

.select2-container--default.select2-container--disabled .select2-selection__choice__remove {
  display: none; }

.select2-container--default.select2-container--open.select2-container--above .select2-selection--single, .select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple {
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-container--default.select2-container--open.select2-container--below .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--default .select2-search--dropdown .select2-search__field {
  border: 1px solid #aaa; }

.select2-container--default .select2-search--inline .select2-search__field {
  background: transparent;
  border: none;
  outline: 0;
  box-shadow: none;
  -webkit-appearance: textfield; }

.select2-container--default .select2-results > .select2-results__options {
  max-height: 200px;
  overflow-y: auto; }

.select2-container--default .select2-results__option[role=group] {
  padding: 0; }

.select2-container--default .select2-results__option[aria-disabled=true] {
  color: #999; }

.select2-container--default .select2-results__option[aria-selected=true] {
  background-color: #ddd; }

.select2-container--default .select2-results__option .select2-results__option {
  padding-left: 1em; }
  .select2-container--default .select2-results__option .select2-results__option .select2-results__group {
    padding-left: 0; }
  .select2-container--default .select2-results__option .select2-results__option .select2-results__option {
    margin-left: -1em;
    padding-left: 2em; }
    .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
      margin-left: -2em;
      padding-left: 3em; }
      .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -3em;
        padding-left: 4em; }
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
          margin-left: -4em;
          padding-left: 5em; }
          .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -5em;
            padding-left: 6em; }

.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #5897fb;
  color: white; }

.select2-container--default .select2-results__group {
  cursor: default;
  display: block;
  padding: 6px; }

.select2-container--classic .select2-selection--single {
  background-color: #f7f7f7;
  border: 1px solid #aaa;
  border-radius: 4px;
  outline: 0;
  background-image: -webkit-linear-gradient(top, white 50%, #eeeeee 100%);
  background-image: -o-linear-gradient(top, white 50%, #eeeeee 100%);
  background-image: linear-gradient(to bottom, white 50%, #eeeeee 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0); }
  .select2-container--classic .select2-selection--single:focus {
    border: 1px solid #5897fb; }
  .select2-container--classic .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px; }
  .select2-container--classic .select2-selection--single .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold;
    margin-right: 10px; }
  .select2-container--classic .select2-selection--single .select2-selection__placeholder {
    color: #999; }
  .select2-container--classic .select2-selection--single .select2-selection__arrow {
    background-color: #ddd;
    border: none;
    border-left: 1px solid #aaa;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    height: 26px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
    background-image: -webkit-linear-gradient(top, #eeeeee 50%, #cccccc 100%);
    background-image: -o-linear-gradient(top, #eeeeee 50%, #cccccc 100%);
    background-image: linear-gradient(to bottom, #eeeeee 50%, #cccccc 100%);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFCCCCCC', GradientType=0); }
    .select2-container--classic .select2-selection--single .select2-selection__arrow b {
      border-color: #888 transparent transparent transparent;
      border-style: solid;
      border-width: 5px 4px 0 4px;
      height: 0;
      left: 50%;
      margin-left: -4px;
      margin-top: -2px;
      position: absolute;
      top: 50%;
      width: 0; }

.select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__clear {
  float: left; }

.select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__arrow {
  border: none;
  border-right: 1px solid #aaa;
  border-radius: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
  left: 1px;
  right: auto; }

.select2-container--classic.select2-container--open .select2-selection--single {
  border: 1px solid #5897fb; }
  .select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow {
    background: transparent;
    border: none; }
    .select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow b {
      border-color: transparent transparent #888 transparent;
      border-width: 0 4px 5px 4px; }

.select2-container--classic.select2-container--open.select2-container--above .select2-selection--single {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  background-image: -webkit-linear-gradient(top, white 0%, #eeeeee 50%);
  background-image: -o-linear-gradient(top, white 0%, #eeeeee 50%);
  background-image: linear-gradient(to bottom, white 0%, #eeeeee 50%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0); }

.select2-container--classic.select2-container--open.select2-container--below .select2-selection--single {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  background-image: -webkit-linear-gradient(top, #eeeeee 50%, white 100%);
  background-image: -o-linear-gradient(top, #eeeeee 50%, white 100%);
  background-image: linear-gradient(to bottom, #eeeeee 50%, white 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFFFFFFF', GradientType=0); }

.select2-container--classic .select2-selection--multiple {
  background-color: white;
  border: 1px solid #aaa;
  border-radius: 4px;
  cursor: text;
  outline: 0; }
  .select2-container--classic .select2-selection--multiple:focus {
    border: 1px solid #5897fb; }
  .select2-container--classic .select2-selection--multiple .select2-selection__rendered {
    list-style: none;
    margin: 0;
    padding: 0 5px; }
  .select2-container--classic .select2-selection--multiple .select2-selection__clear {
    display: none; }
  .select2-container--classic .select2-selection--multiple .select2-selection__choice {
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px; }
  .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
    color: #888;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px; }
    .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover {
      color: #555; }

.select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
  float: right; }

.select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
  margin-left: 5px;
  margin-right: auto; }

.select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
  margin-left: 2px;
  margin-right: auto; }

.select2-container--classic.select2-container--open .select2-selection--multiple {
  border: 1px solid #5897fb; }

.select2-container--classic.select2-container--open.select2-container--above .select2-selection--multiple {
  border-top: none;
  border-top-left-radius: 0;
  border-top-right-radius: 0; }

.select2-container--classic.select2-container--open.select2-container--below .select2-selection--multiple {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; }

.select2-container--classic .select2-search--dropdown .select2-search__field {
  border: 1px solid #aaa;
  outline: 0; }

.select2-container--classic .select2-search--inline .select2-search__field {
  outline: 0;
  box-shadow: none; }

.select2-container--classic .select2-dropdown {
  background-color: white;
  border: 1px solid transparent; }

.select2-container--classic .select2-dropdown--above {
  border-bottom: none; }

.select2-container--classic .select2-dropdown--below {
  border-top: none; }

.select2-container--classic .select2-results > .select2-results__options {
  max-height: 200px;
  overflow-y: auto; }

.select2-container--classic .select2-results__option[role=group] {
  padding: 0; }

.select2-container--classic .select2-results__option[aria-disabled=true] {
  color: grey; }

.select2-container--classic .select2-results__option--highlighted[aria-selected] {
  background-color: #3875d7;
  color: white; }

.select2-container--classic .select2-results__group {
  cursor: default;
  display: block;
  padding: 6px; }

.select2-container--classic.select2-container--open .select2-dropdown {
  border-color: #5897fb; }

</style>

<div id ="fancybox_label" class = "hidden2" >
    <form id = "print_label">
        <input type = "hidden" name="ndqno" id ="label_ndqno" class = "label_ndqno" />	
        <div>
            <fieldset>
                <legend><span>Label for </span><span id ="ndqno" class = "label_ndqno"></span></legend>
                <ul id = "testlist"></ul>
            </fieldset>
        </div>
        <div class = "clear">
            <div class = "left_align">
                <label for = "no_of_prints">No. of Prints</label>
            </div>
        </div>

        <div class = "clear" >
            <div class = "left_align">
                <input type ="text" id="no_of_prints" name="no_of_prints" class="validate[required]" />
            </div>
        </div>
        <div class = "clear" >		
            <div class = "left_align">
                <input type ="submit" value="print" class="submit-button" />
            </div>
        </div>	
    </form>	
</div>
			<div class = " popupform hidden2" id = "client<?php echo $client->id?>" >
				<form id = "editclient<?php echo $client->id ?>" data-formid = "editclient" >
				<div>
				<legend>Edit. <?php echo $client->Name ?></legend>
				<hr />
				</div>
				<div id = "add_success" class ="hidden2" >
					<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
				</div>	

				<div class = "clear">
					<div class = "left_align">
						<label for = "cname">Client Name</label>
					</div>
					<div class = "right_align">
						<textarea name = "cname" required ><?php  echo $client->Name ?></textarea>
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "cadd">Client Address</label>
					</div>
					<div class = "right_align">
						<textarea name = "cname" required ><?php  echo $client->Address ?></textarea>
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "ctype">Client Type</label>
					</div>
					<div class = "right_align">
						<select name = "ctype" id = 'ctype<?php echo $client->id ?>' required>
							<option>A</option>
							<option>B</option>
							<option>C</option>
							<option>D</option>
						</select> 
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "cemail">Client Email</label>
					</div>
					<div class = "right_align">
						<textarea name = "cname" required ><?php  echo $client->email ?></textarea>
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "comment">Comment</label>
					</div>
					<div class = "right_align">
						<textarea name = "comment" required ></textarea>
					</div>
				</div>
				<div class  = "clear">
						<div class = "right_align">
							<input type = "submit" class = "submit-button" value = "Save" />
						</div>
				</div>

				<input type = "hidden" id = "dbctype<?php echo $client->id ?>" name = "dbctype" value = "<?php echo $client -> Client_type ?>" />	
				<input type = "hidden" name = "cid" value = "<?php echo $client->id ?>" />
				<input type = "hidden" id = "dbactivestatus<?php echo $client->id ?>" name = "dbactivestatus" value = "<?php echo $client->Edit_status ?>" />	
			</form>
			</div>

<form id = "analysisreq" >

<?php /*/var_dump($tests_issued[0]['Test_id'])  

foreach($tests_issued as $tests_i){
			
		$tests_ids[] = $tests_i['Test_id'];	  

		}

		//var_dump($tests_ids) ;*/
?>
<input type="hidden" name="labref_id" id="labref_id" value="<?php echo $request[0]['id'] ?>" />
<input type="hidden" name="lab_ref_no1" id="lab_ref_no1" value="<?php echo $request[0]['request_id'] ?>" />
<input type="hidden" name="client_type" id="client_type" value="<?php echo $client -> Client_type ?>" />


<p class="labrefno">Analysis Request Register&nbsp;&rarr;&nbsp;<label class="labrefno" id="labref_no"><a href="<?php echo site_url('/request_management/edit_history/')."/".$reqid;?>" ><?php echo $request[0]['request_id'] ?></a></label>
	&nbsp;&nbsp;<!--label id="urgent">Urgency</label><input type = "checkbox" name= "urgency" value="1" <?php //if($request['Urgency'] == 1){ echo "checked";} else{ echo ""; } ?> /-->
</p>

<table id="tests" class="">
<!--tr>
	<th style="font-size: 13px">ANALYSIS REQUEST REGISTER</th>
</tr-->

<legend><hr /></legend>
<tr>
	<td>Priority</td>
	<td>
		<select id = "priority" name = "priority" >
			<option value = "High">High</option>
			<option value = "Medium">Medium</option>
			<option value = "Low" >Low</option>
		</select>
	</td>
</tr>

<tr><td>Request ID</td><td><input class="" type="text" name="lab_ref_no" id="lab_ref_no" <?php if ($issuance_status[0]['count'] > 0){ echo "readonly";} ?> value="<?php echo $request[0]['request_id'] ?>" /></td></tr>

<tr>
<td><legend>Client Detais&nbsp;&raquo;&nbsp;<a id = 'client_edit'>Edit</a></legend>
<hr /></td>

<tr>
<td>Client Name</td>
<td>

   <select id="c_id" name="client_id_1" class="select2" required >
	<option value="<?php echo $client -> id;?>"><?php echo $client->Name;?></option>
	<?php foreach($clients2 as $cl):?>
	<option value="<?php echo $cl->id;?>"><?php echo $cl->name;?></option>
	<?php endforeach;?>

	</select>
	<textarea name="client_name" id="applicant_name" readonly><?php echo $client -> Name ?></textarea>	
	<input type="hidden" name="client_id" id="c_id" value="<?php echo $client -> id ?>"/>
</td>

<td>Client Address</td>
<td><textarea type="text" name="client_address" id="applicant_address"  readonly ><?php echo $client ->Address; ?></textarea></td>
</tr>

<tr>
	<td>Client Type</td>
	<td><select id="clientT" name="clientT" readonly  >
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="D">D</option>
	<option value="E">E</option>
	</select>
	<input type="hidden" id="db_clientype" value="<?php echo $client -> Client_type ?>" />
</td>
<td>Client Email</td>
<td><input type="text" id="client_email" name="client_email" readonly value="<?php echo $client -> email ?>"  ></td>
</tr>
<tr><td><hr></td></tr>
<tr>
<td>Contact Name</td>
<td><input type="text" id="contact_name" name="contact_person" readonly value="<?php echo $client -> Contact_person; ?>" required  ></label>
</td>

<td>Contact Telephone</td>
<td><input type="text" name="contact_phone" id="contact_phone" readonly value="<?php  echo $client -> Contact_phone; ?>" required  /></td>
</tr>

<td><legend>Product Detais</legend>
<hr /></td>
</tr>
<td>Dosage Form</td>
<td><select name="dosage_form" id="dosage_form" required />
	<option value=""></option>
	<?php foreach ($dosageforms as $dosageform) {?>	
	<option value="<?php echo $dosageform -> id ?>" selected ="<?php if($dosageform -> id == $request[0]['Dosage_Form']) { echo "selected";} ?>"><?php echo $dosageform -> name ?></option>
	<?php } ?>
	</select>
	<input type="hidden" id="dform" name="df" value="<?php echo $request[0]['Dosage_Form'] ?>"
</td>


</tr>

<tr>
	<td>Product Name</td>
<td><textarea type="text" name="product_name" class="validate[required]" ><?php echo $request[0]['product_name']; ?></textarea></td>
	
	<td>Label Claim</td>
	<td>
	<textarea name="label_claim" required ><?php echo $request[0]['label_claim'] ?></textarea>
	</td>
	
</tr>

<tr>
<td>Manufacturer Name</td>
<td><input type="text" name="manufacturer_name" class="validate[required]"  value="<?php echo $request[0]['Manufacturer_Name'] ?>" required /></td>

<td>Manufacturer Address</td>
<td><input type="text" name="manufacturer_address" class="validate[required]" value="<?php echo $request[0]['Manufacturer_add'] ?>" required /></td>
</tr>

<tr>
<td>Batch/Lot Number</td>
<td><input type="text" name="batch_no" value="<?php echo $request[0]['Batch_no']; ?>" required /></td>
<td>Quantity Submitted</td>
<td><input type="text" name="quantity" class="validate[required]" value="<?php echo $request[0]['sample_qty']; ?>" required /></td>
   <td><select name = "packaging" id = "packaging" class ="validate[required]" >
    	<option value=""></option>
                    <?php foreach ($packages as $package) { ?>	
                        <option value="<?php echo $package->id ?>" data-text = "<?php echo $package ->name ?>" ><?php echo $package->name ?></option>
                    <?php } ?></select>
                <input type="hidden" id="db_packaging" name="df" value="<?php echo $request[0]['packaging'] ?>"    
                </td>
</tr>

<tr>
<td>Active Ingredients</td>
<td><textarea name="active_ingredients" class="validate[required]" required ><?php echo $request[0]['active_ing']; ?></textarea></td>
</textarea></td>

<td id="ref_no_td">Client Sample Reference Number</td>
<td><input type="text" name="client_ref_no" id="appl_ref_no" value="<?php echo $request[0]['clientsampleref']; ?>" /></td>
</tr>

<tr id = "dateformatitle">
<td><span class = "misc-title smalltext gray_out">Choose Date of Manufacture & Date of Expiry Date Format</span></td>
</tr>

<!--<tr id="dateformat">
<td id = "dmy"><span>Day-Month-Year</span></td>
<td><input type= "checkbox" name = "dateformat" id = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "dmy" /></td>
<td id = "my"><span>Month-Year</span></td>
<td><input type= "checkbox" name = "dateformat" id = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "my" /></td>
</tr>-->

<tr>
<td>&nbsp;</td>
</tr>

<!--<tr id="dmy" class = "<?php if($request[0]['dateformat'] == "dmy"){echo " " ;} else{ echo "hidden2" ;} ?>" >
<td>Manufacture Date</td>
<td><input type = "text" id = "date_m" name ="date_m" readonly class = "validate[required] datepicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['Manufacture_date']))  ?>" /></td>


<td>Expiry Date</td>
<td><input type = "text" id = "date_e" name = "date_e" readonly class = "validate[required] datepicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['exp_date']))  ?>" /></td>
<tr>
-->

<tr id="my"  >
<td>Manufacture Date&nbsp;</td>
<td><input type = "text" id = "m_date" 	name ="m_date"  class = "validate[required] datepicker" data-month = "monthpicker" value = "<?php echo $request[0]['Manufacture_date']  ?>" /></td>


<td>Expiry Date</td>
<td><input type = "text" id = "e_date" name = "e_date"  class = "validate[required] datepicker" data-month = "monthpicker" value = "<?php echo $request[0]['exp_date']  ?>" /></td>
<tr>

<tr>
<td>Designation Date</td>
<td><input type = "hidden" name="designation_date" id="designation_date" value="<?php echo $request[0]['Designation_date'] ?>"/></td>
</tr>

</table>

<table>
<tr>
<legend>Departmental Tests</legend>
<hr />

<label class="misc_title" >Tests Selected:</label>
<tr><span class="lightbg" id="testspan" >
	<?php 
	//var_dump($tests_checked);
	foreach($tests_checked as $test_checked){
		echo " " . $test_checked['Alias']. " ";	
	
	} ?>
	
	
	</span>
</tr>


</tr>

<tr>
<!--Accrodion-->
<td>
<div class="Accordion" id="sampleAccordion" tabindex="0">
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Wet Chemistry Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php
				foreach ($wetchemistry as $wetchem) {
					//$checked = in_array($wetchem -> Alias,$tests_checked) ? 'checked="checked"' : "";
					echo "<tr><td>" . $wetchem -> Name . "</td><td><input type=checkbox id=" . $wetchem -> Alias . " value=" . $wetchem -> id. " name=test[]/></td></tr>";
				}
			?>
			</table>
		</div>
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Biological Analysis Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php

				foreach ($microbiologicalanalysis as $microbiology) {
					echo "<tr><td>" . $microbiology -> Name . "</td><td><input type=checkbox id=" . $microbiology -> Alias . " name=test[] value=" . $microbiology -> id . " /></td></tr>";
				}
				?>
			</table>
		</div> 
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Medical Devices Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
			<?php
			
			foreach ($medicaldevices as $medical) {
			
				echo "<tr><td>" . $medical -> Name . "</td><td><input type=checkbox id=" . $medical -> Alias . " name=test[] value=" . $medical -> id . " /></td></tr>";
			}
			?>
			</table>
		</div>
	</div>
</div>
</td>
<!-- End Accrodion-->
<td>Full Monograph <input type="checkbox" name="fullmonograph" id="fullmonograph" value="fullmonograph" /></td>
</tr>
</table>

<table>

<legend>Reasons for edit</legend>
<hr />
<tr>
<td>
<textarea name="edit_notes" class="validate[required]" ><?php echo $request[0]['edit_notes'] ?></textarea>
</td>
</tr>

<input type="hidden" name="designator_name" value="<?php 

$userarray = $this->session->userdata;
$user_id = $userarray['user_id'];

$user_typ = User::getUserType($user_id);
$user_name = $user_typ[0]['username'];
$usertype = $user_typ[0]['user_type'];

echo $user_name ?>" /> 

<input type ="hidden" name="designation" value="<?php echo $usertype; ?>"/>

<input type = "hidden" name = "dbdateformat" id = "dbdateformat" value = "<?php echo $request[0]['dateformat'] ?>" />

<input type = "hidden" name="db_priority" id ="db_priority" value ="<?php echo $request[0]['priority'] ?>" />

<!--label></label-->
<tr>
	<td><input class="submit-button" name="submit" type="submit" value="Update Request"></td>
</tr>

</table>

</form>

</div>

<script>

$('#client_edit').on('click', function(){
	$.fancybox({
		href:'#client<?php echo $client->id?>',
		width: 600
	})
})

		$('#clientform').submit(function(e){

			e.preventDefault();

			var empty_inputs = false;

			$(".input_form input").each(function(){
				if($(this).val() == ''){
					empty_inputs = true;
					console.log(empty_inputs);
				}
			});

			if(empty_inputs){

				alert("Please fill empty fields to continue.")
			}

			else {
	
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "client_management/save" ?>',
		data: $('#clientform').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				parent.$.fancybox.close();
				//document.location.reload();	
			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

 }

})



	//Validation Engine
	$('#analysisreq').validationEngine();

	//Change Client
	$("#clientT").change(function() {
	
		var str = "";
		
		$("#clientT option:selected").each(function() {
			str += $(this).val() + "";
		});
		
		//Find out how to go through list and change particular character.
		
		//$("#labref_no").text("NDQ" + str + <?php echo date('Y') ?>  + "<?php echo date('m')?>"  + "<?php //echo $last_req_id -> id + 1; ?>");
		//var label_contents = $("#labref_no").html();
		//$("#lab_ref_no").val(label_contents);
	}).trigger('change');
</script>






<script>
	$(function(){
  $('#c_id').select2();
	//if($("#dbdateformat").val() == $("#dateformat").val() ){	
 		dfmt =	$("#dbdateformat").val() 			
		console.log($('input[value = "'+dfmt+'"]').attr("checked", true ));
	//}

	$('#lab_ref_no[readonly]').on('click', function(){
		val = $(this).val();
		
		n = noty({
			"text": "NDQD No. Edit Disallowed. " +val+" already assigned to analyst.",
			"modal":true,
			"type":"warning"
		})
		
		n;
	})
		

/*$('#date_m, #date_e').datepicker({
changeYear:true,
dateFormat:"dd-M-yy"
});

$('#date_m').datepicker("option", "maxDate", '0');
$('#m_date').datepicker("option", "maxDate", '0');



$('input[data-month = "monthpicker"]').datepicker({
	dateFormat: 'M yy',
	changeMonth:true,
	changeYear: true,
	showButtonPanel: true,

	onClose: function(dateText, inst){
		var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
		var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
		$(this).val($.datepicker.formatDate('M yy', new Date(year, month, 1)));
	}
});

$("#m_date, #e_date").focus( function() {
	$(".ui-datepicker-calendar").hide();
	$("#ui-datepicker-div").position({
		my: "center top",
		at: "center bottom",
		of: $(this)
	})
})*/





/*$('input[data-rename ="dateformat"]').live('click', function(){
fmt = $(this).val();
console.log(fmt);
if($(this).is(':checked')){
	console.log($('tr[id = "'+fmt+'"]').show());
	if(fmt == 'dmy'){
		$('input[value = "my"]'). hide();
		$('td[id = "my"]').hide();
	}
	else if(fmt == 'my'){
		$('input[value = "dmy"]').hide();
		$('td[id = "dmy"]').hide();
	}
}
else{
	$('tr[id = "'+fmt+'"]').hide();
	if(fmt == 'dmy'){
		$('input[value = "my"]'). show();
		$('td[id = "my"]').show();
	}
	else if(fmt == 'my'){
		$('input[value = "dmy"]').show();
		$('td[id = "dmy"]').show();
	}
}

})*/


		$("#dosage_form option").each(function(){
			
			if($(this).val() == $("#dform").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})


		$("#packaging option").each(function(){
			
			if($(this).val() == $("#db_packaging").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		$("#clientT option").each(function(){
			
			if($(this).val() == $("#db_clientype").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		$("#expiryMonth option").each(function(){
			
			if($(this).val() == $("#e_date_month").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		//Priority
		$("#priority option").each(function(){
			
			if($(this).val() == $("#db_priority").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		$("#manufactureMonth option").each(function(){
			
			if($(this).val() == $("#m_date_month").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		
		var checkboxarray = <?php echo json_encode($tests_checked) ?>;
		
		$.each(checkboxarray, function (i, elem){
			
			//alert(elem.Alias)
		
		    if($('#' + elem.Alias) != 'undefined'){
			
			$('#' + elem.Alias).attr('checked', true);
			
		  }
		
		})


		        $("#applicant_name").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('request_management/suggestions'); ?>",
                    data: {term: $("#applicant_name").val()},
                    dataType: "json",
					
                    type: "POST",
                    success: function(data) {
                        response(data);
						
                    }
                });
            },
            minLength: 2,
            select: function(e, ui) {
                alert(ui.item.value);
                $.getJSON("<?php echo base_url().'request_management/getCodes/'; ?>" + ui.item.id, function(codes) {
                    var codesarray = codes;
					alert(codes)
                    for (var i = 0; i < codesarray.length; i++) {
                        var object = codesarray[i];
                        for (var key in object) {

                            var attrName = key;
                            var attrValue = object[key];

                            switch (attrName) {

                                case 'id':

                                    //var dat=$('#clientid_old').val(attrValue);

                                    $('#c_id').val(attrValue);


                                    break;

                                case 'Address':

                                    $('#applicant_address').val(attrValue);

                                    break;

                                case 'Client_type':

                                    $('#clientT').val(attrValue);
                                    break;

                                case 'Contact_person':

                                    $('#contact_name').val(attrValue);

                                    break;

                                case 'Contact_phone':

                                    $('#contact_telephone').val(attrValue);

                                    break;

                                case 'email':

                                    $('#client_email').val(attrValue);    

                                    break;
                            }

                        }

                    }


                })
            },
            Delay: 10
        })


		
        $('#analysisreq').submit(function(e) {
            e.preventDefault();

            //Check if there are empty fields with required field
            var valid;
            console.log

            //Loop through required fields, if any empty, set validity false
            $('form#analysisreq input[class = "validate[required]"]').each(function(){
                var el = $(this);
                if(el.val() == ""){
                    valid = false;
                }
            })


            if(valid != false){
            	console.log(valid);
				
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url() . 'request_management/edit_save/'.$labref ?>",
                data: $('#analysisreq').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {					
						
					
                        $('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
						
					
						
                        $('form').each(function() {

                            this.reset();
                        })

                        var n = noty({
                        	text:"Edit Successful.",
                        	type:'success'
                        })

                        //Noty initialize
                        n;
						
						window.location.href = "<?php echo base_url().'request_management/edit/'.$labref; ?>";

                    }
                    else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function() {
                }
            })
		}
		else{
			//Define noty variable
                var n = noty({
                    text:"Please fill all required fields.",
                    type:'error',
                    timeout: false
                })

                //Noty initialize
                n;
		}

        })	
	});
</script>




<script language="JavaScript" type="text/javascript">
		var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");

		$(function() {
			$("#fullmonograph").change(function() {
				if($('#fullmonograph').is(':checked')) {
					document.getElementById("identification").checked = true;
					document.getElementById("dissolution").checked = true;
					document.getElementById("disintegration").checked = true;
					document.getElementById("friability").checked = true;
					document.getElementById("assay").checked = true;
					document.getElementById("uniformity").checked = true;
					document.getElementById("ph").checked = true;
					document.getElementById("contamination").checked = true;
					document.getElementById("sterility").checked = true;
					document.getElementById("endotoxin").checked = true;
					document.getElementById("integrity").checked = true;
					document.getElementById("viscosity").checked = true;
					document.getElementById("microbes").checked = true;
					document.getElementById("efficacy").checked = true;
					document.getElementById("melting").checked = true;
					document.getElementById("relativity").checked = true;
					document.getElementById("condom").checked = true;
					//document.getElementById("syringe").checked = true;
					document.getElementById("needle").checked = true;
					document.getElementById("glove").checked = true;
					document.getElementById("refractivity").checked = true;
				}
				
			});
		});

	</script>

</html>