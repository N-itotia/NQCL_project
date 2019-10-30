<p><strong><center>ANALYST BATCH PROCESSING WORKSHEET CENTER</center></strong></p><hr>
<legend><a href="<?php echo base_url().'analyst_controller/worksheet_center';?>">Repository</a> &#187 <a href="<?php echo base_url().'analyst_controller/worksheet_uploads';?>">Upload sheets</a> &#187 <a href="<?php echo base_url().'analyst_controller/my_repo';?>">My Repository</a></legend>
<hr />

<?php 
$base1 = base_url().'javascripts/ViewerJS/#';
$base2 = base_url()."pdfcenter/$an/$al.pdf";
$full = $base1.$base2;

?>
<legend>
    <p style="float:left; position: absolute;">PREVIEW</p>
  
</legend>
<br>
<iframe src = "<?php echo $full ?>" width='650' height='600' allowfullscreen webkitallowfullscreen></iframe> 

<div style="float:right; width: 650px; height: 600px; border:1px solid greenyellow; " >
    <form id="bprocss">
    <legend><p style="float:left;position:absolute;">PROCESSOR</p></legend>
         <table style="margin-top: 10px;" id="batch_table" >
            <thead>
                <tr>
                    <th colspan="2">
                        <p><strong><center>BATCH PROCESSOR</center></strong></p>
                    </th>
                <tr>
                    <th>Request ID#</th>
                    <th><a href="#addLAB" id="addLAB">+Add</a></th>
                </tr>                    
            </thead>
            <tbody>

<!--                <tr>
                    <td>
                        <select name="labref[]" id="processor" class="select2">
                            <option value="<?php echo $labref; ?>"><?php echo $labref; ?></option>                              
                        </select>
                    </td>
                    <td>(Default)</td>
                </tr>-->
            </tbody>
        </table>
    <button type="button" id="proccessor"  class="submit" >PROCESS BATCH</button>
    </form>
    
</div>

<script>   
    $(document).ready(function(){
        
        
              $('#proccessor').click(function () {
        
                $.ajax({
                    url: '<?php echo base_url().'analyst_controller/process_batch/'.$an.'/'.$al; ?>',                    
                    type: 'POST',
                    data: $('#bprocss').serialize(),
                    success: function (json) {
                      alert('Batch Processing action successfully completed, you can resume the normal process now of downloading COMPLETED WORKSHEETS.');
                    }
                });
                
                });
        
                $('#addLAB').click(function () {

                    $row = '<tr><td><select name="labref[]" id="processor" class="select2"><?php foreach ($labrefs as $l): ?><option value="<?php echo $l->lab_ref_no; ?>"><?php echo $l->lab_ref_no; ?></option><?php endforeach; ?></select></td><td><a href="#remLAB" class="remLAB"> -remove</a></td></td></tr>';
                    $('#batch_table tbody').append($row);
                    return false;

                });

                $(document).on('click', ' .remLAB', function () {
                    $(this).closest('tr').remove();

                });

    })
    
    </script>
