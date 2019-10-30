<!-- Page Content -->
<style>
    label{
        display: block;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">ISSUE REVIEW</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Issues SORTED and PENDING
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" action="<?php echo base_url()?>issues/complete/<?php echo $id;?>" method="post">
                                 <?php foreach ($myissues as $issues )?>
                                <div class="form-group">
                                    <label>Title</label>
                                    <span><strong><?php echo $issues->title;?></strong></span>
                                </div>
                                <div class="form-group">
                                    <label>Issue</label>
                                    <span><i><?php echo $issues->issue;?><i></span>
                                </div>
<!--                                   <div class="form-group">
                                    <label>Image Attachment</label>
                                    <input type="file">
                                </div>-->
                                   <div class="form-group col-lg-12" >
                                       <label>Assigned To</label>
                                       <span><?php echo $issues->developer;?></span>
                                        </div>
                                        
                                          <label>Comment</label>
                                    <span><strong><em><?php echo $issues->comment;?></em></strong>
                                    
                                </div>
 <div class="form-group col-lg-2" >
                                            <?php if($issues->status ==1){?>
											<label>Action</label>
                                            <span class="btn btn-large btn-success">ISSUE SORTED by - <?php echo $issues->developer. ' on the ' . $issues->time_sorted;?></span>
											<?php } else {?>
											 <span class="btn btn-large btn-warning">STILL PENDING</span>

											<?php } ;?>
										</div>
<!-- <div class="form-group col-lg-2" >
                                            <label>Action</label>
                                            <select class="form-control" name="action">
                                                <option></option>
                                                <option value="0">Pending</option>
                                                <option value="1">Sorted</option>
                                           
                                            </select>
                                        </div>-->
                                
                                 
                                
                             
<!--                                    <div class="form-group col-lg-12">
                                        <input type="submit" value="Save" class="btn btn-large btn-info"/>
                                    </div>-->
                               
                             
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->