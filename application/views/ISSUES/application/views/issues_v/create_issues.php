<!-- Page Content -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">CREATE NEW ISSUE</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Issue Form
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" action="<?php echo base_url()?>issues/add" method="post">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Error title or concern" required maxlength="50">
                                    <span>e.g Error 404 on upload</span>
                                </div>
                                <div class="form-group">
                                    <label>Issue</label>
                                    <textarea class="form-control" rows="3" name="issues" required placeholder="Describe the nature of concern or error, You can copy and past the error here for fast tracking"></textarea>
                                     <span>e.g Not able to upload, Shows errors</span>
                                </div>
<!--                                   <div class="form-group">
                                    <label>Image Attachment</label>
                                    <input type="file">
                                </div>-->
                                   <div class="form-group col-lg-2" >
                                            <label>Select Developer to Assign</label>
                                            <select class="form-control" name="developer" required>
                                                <option></option>
                                                <option value="Alphonce">Alphonce</option>
                                                <option value="Watson">Watson</option>
                                           
                                            </select>
                                        </div>
<div class="col-lg-5">
    <p><strong>Alphonce</strong></p><br>
    <ul>
        <li>Worksheet Issues - Upload or download</li>
        <li>Errors when keying in test values into the LIMS</li>
        <li>Supervisor stage Concerns </li>
        <li>Worksheet Review stage Concerns</li>
        <li>COA Drafting & Concerns</li>
        <li>COA Review Stage concerns</li>       
    </ul>
</div>

<div class="col-lg-5">
    <p><strong>Kibaki</strong></p><br>
    <ul>
        <li>Receiving of fresh samples concerns, Stage 1 documentation</li>
        <li>Sample & and client editing errors/General concern</li>
        <li>Assignment of samples to Analysts </li>
        <li>Columns Concern</li>
        <li>Reagents Concern by analysts/others</li>
        <li>Equipment Concern by analysts/others</li>
        <li>Finance Modules</li>
    </ul>
</div>
                                
                             
                                    <div class="form-group col-lg-12">
                                        <input type="submit" value="Submit Issue" class="btn btn-large btn-info"/>
                                    </div>
                               
                             
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