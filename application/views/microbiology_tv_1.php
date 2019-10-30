<fieldset>
    <legend>MICROBIOLOGY SUPERVISOR / REVIEW RESULT APPROVAL PAGE - <?php echo $test_name[0]->name;?></legend>
    
    <form  id="microForm">
        <textarea required type="text" name="method" title="If it is a multicomponent, separate with full collon e.g method1:method2:method3..." placeholder="Enter Method"><?php echo $data[0]->method;?></textarea>
        <textarea required type="text" name="compendia" title="If it is a multicomponent, separate with full collon e.g compendia1:compendia2:compendia3..." placeholder="Enter Compendia"><?php echo $data[0]->compedia;?></textarea>
        <textarea required type="text" name="specification" title="If it is a multicomponent, separate with full collon e.g spec1:spec2:spec3..." placeholder="Enter Specification"><?php echo $data[0]->specification;?></textarea>
        <textarea required type="text" name="determined" title="If it is a multicomponent, separate with full collon e.g result1:result2:result3..." placeholder="Enter Results/Determined"><?php echo $data[0]->determined;?></textarea>
        <p>
            <br>
            <input type="button" class="submit update" value="UPDATE " style="background: blue; color:white; font-weight: bolder;"/>
            <input type="button" class="submit approve" value="APPROVE" style="background: greenyellow; color:black; font-weight: bolder;"/>
        </p>
        
    </form>
    
</fieldset>

<script>
    
    $(document).ready(function(){
        base_url = "<?php echo base_url();?>";
        labref ="<?php echo $labref;?>";
        test_id ="<?php echo $test_id;?>";
        
       $('.update').click(function(){
           data = $('#microForm').serialize();
           
           $.post(base_url+'micontroller/save_s/'+labref+'/'+test_id, data, function(){
              alert('Update Success');
              window.location.href=base_url+'micontroller/results/'+labref+'/'+test_id;

           }).fail(function(){
               alert('An error occured, Update Incomplete');
           });
           
           
       });
       
         $('.approve').click(function(){
           data = $('#microForm').serialize();
           
           $.post(base_url+'micontroller/approve_data/'+labref+'/'+test_id, data, function(){
      
              window.location.href=base_url+'supervisors/home/'+labref;

           }).fail(function(){
               alert('An error occured, Approval Incomplete');
           });
           
           
       }); 
    });
    
    </script>
