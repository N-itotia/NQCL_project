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
        min-height: 600px;
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
        margin-left: 750px;
        width: 540px;
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
        width: 250px;
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
<button class="btn-add" style="float: right;">Toggle Open/Close Upload Space</button>
<center><div id="top">Upload Custom Worksheet Template Here</div></center>
<hr>
<?php foreach($sheets as $sheet) ?>
<div id="cont" style="">
    <div id="inst">
        <p><strong>Instructions</strong></p>
        <ol>
            <li>Design a worksheet template in Ms. Excel (*.xlsx).</li>             
            <li>On the upload Give the worksheet a title.</li>            
            <li>Browse and find the worksheet to be uploaded e.g. assay.xlsx.</li>
            <li>Click Upload and wait for the worksheet to be uploaded.</li>
            <li style="font-weight:bolder; color:red;">NB: Please Note that this edit is only for standard sheets, Generic sheets from no's 14 to n<sup>th</sup> excluding 49 & 50, you need to delete the sheet and replace with your new sheets and parameters.</li>
            
        </ol>
    </div>
    <div id="uploader">
        <div id="exists"><?php echo @$exist; ?></div>
        <div id="error"> <?php echo @$error; ?></div>
        <div id="success"><?php echo @$success; ?></div>
        <div id="up_form">
            <?php echo form_open_multipart('/custom_sheets/excel_do_upload_edit1/'.$no); ?>
            <br>
            <label>Title: </label><textarea  name="w_title" id="title" required title="Kindly give the worksheet a name e.g. Assay, Microbial count, needles"><?php echo $sheet->name;?></textarea><br>
           <br>
           <label>Test</label>
           <select name="test_id" id="test_id" required="required">
               <option value="<?php echo $sheet->test_id;?>"><?php echo $sheet->test_name;?></option>
               <?php foreach($tests as $test):?>
               <option value="<?php echo $test->id;?>"><?php echo $test->name;?></option>
               <?php  endforeach;?>
           </select>
           <br>
              <label>Worksheet Number:</label>
               <select name="wk_no" id="wk_no" required="required">
                   <option value="<?php echo $sheet->worksheet_no;?>" selected="selected"><?php echo $sheet->worksheet_no;?></option>
               <?php for($i=1;$i<=14;$i++):?>
               <option value="<?php echo $i;?>"><?php echo $i;?></option>
               <?php endfor;?>
               <option value="49">49</option>
               <option value="50">50</option>
           </select>
           <p></p>
            <input type="file" name="worksheet"  required title="select the worksheet from the location its stored"/><br>
            <br>
            <input type="submit" value="Upload Worksheet Update" name="upload" id=""/>
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
                <?php foreach ($sheets1 as $sheet): ?>
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
$(document).ready(function(){
   
     $('#sheets_table').dataTable({
         
            "bJQueryUI": true
        });
        
        $('.btn-add').click(function() {
        $('.btn-add').prop('value', 'close');
        $('#cont').slideToggle("slow");
    });
    $('#cancel').click(function() {
        $('#cont').slideToggle("slow");
    });
    
    
    $('a.edit-worksheet').click(function(){
            id =$(this).attr('id');
         
              $('#identity_no').val(id);
               $.getJSON("<?php echo base_url() . 'custom_sheets/loadsheetsJe/'; ?>"+id, function(employees) {
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
                href:"#uploader_edit",
               openEffect:"elastic",
               closeEffect:"elastic",
               openSpeed:"slow",
        
               openOpacity:true
            });
            
        });
        
        
   
});
</script>

