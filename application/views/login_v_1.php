<?php ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>NQCL Login</title>
        <link href="<?php echo base_url() . 'CSS/style.css' ?>" type="text/css" rel="stylesheet"/>


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>CSS/bootstrap.min.css">

            <!-- Optional theme -->
            <link rel="stylesheet" href="<?php echo base_url(); ?>CSS/bootstrap-theme.min.css">

                <!-- Latest compiled and minified JavaScript -->
             

                </head>

                <body>
                    <div id = "content_view" >
                        <div id="wrapper" style="display:none">
                                <div id="top-panel">               

                <div id="nqcl_logo">
                    <a class="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url() . "Images/nqcl_logo_full.png"; ?>"></a> 
                </div>
                 </div>
</div>

                                        <div id="loginbox" style="margin-top:150px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                                            <div class="panel panel-success" >
                                                <div class="panel-heading" style="background: #419641;" >
                                                    <div class="panel-title" style="color:white; font-weight: bolder;">NQCL LIMS &#187 Change Password</div>
                                                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a id='f_p' style="color:white; font-weight: bolder;" href="<?php echo base_url().'user_management/login';?>">Login</a></div>
                                                </div>     

                                                <div style="padding-top:30px" class="panel-body" >

                                                    <div class="alert alert-danger" id="errors">

                                                    </div>

                                                    <form id="login" class="form-horizontal" role="form">

                                                        <div style="margin-bottom: 5px" class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                            <input id="username" type="text" class="form-control" name="username" value="" placeholder="Enter your email">                                        
                                                        </div>

                                                        <div style="margin-bottom: 5px" class="input-group">


                                                        </div>





                                                       <div id="AUTH">
                                                        <div style="margin-bottom: 5px" class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                            <input id="password" type="password" class="form-control" name="password" placeholder="New password">
                                                        </div>

                                                             <div style="margin-bottom: 5px" class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                            <input id="cpassword" type="password" class="form-control"  placeholder="Confirm New password">
                                                        </div>




                                                        <div style="margin-top:10px" class="form-group">
                                                            <!-- Button -->

                                                            <div class="col-sm-12 controls">
                                                                <input type="button" class="btn btn-large btn-success" name="register" id="CPASSWORD" value="Submit" />
																<a id='f_p' style="color:white; font-weight: bolder;" href="<?php echo base_url().'user_management/login';?>">Login</a>

                                                            </div>
                                                        </div>  
                                                       </div>														
                                                    </form>
                                                </div>                     
                                            </div>  
                                        </div>
                                        
                                    </hr>

                                    </div>


  </div>  

 </div>  
<div id="bottom_ribbon">
                            <div id="footer">
                                <?php $this->load->view("footer_v"); ?>
                            </div>
                        </div>
                            <!--End Wrapper div--></div>
                        
                    </div>
                </body>


                <script type="text/javascript">
                    $().ready(function () {
                        $('.alert').hide();
                       $('#AUTH').hide();
                    });
                    $("#username").blur(function () {
                        username = $(this).val();
                        if (username) {
                            $.ajax({
                                type: "POST",
                                url: '<?php echo site_url("user_management/usernameCheckAvailability"); ?>' + "/" + username,
                                dataType: "json"
                            }).done(function (response) {
                                //console.log(response)
                                if (response.status == "non-existent" || username == '') {
                                     $('#AUTH').hide();
									 alert('Error: That email has does not exist');
                                    
                                }
                                else if (response.status == 'existent') {                        
                                    $('#AUTH').show();
               

                                }
                            }).fail();

                        }
                    })

                    $('#CPASSWORD').click(function () {
                       
						
						var pass = $('#password').val();
						var cpass = $('#cpassword').val();
						
						if(pass==''){
							alert('password cannot be left empty');
						}else if(pass != cpass){
							alert('passwords do not match');
						}else if(pass.length < 6){
							alert('password minimum length cannot be less than 6 characters');
							
						}else{

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("user_management/changepassword") ?>',
                            data: $('form').serialize(),
                            dataType: "json",
                            success: function (response) {
                                if (response.status === "success") {
                                    alert('passwords change successfull'); 
                                   window.location.href="<?php echo base_url();?>user_management/login"									

                                }
                                else {
                                     alert('Error: An error occured, please contact system admin!');  
                                }
                               
                            },
                            error: function () {
                            }
                        })
						}
                    })

                </script>



                </html>
