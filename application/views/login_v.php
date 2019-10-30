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
                                                    <div class="panel-title" style="color:white; font-weight: bolder;">NQCL LIMS &#187 Sign In</div>
                                                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a id='f_p11' style="color:white; font-weight: bolder;" href="<?php echo base_url().'user_management/preset';?>">Forgot password?</a></div>
                                                </div>     

                                                <div style="padding-top:30px" class="panel-body" >

                                                    <div class="alert alert-danger" id="errors">

                                                    </div>

                                                    <form id="login" class="form-horizontal" role="form">

                                                        <div style="margin-bottom: 5px" class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                            <input id="username" type="text" class="form-control" name="username" value="" placeholder="email">                                        
                                                        </div>

                                                        <div style="margin-bottom: 5px" class="input-group">


                                                            <label  id = "available" ></label>
                                                            <label  id = "unavailable" ></label>
                                                            <div class = "hidden2" id = "role-select-div" >
                                                                <label>
                                                                    <strong class = "label" >Role</strong>
                                                                    <select name = "usertype" id = "role-select" ></select>
                                                                </label>
                                                            </div>
                                                        </div>






                                                        <div style="margin-bottom: 5px" class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                            <input id="password" type="password" class="form-control" name="password" placeholder="password">
                                                        </div>






                                                        <div style="margin-top:10px" class="form-group">
                                                            <!-- Button -->

                                                            <div class="col-sm-12 controls">
                                                                <input type="submit" class="btn btn-large btn-success" name="register" id="register" value="Sign in" />
																<a id='' href="<?php echo base_url().'user_management/preset';?>">Forgot Password? </a>

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
                        $('#f_p').click(function(){
                          alert('Please See your systems Administrator (Technical Head) to reset your password!');  
                        })
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
                                    if (!$('#unavailablespan').length) {
                                        $("<span id ='unavailablespan' class = 'misc-title small-text padded show_error' >X&nbsp;" + response.message + "</span>").appendTo('#unavailable');
                                    }
                                    $('#unavailable').slideUp(300).delay(200).fadeIn(4000).fadeOut('slow');

                                    $('.roleOptions').remove();

                                    $('#role-select-div').toggle(false);


                                }
                                else if (response.status == 'existent') {

                                    $('.roleOptions').remove();

                                    $('#role-select-div').toggle(false);

                                    if (!$('#availablespan').length) {

                                        $("<span id ='availablespan' class = 'misc-title small-text padded show_ok hidden2' >&#10003;&nbsp;" + response.message + "</span>").appendTo('#available').slideUp(300).delay(200).fadeIn(5000).fadeOut('4000');
                                        ;
                                    }
                                    else {
                                        $("<span id ='availablespan' class = 'misc-title small-text padded show_ok hidden2' >&#10003;&nbsp;" + response.message + "</span>").appendTo('#available').slideUp(300).delay(200).fadeIn(5000).fadeOut('4000');
                                    }

                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo site_url("user_management/getUserTypes"); ?>' + "/" + username,
                                        dataType: "json"
                                    }).done(function (response) {
                                        //console.log(response);
                                        for (i = 0; i < response.length; i++) {
                                            console.log(response[i].User_type[0].name)
                                            $('<option value = ' + response[i].User_type[0].id + ' class ="roleOptions" >' + response[i].User_type[0].name + '</option>').appendTo('#role-select');
                                        }
                                        if (response) {
                                            $('#role-select-div').toggle(true);
                                        }
                                        else {
                                            $('#role-select-div').toggle(false);
                                        }

                                    })

                                }
                            }).fail();

                        }
                    })

                    $('#login').submit(function (e) {
                        e.preventDefault();

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("user_management/test_login") ?>',
                            data: $('form').serialize(),
                            dataType: "json",
                            success: function (response) {
                                if (response.status === "success") {
                                    if (response.pwd_status == '1') {
                                        url = '<?php echo base_url() ?>' + response.view
                                        document.location = url;
                                    }
                                    else if (response.pwd_status == '0') {
                                        //$('.edit').live("click",function(e){
                                        //e.preventDefault();
                                        var href = '<?php echo base_url() . "user_management/pwd_fancybox" ?>' + "/"
                                        console.log(href);
                                        $.fancybox.open({
                                            href: href,
                                            type: 'iframe',
                                            autoSize: false,
                                            autoDimensions: false,
                                            width: 400,
                                            height: 270
                                                    //'beforeClose' : function(){
                                                    //	getData();
                                                    //}
                                        });
                                        return(false);
                                        //})

                                    }
                                    else if (response.pwd_status === 'acc_deactivated') {
                                        //$('<span class = "misc-title small-text padded show_error" >'+response.message+'</span>').appendTo('#errors');
                                        console.log(response.message)
                                    }

                                }
                                else if (response.status === "acc_deactivated") {
                                    $('.alert').show();
                                    $('<span id = "deactiv_error" class = "misc-title small-text padded show_error" >' + response.message + '</span>').appendTo("#errors").fadeOut(6000);

                                    $('.alert').fadeOut(6000);
                                }
                                else if (response.status === "wrong_pwd_usrnm") {
                                    $('.alert').show();
                                    $('<span id = "wrong_pwd_usrnm" class = "misc-title small-text padded show_error" >' + response.message + '</span>').appendTo("#errors").fadeOut(6000);
                                    console.log(response.message)
                                    $('.alert').fadeOut(6000);
                                }
                            },
                            error: function () {
                            }
                        })
                    })

                </script>



                </html>
