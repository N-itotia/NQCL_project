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

    }
    #inst{
        width: 50%;
        padding: 10px;
        position: absolute;
    }
    #uploader{
        position: absolute;

        width: 100%;
        height: 3100%;
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
</style>
<center><div id="top">Edit worksheet No. <?php echo $this->uri->segment(3); ?></div></center>
<hr>

<div id="cont" style="">

    <div id="uploader">
        <div id="exists"><?php echo @$exist; ?></div>
        <div id="error"> <?php echo @$error; ?></div>
        <div id="success"><?php echo @$success; ?></div>
        <div id="up_form">
            <?php echo form_open_multipart('/custom_sheets/excel_do_upload_ge_edit/' . $this->uri->segment(3)); ?>
            <br>
            <label>Title: </label><input type="text" name="w_title" id="title" value="<?php echo @$name[0]->name; ?>" required title="Kindly give the worksheet a name e.g. Assay, Microbial count, needles"/><br>
            <input type="hidden" name="old_name" id="title" value="<?php echo @$name[0]->alias; ?>" /><br>
            <br>
            <input type="file" name="worksheet"  required title="select the worksheet from the location its stored"/><br>
            <br>
            <table id="parameter_table">
                <thead>         
                <th>Parameter</th>
                <th>Cell</th>
                <th>Test ID</th>
                 <th>Action (<a id="add" href="#?+add/:_parameter&row">+ Add</a>)</th>
                </thead>
                <tbody >
              
                    <?php foreach ($sheets as $sheet): ?>
                        <tr>
                        
                          
                            <td><input type="text" name="parameter[]" value="<?php echo @$sheet->parameter; ?>"/></td>
                            <td><input type="text" name="cellno[]" value="<?php echo @$sheet->cell; ?>"/></td>
                            <td><input type="text" name="test_id[]" value="<?php echo @$sheet->test_id; ?>"/></td>
                            <td><a class="rem" href="#?-rem/:_parameter&row">- Remove</a></td>
                        </tr>
<?php endforeach; ?>
                </tbody>
            </table>

            <input type="submit" value="Save Edit"  class="submit" name="upload" id=""/>
            <input type="submit" value="Back" id="back"/>
            </form> 
        </div>
    </div>
</div>







<script>
    $(document).ready(function () {



        $('#add').click(function () {

            table = $('#parameter_table > tbody');
            newRow = "<tr class=\"par_add\"><td><input type=\"text\" name=\"parameter[]\" id=\"parameter\"/></td><td><input type=\"text\" name=\"cellno[]\" id=\"cellno\"/><td><input type=\"text\" name=\"test_id[]\" id=\"test_id\"/></td><td><a class=\"rem\" href=\"#?-rem/:_parameter&row\">- Remove</a></td></tr>";



            $('#parameter_table > tbody ').append($(newRow));



            return false;

        });

        $(document).on('click', '.rem', function () {
            $(this).closest('tr').remove();
            return false;
        });
        
        
           $('#back').click(function () {
            
                 window.location.href="<?php echo base_url() . 'custom_sheets/generic/'; ?>";
  
               
           });




    });
</script>

