<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;border-top-width:1px;border-bottom-width:1px;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;border-top-width:1px;border-bottom-width:1px;}
    .tg .tg-yw4l{vertical-align:top}
    .tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top}
</style>
<table class="tg">
    <tr>
        <th class="tg-yw4l" >No</th>
        <th class="tg-yw4l" >Date</th>
        <th class="tg-yw4l" >Reviewer</th>
        <th class="tg-yw4l" >Action</th>
    </tr>
    <?php 
    $i=1;
    foreach ($assign_data as $ad):?>
    <tr>     
        <td class="tg-rmb8"><?php echo $i;?></td>
        <td class="tg-rmb8"><?php echo $ad->date_action;?></td>
        <td class="tg-rmb8"><?php echo $ad->person;?></td>
        <td class="tg-rmb8"><?php echo $ad->status;?></td>
    </tr>
    <?php
    $i++;
    endforeach;?>
    
</table>


<?php echo form_open('assign/sendSamplesFolder/' . $labref . '/' . $formicrobiology . '/' . $test_id . '/' . $id); ?>
<table>
    <tr>
        <th>Reviewer </th>  <th>Assign</th>
    </tr>
    <tr><td>
            <select name="director" required>
                <option value="">Select Reviewer</option>
                <?php
                foreach ($reviewers as $reviewer):
                    echo "<option value=" . $reviewer['id'] . ">" . $reviewer['fname'] . " " . $reviewer['lname'] . "</option>";
                endforeach;
                ?>

            </select></td>
        <td>

            <input type="submit" value="Assign" class="submit-button"/> 
        </td>
    </tr>
</form>

</table>