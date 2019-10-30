<?php error_reporting(1);?>
<style>
    #rej{
        display:none;
    }
</style>
<script>
    $(document).ready(function(){
      $('.reject').on('click',function(){
        $.fancybox.open({
          href:'#rej',
          width:600,
          height:500
       });
      });
      
      $('#rejecting').click(function(){
        $.ajax({
            type:'post',
            url:"<?php echo base_url();?>directors/reject_coa_draft/"+$('#labref').val()+"/"+$('#level').val(),
            data:$('#reasons').serialize(),
            success:function(){
               window.location.href='<?php echo base_url();?>directors/draft_coa_review/';
            },
            error:function(){
              alert('Notice: You have already posted a rejection reason for this sample!');  
               window.location.href='<?php echo base_url();?>directors/draft_coa_review/';
            }
        });
      });
       $('#canceling').click(function(){
          alert('a');
      });
      
      $('.reason').on('mouseover',function(){          
          id=$(this).prop('id');
          
           $.ajax({
            type:'get',
            url:"<?php echo base_url();?>directors/reject_reason/"+id+"/COA_Reviewer/",
            dataType:'json',
            success:function(data){
               alert(data[0].reject_reason);
            },
            error:function(){
              alert('An error occured when attempting to retrieve Rejection reason!');  
              
            }
        });
        
          
    });
    });
</script>
<body> 
    <p><strong>FINAL COA CONFIRMATION</strong></p>
    <hr>
    <legend>
    <a href="<?php echo base_url(); ?>coa_review/draft_coa_review" >Pending Review</a>  
   
</legend>
    
<hr />


</div> 
<?php $user_id = $this->session->userdata('user_id'); ?>
<!-- End Menu --> 
<div>
    <table id = "refsubs">
        <thead>
            <tr>
<!--                <th>File Name</th>-->
                <th>Lab Reference No</th>
               <th>Product Name </th> 
               <th>COA ver. 2.0</th> 
          

            </tr>
        </thead>
        <tbody>
             
                   
            <?php foreach ($worksheets as $sheet): ?>
                <tr>
           
                    <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>
					 <td><strong><em><?php echo $sheet->product_name; ?></em> </strong></td>
                    <td> <?php echo anchor('coa/coa_engine_final/' . $sheet->folder , 'View Final'); ?></td>
                 

                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
    <div id="rej">
            <?php $this->load->view('rejections_v'); ?>
        </div>

    <script type="text/javascript">
        $('#refsubs').dataTable({
            "bJQueryUI": true
        })

        $('.history').live("click", function(e) {
            e.preventDefault();
            var nTr = this.parentNode.parentNode;

            if ($(this).text() == 'Show') {

                $(this).text("Hide");

                //alert("Under Construction");

                var id = $(this).attr("id");
                //var type = $(this).attr("rel");

                $.post("<?php echo site_url('inventory/columns_showHistory'); ?>" + "/" + id, function(history) {

                    rtable.fnOpen(nTr, history, 'history');
                })


            }


            else {

                rtable.fnClose(nTr);

                $(this).text("Show");

            }


        });

    </script>


</div>


</body> 
</html> 
