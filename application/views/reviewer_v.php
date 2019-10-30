<?php error_reporting(0);?>
<style>
    #rej{
        display:none;
    }
</style>
<script>
    $(document).ready(function(){
      $(document).on('click','.reject_1',function(){
        $.fancybox.open({
          href:'#rej',
          width:600,
          height:500
       });
      });
      
      $('#rejecting').click(function(){
	value=$('#reason').val();
	if(value==''){
		 alert('Please give a reason for rejecting this sample');
	}else{
		$(this).prop('value','Please wait...')
        $.ajax({
            type:'post',
            url:"<?php echo base_url();?>reviewer/reject/"+$('#labref').val()+"/"+$('#level').val(),
            data:$('#reasons').serialize(),
            success:function(){
               window.location.href='<?php echo base_url();?>reviewer/';
            },
            error:function(){
              alert('Notice: You have already posted a rejection reason for this sample!');  
               window.location.href='<?php echo base_url();?>reviewer/';
            }
		
        });
	}
      });
       $('#canceling').click(function(){
          $.fancybox.close();
      });
      
      $('.reason').on('mouseover',function(){          
          id=$(this).prop('id');
          
           $.ajax({
            type:'get',
            url:"<?php echo base_url();?>reviewer/reject_reason/"+id+"/Reviewer/",
            dataType:'json',
            success:function(data){
               alert(data[0].reject_reason);
            },
            error:function(){
              alert('An error occured when attempting to retrieve Rejection reason!');  
              
            }
        });
        
          
    });
    
        $('#mOOS').click(function(){
                
                    $.prompt("This sample is about to be marked as an OOS!, Do you want to continue with this action?", {
                                                        title: "OOS Status",
                                                        buttons: {"Yes, Mark as OOS": 1, "No, Cancel Action": false},
                                                        focus: 1,
                                                        submit: function(e, v, m, f) {
                                                            // use e.preventDefault() to prevent closing when needed or return false. 
                                                            // e.preventDefault(); 
                                                       
                                                            if (v === 1) {

                                                              $.post("<?php echo base_url().'reviewer/make_oos_coa/'.$labref;?>"); 
                                                              window.location.href = "<?php echo base_url() ; ?>coa_review/draft_coa_review/";


                                                            } else {
                                                             
                                                                window.location.href = "<?php echo base_url() . 'coa/generateCoa_cr/'.$labref ?>";
                                                            }

                                                            console.log("Value clicked was: " + v);
                                                        }
                                                    });
                
            });
    });
</script>

<body> 
<legend><a href="<?php echo base_url(); ?>" ></a>  <a href="<?php echo base_url(); ?>reviewer" >Home</a>   </legend>
<hr />
<!-- Menu Start --> 

</div> 
<?php $user_id = $this->session->userdata('user_id'); ?>
<!-- End Menu --> 
<div>
    <table id = "refsubs">
        <thead>
            <tr>

                <th>Lab Reference No</th>
           
                <th>Download </th>                
                   <th>Upload Edits</th>
                      <th>Commit COA Results</th>
                <th>OOS</th>                    
             
                <th>Reject</th>
                <th>Priority</th>


            </tr>
        </thead>
        <tbody>
            <?php 
      
            foreach ($worksheets as $sheet): ?>
                <tr> 
                    <input type="hidden" id="level" value="Reviewer"/>
                    <input type="hidden" id="labref" value="<?php echo $sheet->folder;?>"/>
                  
                    <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>
                 
                    <td><?php echo anchor('analyst_uploads/'.$sheet->folder.'.xlsx','Download Workbook'); ?></td>
                    
              
                    
                    <td><?php echo anchor('upload/reviewer_uploads/' . $sheet->folder.'/'.$sheet->microbiology.'/'.$sheet->test_id , 'Upload Edited Workbook'); ?></td>

                    
                          <td><?php echo anchor('upload/worksheet/' . $sheet->folder.'/'.$sheet->microbiology.'/'.$sheet->test_id , 'Update COA'); ?></td>
              
                          <td><a href="<?php echo base_url().'reviewer/make_oos/'.$sheet->folder;?>">Mark as OOS</a></td>

                  
                  
                    
                    <td style="background: cyan;"><a href="#rej" class="reject_1">Reject</a></td>

                    <?php if ($sheet->priority === '1') { ?>
                        <td><span id="high">High</span></td>
                    <?php } else { ?>
                        <td><span id="low">Low</span></td>    
                    <?php } ?>

                <?php endforeach; ?>
            </tr>
        </tbody>
        <div id="rej">
            <?php $this->load->view('rejections_v'); ?>
        </div>
    </table>


    <script type="text/javascript">
        $('#refsubs').dataTable({
            "bJQueryUI": true
        })
    </script>


</div>


</body> 
</html> 
