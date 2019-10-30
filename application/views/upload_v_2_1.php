<script>
$(document).ready(function() {

    $("input.case1").click(assay_gen);
     $("input.dcase1").click(diss_gen);
    $("input.case").click(assay);
    $("input.dcase").click(dissolution);
    $("input.avcase").click(accepatnce_value);
    $('#coa_updater').click(function(){
        assay =$('#tassay').val();
        if(assay==''){
            alert('COA Values are missing, please check appropriate values on the left side of the window first');
            return false;
        }else{
        $(this).prop('value','Updating please wait....');
        $(this).prop('disabled','disabled');
       $.post("<?php echo site_url('upload/post_results/'.$labref);?>",$('#post_results').serialize(), function(){ 
           alert('COA Results successfully updated');
           $(this).prop('value','Update COA Results');
        $(this).prop('disabled',false);
           window.location.href="<?php echo base_url();?>reviewer/";
    }).fail(function(){
        alert('An error has occured when updating COA Results, Try again Later');
        return false;
    });
    }
});
});

function assay() {

    var values = [];
    $("input[name='case[]']:checked").closest("tr").each(function () {
        var tds = $(this).children();
        values.push(tds.eq(0).text() + " " + tds.eq(1).text() + " " + tds.eq(2).text() + "%(RSD = " + tds.eq(3).text() + "% ; n = " + tds.eq(4).text() + ")");
    });

    $('#tassay').text(values.join (" : "));
}

function assay_gen() {

    var values = [];
    $("input[name='case1[]']:checked").closest("tr").each(function () {
        var tds = $(this).children();
        values.push(tds.eq(0).text().replace(":", "") + " " + tds.eq(1).text()+ " (" + tds.eq(2).text() + ")");
    });

    $('#tassay').text(values.join (" : "));
}

function diss_gen() {

    var values = [];
    $("input[name='dcase1[]']:checked").closest("tr").each(function () {
        var tds = $(this).children();
        values.push(tds.eq(0).text().replace(":", "") + " " + tds.eq(1).text()+ " (" + tds.eq(2).text() + ")");
    });

    $('#tdiss').text(values.join (" : "));
}

function dissolution() {

    var values = [];
    $("input[name='dcase[]']:checked").closest("tr").each(function () {
        var tds = $(this).children();
        values.push(tds.eq(0).text() + " " + tds.eq(1).text() + " " + tds.eq(2).text() + "%(RSD = " + tds.eq(3).text() + "% ; n = " + tds.eq(4).text() + ")");
    });

    $('#tdiss').text(values.join (" : "));
}

function accepatnce_value() {

    var values = [];
    $("input[name='a_v[]']:checked").closest("tr").each(function () {
        var tds = $(this).children();
        values.push(tds.eq(0).text() + " < " + tds.eq(1).text() );
    });

    $('#acc_v').text(values.join (" : "));
}
     



    

</script>
<style type="text/css">
    div.upload{
        width: 400px;
        height: 200px;
        background-color: #E5E5E5;
        margin: auto;
        padding-top: 50px;
        padding-left: 80px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: 3px solid;
        border-color: #009900;

    }
    div.upload1{
        margin: auto;
    }
    h2{
        margin: auto;
        color:green;
    }
    
    .Result_record{
        float: left;
        width: 750px;
        min-height: 340px;
        background: greenyellow;
        border-radius: 5px;
        border: 1px solid black;
        margin-left: 5px;
    }
      .preview{
        float: right;
        width: 300px;
        min-height: 350px;
        background: greenyellow;
        border-radius: 5px;
        border: 1px solid black;
        margin-left: 790px;
        position: absolute;
    }
    label{
        display: block;
        margin-top: 3px;
        margin-bottom: 5px;
    }
    .add{
        float: right;
        margin-right: 6px;
        margin-top: 5px;
        font-size: 18px;
    }
    
</style>
	<p style="font-weight:bold; font-size:18px; color:red;">NOTICE: ALL REVIEWERS, KINDLY ROUND OFF FINAL RESULTS TO ONE DECIMAL PLACE BEFORE SUBMITTING</p>

 <form id="post_results" method="post" action="<?php echo site_url('upload/get_data');?>">
