<style>
    label{
        display: block;
    }
    #ide{
        margin: 0 aut0 auto;
    }
    form input,select,textarea {
        padding: 5px;
        border: 1px solid #d4d4d4;
        border-bottom-right-radius: 5px;
        border-top-right-radius: 4px;

        line-height: 1.5em;

        /* some box shadow sauce :D */
        box-shadow: inset 0px 2px 2px #ececec;
    }
    form input:focus {
        /* No outline on focus */
        outline: 0;
        /* a darker border ? */
        border: 1px solid #bbb;
    }
    #ide{
        background: rgb(246,248,249); /* Old browsers */
        /* IE9 SVG, needs conditional override of 'filter' to 'none' */
        background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y2ZjhmOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjIwJSIgc3RvcC1jb2xvcj0iI2U1ZWJlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmNWY3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
        background: -moz-linear-gradient(top,  rgba(246,248,249,1) 0%, rgba(229,235,238,1) 20%, rgba(245,247,249,1) 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,248,249,1)), color-stop(20%,rgba(229,235,238,1)), color-stop(100%,rgba(245,247,249,1))); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* IE10+ */
        background: linear-gradient(to bottom,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#f5f7f9',GradientType=0 ); /* IE6-8 */
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 1px solid black;
        box-shadow: 3px;
    }  

</style>
<script>
    <?php $ci= & get_instance();
    $labrefs=$ci->loadLabrefBatch();
    ?>
 $(function () {
     
     $('#addLAB').hide();
      $('#identi').prop('action',"<?php echo base_url() . 'identification/saveDescription/' . $labref . '/' . $test_id ?>");

     
     $('#processor').change(function(){
         action = $(this).val();
         if(action ==='2'){
             $('#addLAB').show(); 
             $('#identi').prop('action',"<?php echo base_url() . 'identification/saveDescriptionBatch/' . $labref . '/' . $test_id ?>");
         }else{
         $('#addLAB').hide(); 
            $('#identi').prop('action',"<?php echo base_url() . 'identification/saveDescription/' . $labref . '/' . $test_id ?>");

             
         }
     });

                 
                    
                    $('#addLAB').click(function(){
                  
                        $row =   '<tr><td><select name="labref[]" id="processor" class="select2"><?php foreach($labrefs as $l):?><option value="<?php echo $l->lab_ref_no;?>"><?php echo $l->lab_ref_no;?></option><?php  endforeach;?></select></td><td><a href="#remLAB" class="remLAB"> -remove</a></td></td></tr>';
                        $('#batch_table tbody').append($row);
                        return false;
                     
                    });
                    
                     $(document).on('click',' .remLAB',function(){   
                    $(this).closest('tr').remove();
                   
                    });


    $("input").bind("keydown", function (event) {
        if (event.which === 13) {
            event.stopPropagation();
            event.preventDefault();
            $(this).nextAll("input").eq(0).focus();
        }
    });

   
        $("#specification").autocomplete({
            source: function (request, response) {
                $.ajax({url: "<?php echo site_url('identification/Specifications_suggestions'); ?>",
                    data: {term: $("#specification").val()},
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
    });

    $(function () {
        $("#findings").autocomplete({
            source: function (request, response) {
                $.ajax({url: "<?php echo site_url('identification/Findings_suggestions'); ?>",
                    data: {term: $("#findings").val()},
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });

        $('#cancel').click(function () {
            window.location.href = '<?php echo base_url() ?>analyst_controller';
        });
    });

    $(function () {
        $("#procedure").autocomplete({
            source: function (request, response) {
                $.ajax({url: "<?php echo site_url('identification/procedure_suggestions'); ?>",
                    data: {term: $("#procedure").val()},
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
    });
    $(document).ready(function () {
        $('#update').hide();
        $('#i_repeat').change(function () {
            i_repeat = $(this).val();

            if (i_repeat == '') {
                $('#save').show();
                $('#update').hide();
            } else {
                $('#save').hide();
                $('#update').show();
            }

            $('#procedure').val('');
            $('#specification').val('');
            $('#findings').val('');

            $.getJSON("<?php echo site_url('identification/load/' . $labref); ?>/" + i_repeat, function (data) {
                $('#procedure').val(data[0].description);
                $('#specification').val(data[0].specification);
                $('#findings').val(data[0].value3);
            });

        });

        $('#save').click(function () {
           // $(this).attr('disabled', true);
            $(this).attr('value', 'Please wait....');
        });

        $('#update').click(function () {
            data = $('#identi').serialize();
            i_repeat = $('#i_repeat').val();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('identification/saveDescriptionU/' . $labref); ?>/" + i_repeat,
                data: data,
                //dataType:"json",
                success: function () {

                    $('#compendia').val('');

                    $('#procedure').val('');
                    $('#specification').val('');
                    $('#findings').val('');

                    $.getJSON("<?php echo site_url('identification/load/' . $labref); ?>/" + i_repeat, function (data) {
                        $('#compendia').val(data[0].compendia);
                        $('#procedure').val(data[0].description);
                        $('#specification').val(data[0].specification);
                        $('#findings').val(data[0].value3);
                    });
                    alert('Update Successfull');
                }, error: function () {
                    alert('An error occured while updating.')
                }
            });




        });

    });
</script>
<body id="identificaton">
    <p></p>
<center><legend>NQCL IDENTIFICATION TESTING</legend>
    <hr>
    <div id="ide">
        <p>
        <form  method="post" id="identi">
            <select name="repeat" id="i_repeat">
                <option value="">-Enter New-</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>

            <table style="position: absolute; float: left;" id="batch_table">
                <thead>
                    <tr>
                        <th colspan="2">
                            <select name="processor" id="processor">
                                <option value="1">Single Processing</option>
                                <option value="2">Batch Processing</option>
                            </select>
                        </th>
                    <tr>
                        <th>Request ID#</th>
                        <th><a href="#addLAB" id="addLAB">+Add</a></th>
                    </tr>                    
                </thead>
                <tbody>

                    <tr>
                        <td>
                            <select name="labref[]" id="processor" class="select2">
                                <option value="<?php echo $labref;?>"><?php echo $labref;?></option>                              
                            </select>
                        </td>
                        <td>(Default)</td>
                    </tr>
                </tbody>
            </table>
            <label><h4>Compendia</h4></label>
            <div class="identify" ><textarea placeholder="e.g In-House Adopted Method, USP Page xyz, BP Vol xyz" id="compendia" name="compendia" cols="50" rows="5" required ></textarea></div>
            <label><h4>Describe the procedure Used</h4></label>
            <div class="identify" ><textarea id="procedure" placeholder="HPLC, UV" name="description" cols="50" rows="5" required></textarea></div>
            <label><h4>State the Specification</h4></label>
            <div class="identify"><textarea id="specification" name="specification" cols="50" rows="5" required></textarea></div>
            <label><h4>Describe Findings</h4></label>
            <div class="identify"><textarea id="findings" name="findings" cols="50" rows="5" required></textarea></div>

            </p>
            <p><input type="submit" value="Submit" id="save"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Update" id="update"/> <input type="button" value="Cancel" id="cancel"/></p>

        </form>
    </div>

</center>
</body>