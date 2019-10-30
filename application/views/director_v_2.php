
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
    <p><strong>DRAFT COA REVIEW</strong></p>
    <hr>
    <legend>
    <a href="<?php echo base_url(); ?>coa_review/draft_coa_review" >Pending Review</a>  
    || <a href="<?php echo base_url(); ?>coa_review/draft_coa_review_app" >Approved</a> 
	|| <a href="<?php echo base_url(); ?>coa_review/finalized_coa" >COUNTER CHECK FINAL COA</a> 
</legend>
    
<hr />


</div> 
<?php $user_id = $this->session->userdata('user_id'); ?>
<!-- End Menu --> 
<div>
    <?php if($this->session->flashdata('msg')){ ?>
        <center><p  style="background: green; height: 40px; padding: 5px; color: #fff; font-weight: bold;"><?php echo $this->session->flashdata('msg');?></p></center>
    <?php }else{?>
        <center><p>No Status info yet</p></center>
    <?php } ;?>
    <form action="<?php echo base_url();?>coa_review/remove" method="post">
	<input type="submit" value="Remove Selected"/>
    <table id = "refsubs">
        <thead>
            <tr>
               <th>Select</th>
                <th>Lab Reference No</th>
               <th>Product Name </th> 
               <th>COA</th> 
               <!--  <th>View</th>
                <th>Status</th>
               <th>COA Changes</th>
<!--                <th>Reject</th>-->
                <th>Download
                <th>Upload</th>
				<th>Action</th>
				<th>Review Invoice</th>

            </tr>
        </thead>
        <tbody>
             
                   
            <?php foreach ($worksheets as $sheet): ?>
                <tr>
				
                     <input type="hidden" id="level" value="COA_Review"/>
<!--                     <input type="hidden" id="labref" value="<?php echo $sheet->folder;?>"/>-->
<!--                    <td><?php echo $sheet->folder . '.xlsx'; ?></td>-->
<td><input type="checkbox" value="<?php echo $sheet->id;?>" name="ids[]"/>
                    <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>
					 <td><strong><em><?php echo $sheet->product_name; ?></em> </strong></td>
                    <td><?php echo anchor('coa/generateCoa_crr/' . $sheet->folder , 'View '); ?></td>
                    <!--<td><?php echo anchor('coa/generateCoa_cr/' . $sheet->folder, 'View legacy COA') ?></td>-->

                    <?php /* if ($sheet->approval_status === '0') { ?>
                    <td style="background-color: yellow;"><span style=" color: black; font-weight: bold; border-radius: 2px;">Not yet Approved</span></td>
                    <?php } else if ($sheet->approval_status === '1') { ?>
                        <td style="background-color: yellowgreen;"><span  style=" color:white; font-weight: bold; border-radius: 2px;">Approved</span ></td>
                    <?php } else if ($sheet->approval_status === '2') { ?>
                        <td style="background-color: #FF0000;"><span style="color: white; font-weight: bold; border-radius: 2px;">Rejected : <a href="" class="reason" id="<?php echo $sheet->folder;?>">Why?</a></span></td> 
                    <?php }*/ ?>
                    <!--<td><a href="<?php echo base_url().'main_dashboard/changes_made/' . $sheet->folder;?>" class="approve" target="_blank">View </a></td>-->
<!--                    <td style="background: #0FF; font-weight: bolder; "><a href="#rej" class="reject">Reject</a></td>-->
                    <td>MS WORD <?php echo anchor('reviewed_coas/' . $sheet->folder.'.docx' , 'DRAFT'); ?></td>
                    <td>MS WORD <?php echo anchor('upload/coa_reviewer_uploads_director/' . $sheet->folder , 'UPLOAD'); ?></td>
					<td> <?php echo anchor('upload/coa_return/' . $sheet->folder.'/'. $sheet->id , 'Return for correction'); ?></td>
					<td><?php if($sheet->invoice_status >= 2){?>
                        <button id="<?php echo $sheet->folder; ?>" class="reviewInvoice submit-button">Review Invoice</button>
                     <?php } else{?>
                        <span>Pending Reviewer Approval</span>
                      <?php } ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
	</form>
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
		
		$('.reviewInvoice').live("click", function (e) {
            e.preventDefault();
      
            //Get unique id
            id = $(this).attr('id');

            //Get Client Id
            client_id = $(this).attr('data-client');

            //Get href
             var href = '<?php echo base_url() . "client_billing_management/showBillPerTest/" ?>INV-'+id+'-1/quotations/tests/q_request_details/q_entry/invoice/'+id;

            //Show url at console
            console.log(href);

            //Open fancybox with charges breakdown
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 1200,
                height: 600,
                'afterClose':function(){
                    $('#requests').DataTable().ajax.reload();
                }
            });
            return(false);
        })

    </script>


</div>


</body> 
</html> 