<div class="preview ">
    <fieldset>
        <legend>Selection Preview</legend>
        <form>
            <table>
                <tr>
                    Assay 
                </tr>
                <tr></tr>
                <tr><textarea cols="32" rows="3" id="tassay" name="ass_r"></textarea></tr>
                <tr></tr>
                <tr>Dissolution</tr>
                <tr></tr>
                <tr><textarea cols="32" rows="3" id="tdiss" name="diss_r"></textarea></tr>
            <tr>
                Acceptance Value (Uniformity Of Contents)
            </tr>
            <tr><textarea cols="32" rows="3" id="acc_v" name="acc_v"></textarea></tr>
                <input type="button" value="Update COA Results" id="coa_updater"/>
            </tr>
            </table>
  
    </fieldset> 
</div>
<div class="Result_record">
   
        
    <fieldset>
        <legend>STANDARD SHEET RESULTS</legend>
        <table class="summary">
            <tr>
            <th>Medium / Day</th>
            <th>Component</th>
            <th>Average</th>
            <th>RSD</th>
            <th>n</th>
            <th>Select</th>
            </tr>
            <tbody>
                <tr>
                    <td colspan="3"><center><strong><u>Assay</u></strong></center></td>
        <input type="hidden" value="5" name="assay"/>
                </tr>
                <?php foreach($assay as $as):?>
                <tr class="assay_row">
                     <td><?php echo $as->medium_day;?></td>
                    <td><?php echo $as->component;?></td>
                    <td><?php echo round($as->average,2);?></td>
                    <td><?php echo round($as->rsd,2);?></td>
                    <td><?php echo $as->n;?></td>
                     <td><input type="checkbox" name="case[]" class="case" /></td> 
                </tr>
                <?php endforeach;?>
                <tr >
                    <td colspan="3"><center><strong><u>Dissolution</u></strong></center></td>
        <input type="hidden" value="2" name="dissolution"/>
                </tr>
                <tr>
                     <?php foreach($dissolution as $ds):?>
                       <td><?php echo $ds->medium_day;?></td>
                    <td><?php echo $ds->component;?></td>
                    <td><?php echo round($ds->average,2);?></td>
                    <td><?php echo round($ds->rsd,2);?></td>
                    <td><?php echo $ds->n;?></td>  
                    <td><input type="checkbox" name="dcase[]" class="dcase"/></td>                       
                </tr>
                 <?php endforeach;?>
                <tr></tr>
                <tr>
               <td colspan="3"><center><strong><u>Acceptance Value if any (Uniformity of content)</u></strong></center></td>
                </tr>
                      <tr >
        <input type="hidden" value="2" name="ac_v"/>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>Acceptance Value (AV)</td>
                </tr>
                
                     <?php foreach($av as $c_v):?>
                <tr>
                       <td><?php echo $c_v->component;?></td>
                    <td><?php echo $c_v->accept_value;?></td>                   
                    <td><input type="checkbox" name="a_v[]" class="avcase"/></td>  
                     </tr>
                       <?php endforeach;?>
               
            </tbody>
        </table>
    </fieldset>
    
     <fieldset>
        <legend>GENERIC/CUSTOM SHEET RESULTS</legend>
        <table class="summary">
            <tr>
            <th>Medium / Day</th>
            <th>Component</th>
            <th>Generic</th>
            <th>Results</th>
            <th>(Format May vary)</th>
            <th>Select</th>
            </tr>
            <tbody>
                <tr>
                    <td colspan="3"><center><strong><u>Assay</u></strong></center></td>
        <input type="hidden" value="5" name="assay"/>
                </tr>
                <?php foreach($assay_gen as $as2):?>
                <tr class="assay_row_1">
                     <td><?php echo $as2->medium_day;?></td>
                    <td><?php echo $as2->component;?></td>
                    <td colspan="3"><?php echo $as2->generic_results;?></td>
                    
                     <td><input type="checkbox" name="case1[]" class="case1" /></td> 
                </tr>
                <?php endforeach;?>
                <tr >
                    <td colspan="3"><center><strong><u>Dissolution</u></strong></center></td>
        <input type="hidden" value="2" name="dissolution"/>
                </tr>
                <tr>
                     <?php foreach($dissolution_gen as $ds2):?>
                       <td><?php echo $ds2->medium_day;?></td>
                    <td><?php echo $ds2->component;?></td>
                    <td colspan="3"><?php echo $ds2->generic_results;?></td>
                  
                    <td><input type="checkbox" name="dcase1[]" class="dcase1"/></td>                       
                </tr>
                 <?php endforeach;?>
                <tr></tr>
              
               
            </tbody>
        </table>
        <p style="font-weight: bolder; color:red">NOTE: Please note that with generic results the format may not be in the exact format as the standard sheet, kindly make a few formating adjustments and if you have colons between core results please remove them to avoid making unnecessary cell splitting in the COA.</p>
    </fieldset>
    
    
</div>
         </form>



