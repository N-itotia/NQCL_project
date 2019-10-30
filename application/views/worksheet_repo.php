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
        height: 300px;
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
        height: 300px;
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
    }
    #error{
        width: 100%;
        height: 30px;
        background: red;
        color: white;
        font-weight: bolder;
    }
    #success{
        width: 100%;
        height: 30px;
        background: #00ff00;
        color: black;
        font-weight: bolder;
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

<hr>

<p><strong><center>ANALYST BATCH PROCESSING WORKSHEET CENTER</center></strong></p><hr>
<legend><a href="<?php echo base_url().'analyst_controller/worksheet_center';?>">Repository</a> &#187 <a href="<?php echo base_url().'analyst_controller/worksheet_uploads';?>">Upload sheets</a> &#187 <a href="<?php echo base_url().'analyst_controller/my_repo';?>">My Repository</a></legend>




<div id="worksheet" style="  height: auto;">
    <form>
        <table id = "sheets_table">

            <thead><tr><!--th>No.</th-->
                    <th>Worksheet Name</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
             <?php foreach ($sheets as $sheet): ?>
            <tr>          
                <td><?php echo $sheet->filename; ?></td>
                <td><a href="<?php echo base_url().'analyst_controller/worksheet_processor/'.$this->session->userdata('user_id').'/'.$sheet->alias; ?>" class="worksheet-Download" id="">Process Worksheets</a></td>   
                <td><a href="<?php echo base_url().'analyst_controller/delete_m/'.$sheet->id.'/'.$sheet->alias;?>" class="worksheet-Download" id="<?php echo ucfirst($sheet->alias); ?>">Delete</a></td>   
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
               $.getJSON("<?php echo base_url() . 'custom_sheets/loadsheetsJ/'; ?>"+id, function(employees) {
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

