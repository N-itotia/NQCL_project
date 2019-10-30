<style>
    #top{
       
        background:#FFBF00;
        color: white;
        text-align: center;
        font-weight: bolder;
        width: 100%;
        height: 50px;
        line-height: 50px;
        border-radius: 5px;
    }
    #cont{
        width: 100%;
        min-height: 800px;
        background: #00CC33;
        padding: 8px;
        border-radius: 10px;
    }
    #inst{
        width: 50%;
        padding: 10px;
        position: absolute;
    }
    #uploader{
        position: absolute;
        margin-left: 550px;
        width: 750px;
        min-height: 600px;
        background: white;
        border-radius: 10px;
    }
    hr{
        background: white;
    }
    label{
        display: block;
    }
    #up_form{
        margin: 0 auto 0 auto;
        margin-left: 150px;
    }
    input[type=text]{
        width: 135px;
    }
    #exists{
        width: 100%;
        height: 30px;
        background: #0063dc;
        color: white;
        font-weight: bolder;
        // display: none;
    }
    #error{
        width: 100%;
        height: 30px;
        background: red;
        color: white;
        font-weight: bolder;
        // display: none;
    }
    #success{
        width: 100%;
        height: 30px;
        background: #00ff00;
        color: black;
        font-weight: bolder;
        // display: none;
    }

    tr.even:hover td,
    #mtTable tr.even:hover td,
    #mtTable tr.even:hover td.sorting_1 { background-color: #00CC33;
                                          border-top: 2px solid #00CC33;
                                          border-bottom: 2px solid #00CC33; }

    tr.odd:hover td,
    #mtTable tr.odd:hover td,
    #mtTable tr.odd:hover td.sorting_1 { background-color: #00CC33;
                                         border-top: 2px solid #00CC33;
                                         border-bottom: 2px solid #00CC33; }

</style>
<center><div id="top">Edit Custom Worksheet Template and Parameters Here</div></center>
<hr>

<div id="cont">
<div id="top_area" style="font-weight:bolder; color:white; font-size:18px; margin:10px;">Please note that this table only applies to the pre-programmed worksheets, thats worksheet from numbers 1 - 13, 49, 50</div>

    <div id="inst">
        <p><strong>Instructions</strong></p>
        <ol>
            <li>Design a worksheet template in Ms. Excel (*.xlsx).</li>             
            <li>On the upload Give the worksheet a title.</li>  
            <li>Worksheet number is automatically assigned and will be in cell <em><u><strong>"C19"</strong></u></em></li>   
              <li>Click the <em><u><strong>"+Add"</strong></u></em> button</li>  
             <li>Parameter entails what the name of the result is e.g.<em><u><strong>Average, rsd, n..</strong></u></em></li>  	
<li>Enter Cell number for the results you have defined e.g.<em><u><strong>Average is cell C25</strong></u></em></li>  				 
            <li>Browse and find the worksheet to be uploaded e.g. Titration.xlsx.</li>
            <li>Click Upload and wait for the worksheet to be uploaded.</li>

        </ol>
    </div>

       <div id="uploader">
        <div id="exists"><?php echo @$exist; ?></div>
        <div id="error"> <?php echo @$error; ?></div>
        <div id="success"><?php echo @$success; ?></div>
        <div id="up_form">
            <?php echo form_open_multipart('/custom_sheets/excel_do_upload/'); ?>
            <br>
            <label>Title: </label><input type="text" name="w_title" id="title" value="" required title="Kindly give the worksheet a name e.g. Assay, Microbial count, needles"/><br>
           <br>
           <label>Test</label>
           <select name="test_id" id="test_id" required="required">
               <option value="">--Select Test--</option>
               <?php foreach($tests as $test):?>
               <option value="<?php echo $test->id;?>"><?php echo $test->name;?></option>
               <?php  endforeach;?>
           </select>
           <br>
           <p></p>
            <input type="file" name="worksheet"  required title="select the worksheet from the location its stored"/><br>
            <br>
            <input type="submit" value="Upload Worksheet" name="upload" id=""/>
            </form> 
        </div>
    </div>
</div>
</div>


<div id="uploader_edit" style="display: none; width: 200; height: 200px;"> 
    <div id="up_form_edit">
        <?php echo form_open_multipart('/custom_sheets/do_upload_edite/'); ?>
        <br>
        <label>Title: </label><input type="text" name="w_title_edit" id="w_title_edit" value="" required title="Kindly give the worksheet a name e.g. Assay, Microbial count, needles"/><br>
        <br>           

        <input type="submit" value="Save Edit" name="upload" id=""/>
        <input type="hidden" id="identity_no" name="id"/>
        <input type="hidden" id="sheet_name" name="sheet_name"/>
        </form> 
    </div>
</div>





<script>
    $(document).ready(function () {
        $(document).ready(function () {

            $('#add').click(function () {

                table = $('#parameter_table > tbody');
                newRow = "<tr class=\"par_add\"><td><input type=\"text\" name=\"parameter[]\" id=\"parameter\"/></td><td><input type=\"text\" name=\"cellno[]\" id=\"cellno\"/><td><input type=\"text\" name=\"test_id[]\" id=\"test_id\"/></td><td><a class=\"rem\" href=\"#?-rem/:_parameter&row\">- Remove</a></td></tr>";



                $('#parameter_table > tbody tr:last').before($(newRow));



                return false;

            });

            $(document).on('click', '.rem', function () {
                $(this).closest('tr').remove();
                return false;
            });

        });

        $('#sheets_table').dataTable({
            "bJQueryUI": true
        });

        $('.btn-add').click(function () {
            $('.btn-add').prop('value', 'close');
            $('#cont').slideToggle("slow");
        });
        $('#cancel').click(function () {
            $('#cont').slideToggle("slow");
        });


        $('a.edit-worksheet').click(function () {
            id = $(this).attr('id');

            $('#identity_no').val(id);
            $.getJSON("<?php echo base_url() . 'custom_sheets/loadsheetsJe/'; ?>" + id, function (employees) {
                $('#w_title_edit').val(employees[0].name);
//                 $("#dept_edit option").filter(function() {
//                     $data=employees[0].department;
//                     if($data==1){
//                         return $(this).text() == 'Wet Chem'; 
//                     }else if($data==2){
//                          return $(this).text() == 'Microbiology'; 
//                     }else{
//                          return $(this).text() == 'Medical Devices'; 
//                     }
//                     
//                 }).prop('selected', true);

                $('#sheet_name').val(employees[0].alias);
            });


            $.fancybox({
                href: "#uploader_edit",
                openEffect: "elastic",
                closeEffect: "elastic",
                openSpeed: "slow",
                openOpacity: true
            });

        });



    });
</script>

