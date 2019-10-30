<head>
    <script src="<?php echo  base_url();?>dashboard_assets/js/jquery-1.10.2.min.js"></script>
    <link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css' ?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css' ?>" type="text/css" rel="stylesheet"/>
</head>
<script type="text/javascript">

    $(document).ready(function() {


        $('#REMOVEALL').click(function(event) {
            event.preventDefault();
            if($(".REMID:checked").length > 0) {

                var searchIDs = $(".REMID:checked").map(function () {
                    return $(this).val();
                }).get();
              
                var r = confirm("You are about to remove selected  Samples from view. This action is cannot be undone. Do you want to proceed?");
                if (r == true) {
                   $.post("<?php echo base_url();?>main_dashboard/removesamples/",{samples:searchIDs},function(){
                       window.location.href="<?php echo base_url();?>main_dashboard/samples/"
                   }).fail(function(){
                       console.log("An error occured");
                   });
                } else {

                }
            }else{
                alert('Cannot Proceed, No sample(s) selected');
            }
        });
        
       var coaData= $('#table-bordered23').dataTable({
           "bDestroy": true,
            "bJQueryUI": true,
           
        })
   



        $('.coa_changes').live("click", function(e) {
            e.preventDefault();
            var nTr = this.parentNode.parentNode;

            if ($(this).text() === 'View Changes') {

                $(this).text("Hide");
                var href=$(this).attr("href");
                //alert("Under Construction");

                var id = $(this).attr("id");
                //var type = $(this).attr("rel");

                $.post(href, function(history) {

                    coaData.fnOpen(nTr, history, 'history');
                })


            }


            else {

                coaData.fnClose(nTr);

                $(this).text("View Changes");

            }


        });
        
        
         $('.coa').live("click", function(e) {
            e.preventDefault();
            var nTr = this.parentNode.parentNode;

            if ($(this).text() === 'View COA') {

                $(this).text("Hide");
                var href=$(this).attr("href");
                //alert("Under Construction");

                var id = $(this).attr("id");
                //var type = $(this).attr("rel");

                $.post(href, function(history) {

                    coaData.fnOpen(nTr, history, 'history');
                })


            }


            else {

                coaData.fnClose(nTr);

                $(this).text("View COA");

            }


        })
    });
</script>



<div class="row-fluid">

            <table  id="table-bordered23">
                <thead>
                    <tr>
                        <th></th>
                        <th>Lab Reference No</th>
                        <th>View</th>
                        <th>Status</th>
                        <th>Download Document</th>
						<th>Upload</th>
                        <th>Approve</th>
                        <th>Reject</th>
                        <th>Priority</th>
                        <th>Changes</th>
                    </tr>
                </thead>
                <button id="REMOVEALL" class="btn btn-sm btn-primary" style="margin: 5px;">REMOVE SELECTED</button>
                <tbody>
                    <?php foreach (@$worksheets as $sheet): ?>
                        <tr>
                            <td><input type="checkbox" class="REMID" value="<?php echo $sheet->id; ?>"/></td>
                            <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>
                            <td><a id="<?php echo $sheet->folder; ?>" class="coa1" href='<?php echo base_url() . 'coa/generateCoa_dash/' . $sheet->folder;?>'>View COA</a></td>

                            <?php if ($sheet->d_approve === '0') { ?>
                                <td style="background: yellow; color: black; font-weight: bold; border-radius: 2px;">Not yet Checked</td>
                            <?php } else if ($sheet->d_approve === '1') { ?>
                                <td style="background: yellowgreen; color: white; font-weight: bold;">APPROVED</td>
                            <?php } else if ($sheet->d_approve === '2') { ?>
                                <td style="background: #FF0000; color: white; font-weight: bold; border-radius: 2px;">REJECTED</td> 
                            <?php } ?>
                            <td><a id="<?php echo $sheet->folder; ?>" class="coa1" href='<?php echo base_url() . 'approved_drafts/' . $sheet->folder.'.docx';?>'>DOWNLOAD </a></td>
							 <td><a id="<?php echo $sheet->folder; ?>" class="coa1" href='<?php echo base_url() . 'upload/coa_director_upload/'. $sheet->folder ;?>'>UPLOAD </a></td>

                            <td><?php echo anchor('directors/approve_d/' . $sheet->folder, 'Approve', 'class="btn btn-green"'); ?></td>
                            <td><?php echo anchor('directors/reject_d/' . $sheet->folder, 'Reject', 'class="btn btn-red"'); ?></td>
                            <?php if ($sheet->priority === '1') { ?>
                                <td  id="high">High</td>
                            <?php } else { ?>
                                <td class="btn btn-orange" id="low">Low</td>    
                            <?php } ?>                                
                                  
                                <td><a id="<?php echo $sheet->folder; ?>" class="coa_changes1" href='<?php echo base_url() . 'main_dashboard/changes_made/' . $sheet->folder;?>'>View Changes</a></td>
         
                            
                        <?php endforeach; ?>
                    </tr>

                </tbody>
            </table>
        </div>

