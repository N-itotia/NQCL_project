<fieldset>
    <legend>MICROBIOLOGY RESULT RECORD PAGE - <?php echo $test_name[0]->name;?></legend>
    
    <form method="post" action="<?php echo base_url().'micontroller/save/'.$labref.'/'.$test_id.'/'.$test_name[0]->name;?>">
        <textarea required type="text" name="method" title="If it is a multicomponent, separate with full collon e.g method1:method2:method3..." placeholder="Enter Method"></textarea>
        <textarea required type="text" name="compendia" title="If it is a multicomponent, separate with full collon e.g compendia1:compendia2:compendia3..." placeholder="Enter Compendia"></textarea>
        <textarea required type="text" name="specification" title="If it is a multicomponent, separate with full collon e.g spec1:spec2:spec3..." placeholder="Enter Specification"></textarea>
        <textarea required type="text" name="determined" title="If it is a multicomponent, separate with full collon e.g result1:result2:result3..." placeholder="Enter Results/Determined"></textarea>
        <p>
            <br>
            <input type="submit" class="submit" value="POST RESULTS"/>
        </p>
        
    </form>
    
</fieldset>
