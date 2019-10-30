<style>
    #top{
        background:#00CC33;
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
<button class="btn-add" style="float: right;">Toggle Open/Close Upload Space</button>  <input type="text" placeholder="Wk. No" id="wkno"/><button class="btn-go">Go</button>
<center><div id="top">Upload Custom Worksheet Template Here</div></center>
<hr>

<div id="cont" style=" display:none;">
    <div id="inst">
        <p><strong>Instructions</strong></p>
        <ol>
            <li>Design a worksheet template in Ms. Excel (*.xlsx).</li>             
            <li>On the upload Give the worksheet a title.</li>  
            <li>Worksheet number is automatically assigned and will be in cell "<input type="text" id="wk_number" value="<?php echo $sheet_no[0]->number;?>" style="width:40px;"/>"| <a href="#edit_number" id="edit_number">Save</a></li>   
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
            <?php echo form_open_multipart('/custom_sheets/excel_do_upload_ge/'); ?>
            <br>
            <label>Title: </label><input type="text" style="width:250px;"name="w_title" id="title" value="" required title="Kindly give the worksheet a name e.g. Assay, Microbial count, needles"/><br>
            <br>
            <!--            <label>Test</label>
                        <select name="test_id" id="test_id" required="required">
                            <option value="">--Select Test--</option>
            <?php foreach ($tests as $test): ?>
                                        <option value="<?php echo $test->id; ?>"><?php echo $test->name; ?></option>
            <?php endforeach; ?>
                        </select>-->
            <br>

            <table><tr>
                    <td>
                        Wk No.
                        <input type="text" id="worksheet_number" name="wk_no" style="width:30px;" value="<?php echo $last[0]->worksheet_no + 1; ?>" readonly/>
                    </td>
                    <td>
                        <span id="sheet_name" style="color:red; font-weight: bold;">Please note that Assay has test id 5 and 2 for dissolution</span>               

<!--                        <select  id="component_no" name="tests" >
                            <option></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>-->
<!--                    <td>Unique No. <select  id="sheet_no" name="u_no" >
                            <option></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>

                    </td>-->
                </tr>
                <tr>
                <label id="parameter_label">Set Parameters</label><br>
                </tr>
            </table>
            <table id="parameter_table">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Cell Number</th>
                        <th>Test ID</th>
                        <th>Action (<a id="add" href="#?+add/:_parameter&row">+ Add</a>)</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tr>

                </tr>
            </table>
            <p></p>
            <input type="file" name="worksheet"  required title="select the worksheet from the location its stored"/><br>
            <br>
            <input type="submit" value="Upload Worksheet" name="upload" id="up_loader"/>
            </form> 
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




<div id="worksheet" style="  height: auto;">
    <form>

        <table id = "sheets_table">

            <thead><tr><!--th>No.</th-->
                    <th>Wks No.</th>
                    <th>Worksheet Name</th>
                    <th>Action</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sheets as $sheet): ?>
                    <tr>    
                        <td><?php echo $sheet->worksheet_no; ?></td>
                        <td><?php echo $sheet->name; ?></td>                
                        <td><a href="<?php echo base_url() . 'exceltemplates/' . $sheet->alias . '.xlsx'; ?>" class="worksheet-Download" id="">Download</a></td>   
                        <td><a href="<?php echo base_url().'custom_sheets/excel_edit/'.$sheet->id.'/'.$sheet->worksheet_no;?>" class="edit-worksheet1" id="<?php echo $sheet->worksheet_no; ?>">
                            <?php if($sheet->worksheet_no >= 0 && $sheet->worksheet_no <=14 ){
                                echo 'Edit';
                            }else if($sheet->worksheet_no=='49' || $sheet->worksheet_no=='50' ){ 
                                echo 'Edit';
                                
                            }else{
                                echo '';
                                
                            };?>                            
                            </a></td>   
                        <td><a href="<?php echo base_url() . 'custom_sheets/delete_ge/' . $sheet->id; ?>" class="worksheet-Download" id="<?php echo ucfirst($sheet->alias); ?>">Delete</a></td>   
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
<script>
    $(document).ready(function () {
         $('#cont').slideToggle("slow");
         $('#edit_number').click(function () {
             new_number = $('#wk_number').val();
            $.post("<?php echo base_url() . 'custom_sheets/edit_sheet_number/'; ?>"+new_number,function(){
                alert('Edit successful')
                window.location.href="<?php echo base_url() . 'custom_sheets/generic/'; ?>";
          })  .fail(function() {
    alert( "error" );
     })
 });
        
        $(document).ready(function () {
        
           $('.btn-go').click(function () {
               if($('#wkno').val()===''){
                   alert('Worksheet number cannot be blank');
                   return false;
               }else{
                 window.location.href="<?php echo base_url() . 'custom_sheets/genericedit/'; ?>"+$('#wkno').val();
  
               }
           });

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

