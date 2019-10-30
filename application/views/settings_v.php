<style>
    @import url(http://fonts.googleapis.com/css?family=Montserrat:400,700);
    #worksheet_choice{
        width:200px;
        height:200px;
        display: none;
    }

    #cssmenu,
    #cssmenu ul,
    #cssmenu ul li,
    #cssmenu ul li a,
    #cssmenu #menu-button {
        margin: 0;
        padding: 0;
        border: 0;
        list-style: none;
        line-height: 1;
        display: block;
        position: relative;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        z-index: 90;
    }
    #cssmenu:after,
    #cssmenu > ul:after {
        content: ".";
        display: block;
        clear: both;
        visibility: hidden;
        line-height: 0;
        height: 0;
    }
    #cssmenu #menu-button {
        display: none;
    }
    #cssmenu {
        font-family: Montserrat, sans-serif;
        background: #333333;
    }
    #cssmenu > ul > li {
        float: left;

    }
    #cssmenu.align-center > ul {
        font-size: 0;
        text-align: center;
    }
    #cssmenu.align-center > ul > li {
        display: inline-block;
        float: none;
    }
    #cssmenu.align-center ul ul {
        text-align: left;
    }
    #cssmenu.align-right > ul > li {
        float: right;
    }
    #cssmenu > ul > li > a {
        padding: 17px;
        font-size: 10px;
        letter-spacing: 1px;
        text-decoration: none;
        color: #dddddd;
        font-weight: bold;
        text-transform: uppercase;
    }
    #cssmenu > ul > li:hover > a {
        color: #ffffff;
    }
    #cssmenu > ul > li.has-sub > a {
        padding-right: 30px;
    }
    #cssmenu > ul > li.has-sub > a:after {
        position: absolute;
        top: 22px;
        right: 11px;
        width: 8px;
        height: 2px;
        display: block;
        background: #dddddd;
        content: '';
    }
    #cssmenu > ul > li.has-sub > a:before {
        position: absolute;
        top: 19px;
        right: 14px;
        display: block;
        width: 2px;
        height: 8px;
        background: #dddddd;
        content: '';
        -webkit-transition: all .25s ease;
        -moz-transition: all .25s ease;
        -ms-transition: all .25s ease;
        -o-transition: all .25s ease;
        transition: all .25s ease;
        z-index:90;
    }
    #cssmenu > ul > li.has-sub:hover > a:before {
        top: 23px;
        height: 0;
    }
    #cssmenu ul ul {
        position: absolute;
        left: -9999px;
    }
    #cssmenu.align-right ul ul {
        text-align: right;
    }
    #cssmenu ul ul li {
        height: 0;
        -webkit-transition: all .25s ease;
        -moz-transition: all .25s ease;
        -ms-transition: all .25s ease;
        -o-transition: all .25s ease;
        transition: all .25s ease;
    }
    #cssmenu li:hover > ul {
        left: auto;
    }
    #cssmenu.align-right li:hover > ul {
        left: auto;
        right: 0;
    }
    #cssmenu li:hover > ul > li {
        height: 35px;
    }
    #cssmenu ul ul ul {
        margin-left: 100%;
        top: 0;
    }
    #cssmenu.align-right ul ul ul {
        margin-left: 0;
        margin-right: 100%;
    }
    #cssmenu ul ul li a {
        border-bottom: 1px solid rgba(150, 150, 150, 0.15);
        padding: 11px 15px;
        width: 170px;
        font-size: 12px;
        text-decoration: none;
        color: #ffffff;
        font-weight: 400;
        background: #333333;
    }
    #cssmenu ul ul li:last-child > a,
    #cssmenu ul ul li.last-item > a {
        border-bottom: 0;
    }
    #cssmenu ul ul li:hover > a,
    #cssmenu ul ul li a:hover {
        color: #ffffff;
    }
    #cssmenu ul ul li.has-sub > a:after {
        position: absolute;
        top: 16px;
        right: 11px;
        width: 8px;
        height: 2px;
        display: block;
        background: #dddddd;
        content: '';
    }
    #cssmenu.align-right ul ul li.has-sub > a:after {
        right: auto;
        left: 11px;
    }
    #cssmenu ul ul li.has-sub > a:before {
        position: absolute;
        top: 13px;
        right: 14px;
        display: block;
        width: 2px;
        height: 8px;
        background: #dddddd;
        content: '';
        -webkit-transition: all .25s ease;
        -moz-transition: all .25s ease;
        -ms-transition: all .25s ease;
        -o-transition: all .25s ease;
        transition: all .25s ease;
        z-index: 90;
    }
    #cssmenu.align-right ul ul li.has-sub > a:before {
        right: auto;
        left: 14px;
    }
    #cssmenu ul ul > li.has-sub:hover > a:before {
        top: 17px;
        height: 0;
    }
    @media all and (max-width: 768px), only screen and (-webkit-min-device-pixel-ratio: 2) and (max-width: 1024px), only screen and (min--moz-device-pixel-ratio: 2) and (max-width: 1024px), only screen and (-o-min-device-pixel-ratio: 2/1) and (max-width: 1024px), only screen and (min-device-pixel-ratio: 2) and (max-width: 1024px), only screen and (min-resolution: 192dpi) and (max-width: 1024px), only screen and (min-resolution: 2dppx) and (max-width: 1024px) {
        #cssmenu {
            width: 100%;
            z-index:100;
        }
        #cssmenu ul {
            width: 100%;
            display: none;
        }
        #cssmenu.align-center > ul {
            text-align: left;
        }
        #cssmenu ul li {
            width: 100%;
            border-top: 1px solid rgba(120, 120, 120, 0.2);
        }
        #cssmenu ul ul li,
        #cssmenu li:hover > ul > li {
            height: auto;
        }
        #cssmenu ul li a,
        #cssmenu ul ul li a {
            width: 100%;
            border-bottom: 0;
        }
        #cssmenu > ul > li {
            float: none;
        }
        #cssmenu ul ul li a {
            padding-left: 25px;
        }
        #cssmenu ul ul ul li a {
            padding-left: 35px;
        }
        #cssmenu ul ul li a {
            color: #dddddd;
            background: none;
        }
        #cssmenu ul ul li:hover > a,
        #cssmenu ul ul li.active > a {
            color: #ffffff;
        }
        #cssmenu ul ul,
        #cssmenu ul ul ul,
        #cssmenu.align-right ul ul {
            position: relative;
            left: 0;
            width: 100%;
            margin: 0;
            text-align: left;
        }
        #cssmenu > ul > li.has-sub > a:after,
        #cssmenu > ul > li.has-sub > a:before,
        #cssmenu ul ul > li.has-sub > a:after,
        #cssmenu ul ul > li.has-sub > a:before {
            display: none;
        }
        #cssmenu #menu-button {
            display: block;
            padding: 17px;
            color: #dddddd;
            cursor: pointer;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
        }
        #cssmenu #menu-button:after {
            position: absolute;
            top: 22px;
            right: 17px;
            display: block;
            height: 4px;
            width: 20px;
            border-top: 2px solid #dddddd;
            border-bottom: 2px solid #dddddd;
            content: '';
        }
        #cssmenu #menu-button:before {
            position: absolute;
            top: 16px;
            right: 17px;
            display: block;
            height: 2px;
            width: 20px;
            background: #dddddd;
            content: '';
        }
        #cssmenu #menu-button.menu-opened:after {
            top: 23px;
            border: 0;
            height: 2px;
            width: 15px;
            background: #ffffff;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        #cssmenu #menu-button.menu-opened:before {
            top: 23px;
            background: #ffffff;
            width: 15px;
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        #cssmenu .submenu-button {
            position: absolute;
            z-index: 99;
            right: 0;
            top: 0;
            display: block;
            border-left: 1px solid rgba(120, 120, 120, 0.2);
            height: 46px;
            width: 46px;
            cursor: pointer;
        }
        #cssmenu .submenu-button.submenu-opened {
            background: #262626;
        }
        #cssmenu ul ul .submenu-button {
            height: 34px;
            width: 34px;
        }
        #cssmenu .submenu-button:after {
            position: absolute;
            top: 22px;
            right: 19px;
            width: 8px;
            height: 2px;
            display: block;
            background: #dddddd;
            content: '';
        }
        #cssmenu ul ul .submenu-button:after {
            top: 15px;
            right: 13px;
        }
        #cssmenu .submenu-button.submenu-opened:after {
            background: #ffffff;
        }
        #cssmenu .submenu-button:before {
            position: absolute;
            top: 19px;
            right: 22px;
            display: block;
            width: 2px;
            height: 8px;
            background: #dddddd;
            content: '';
        }
        #cssmenu ul ul .submenu-button:before {
            top: 12px;
            right: 16px;
        }
        #cssmenu .submenu-button.submenu-opened:before {
            display: none;
        }
    }

</style>
<script>

    $(document).ready(function () {

        $('#worksheets').click(function () {
            $.fancybox({
                href: "#worksheet_choice"
            });
        });



        $('#Wet_Chemistry').click(function () {
            if ($('#Wet_Chemistry').is(':checked', true)) {
                $.fancybox.close();
                window.location.href = '<?php echo base_url() . 'microbiology_worksheets' ?>';

            }
        });



        $('#microbe').click(function () {
            if ($('#microbe').is(':checked', true)) {
                $.fancybox.close();
                window.location.href = '<?php echo base_url() . 'microbiology_worksheets' ?>';

            }
        });



    });




</script>
<?php
if (!isset($quick_link)) {
    $quick_link = null;
}
$userarray = $this->session->userdata;
$user_id = $userarray['user_id'];
$user_type = $userarray['usertype_id'];
?>

<div id="worksheet_choice">
    <p>
        <input type="radio" name="choice" id="Wet_Chemistry"/>Wet Chemistry
        <br><br>
        <input type="radio" name="choice" id="microbe"/>Microbiology

    </p>

</div>
<div id='cssmenu' ">
    <ul>
        <?php if ($user_type == 2) { ?>

            <li><a class='active' href='<?php echo site_url('request_management'); ?>'>Request Management</a>
                <ul>
                    <li> <a href="<?php echo site_url("request_management/add"); ?>">+ Add New Sample</a></li>
                    <li><a href="#">Samples</a>
                        <ul>
						  <li> <a title="Lost Basket" href="<?php echo site_url("request_management/retriever/"); ?>">REPOSITORY </a></li>
                            <li> <a href="<?php echo site_url("request_management/samples/all"); ?>">All</a></li>
                            <li> <a href="<?php echo site_url("request_management/"); ?>">Current</a></li>  
                            <li> <a href="<?php echo site_url("request_management/client_samples"); ?>">Client Requests</a></li>
                            <li> <a href="<?php echo site_url("request_management/assigned_samples"); ?>">Assigned</a></li>
                            <li> <a href="<?php echo site_url("request_management/samples/oos"); ?>">OOS</a></li>
                            <li> <a href="<?php echo site_url("request_management/samples/rejected"); ?>">Rejected</a></li>
                            <li> <a  id="t_requested" href="#tests_requested">By Test Requested</a></li>
                            <li> <a  id="t_period" href="#Days-Taken">By Days Taken</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Generate</a>
                        <ul>
                            <li> <a href="" id="gen_label">Label</a></li>
                            <li> <a href="" id ="gen_quotation1">Quotation</a></li>
                            <li> <a href="" id ="gen_req_data1">Request Report</a></li>                 
                        </ul>
                    </li>
                    <li> <a href="<?php echo site_url("coa_scans/"); ?>">COA Scans Management</a></li>

                </ul>
            </li>  
			<li><a href="<?php echo site_url("quotation/listall/"); ?>">Quotations</a></li>  
            <li><a href="<?php echo site_url("client_management"); ?>">Clients</a></li>             

            <li><a href='#'>Worksheets</a>
                <ul>
                    <li> <a href="<?php echo site_url("custom_sheets/generic"); ?>">Custom Sheets</a></li>
                    <li> <a href="<?php echo site_url("custom_sheets/excel"); ?>">Standard Sheets</a></li>
                    <li> <a href="<?php echo site_url("custom_sheets/"); ?>">Pdf Sheets</a></li>
                    <li> <a href="<?php echo site_url("custom_sheets/repository"); ?>">Worksheets Repository</a></li>

                </ul>
            </li>    

            </li>
            <li><a href="#" >Inventory</a>

                <ul>
                    <li> <a href="<?php echo site_url("inventory/refSubslist"); ?>">Reference Substance</a></li>
                    <li> <a href="<?php echo site_url("inventory/equipmentlist"); ?>">Equipment</a></li>                     
                    <li> <a href="<?php echo site_url("inventory/columnslist"); ?>">Columns</a></li>
                    <li> <a href="<?php echo site_url("inventory/reagentslist"); ?>">Chemicals & Reagents</a></li>
                </ul>

            </li>
            <li><a href="<?php echo site_url("quotation"); ?>">Quotation</a></li>
            <li><a href="<?php echo site_url("proforma"); ?>">Proforma</a></li>

            <li><a href="<?php echo site_url("main_dashboard"); ?>"">Dashboard</a></li>
            <li><a href="<?php echo site_url("user_registration_supervisor"); ?>">Manage Users</a></li>

        <?php } ?>
        <?php if ($user_type == 4 || $user_type == 5 || $user_type == 25 || $user_type == 8) { ?>
            <li><a class='active' href='<?php echo site_url('request_management'); ?>'>Request Management</a>
                <ul>
                    <li> <a href="<?php echo site_url("request_management/add"); ?>">+ Add New Sample</a></li>
                    <li><a href="#">Samples</a>
                        <ul>
						  <li> <a title="Lost Basket" href="<?php echo site_url("request_management/retriever/"); ?>">REPOSITORY </a></li>
                            <li> <a href="<?php echo site_url("request_management/samples/all"); ?>">All</a></li>
							                            <li> <a href="<?php echo site_url("request_management/client_samples"); ?>">Client Requests</a></li>

                            <li> <a href="<?php echo site_url("request_management/"); ?>">Current</a></li>                          
                            <li> <a href="<?php echo site_url("request_management/assigned_samples"); ?>">Assigned</a></li>
                            <li> <a href="<?php echo site_url("request_management/samples/oos"); ?>">OOS</a></li>
                            <li> <a href="<?php echo site_url("request_management/samples/rejected"); ?>">Rejected</a></li>
                            <li> <a  id="t_requested" href="#tests_requested">By Test Requested</a></li>
                            <li> <a  id="t_period" href="#Days-Taken">By Days Taken</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Generate</a>
                        <ul>
                            <li> <a href="#Generate-label" id="gen_label">Label</a></li>
                            <li> <a href="#Generate-quotation" id ="gen_quotation">Quotation</a></li>
                            <li> <a href="#Generate-request-report" id ="gen_req_data">Request Report</a></li>                 
                        </ul>
                    </li>
                    <li> <a href="<?php echo site_url("coa_scans/"); ?>">COA Scans Management</a></li>
                    <li> <a href="<?php echo site_url("request_management/documentationReport/"); ?>">Documentation Report</a></li>            


                </ul>
            </li>  
			<li><a href="<?php echo site_url("quotation/listall/"); ?>">Quotations</a></li>  
    <!--            <li><a href="<?php echo site_url("oos_sample"); ?>" >OOS Samples</a></li>-->

            <li><a href="#" >Inventory</a>

                <ul>
                    <li> <a href="<?php echo site_url("inventory/refSubslist"); ?>">Reference Substance</a></li>
                    <li> <a href="<?php echo site_url("inventory/equipmentlist"); ?>">Equipment</a></li>                     
                    <li> <a href="<?php echo site_url("inventory/columnslist"); ?>">Columns</a></li>
                    <li> <a href="<?php echo site_url("inventory/reagentslist"); ?>">Chemicals & Reagents</a></li>
                </ul>

            </li>
            <li><a href="<?php echo site_url("analyst_supervisor"); ?>" >Assign Supervisor</a></li>
            <li><a href="#">Done Samples</a>
                <ul>
                    <li> <a href="<?php echo site_url("documentation/home/"); ?>" >Analyzed</a></li>
                    <li> <a href="<?php echo site_url("documentation/reviewed/"); ?>" >Reviewed</a></li>
                    <li> <a href="<?php echo site_url("documentation/fromDirector/"); ?> ">From Director</a></li>  
                    <li> <a href="<?php echo site_url("documentation/rejected/"); ?> ">Rejected COAs</a></li> 
                </ul>
            </li>
            <li><a href='#'>Worksheets</a>
                <ul>
                    <li> <a href="<?php echo site_url("custom_sheets/generic"); ?>">Custom Sheets</a></li>
                    <li> <a href="<?php echo site_url("custom_sheets/excel"); ?>">Standard Sheets</a></li>
                    <li> <a href="<?php echo site_url("custom_sheets/"); ?>">Pdf Sheets</a></li>

                </ul>
            </li>   


            <li><a href="<?php echo site_url("client_management"); ?>">Manage Clients</a></li>
            <!--            <li><a href="#worksheet_choice" id="worksheets">Worksheet</a></li>-->
            <li><a href="<?php echo site_url("main_dashboard"); ?>">Dashboard</a></li>
            
             <li><a href="<?php echo site_url("request_management/report_engine"); ?>" target="_blank">Report Engine</a></li>

        <?php } ?>

        <?php if ($user_type == 29) { ?>
            <li><a href="<?php echo site_url("client_billing_management/requestsHistory"); ?>" >Requests</a></li>
            <li><a href="<?php echo site_url("client_billing_management/paymentHistory"); ?> ">Payments</a></li>
            <li><a href="<?php echo site_url("client_billing_management/sampleTracking"); ?>"  >Tracking</a></li>

        <?php } ?>
        <?php if ($user_type == 24 || $user_type == 14) { ?>  
            <li><a href="<?php echo site_url("finance_management/clientRegister"); ?>">Client Register</a></li>
            <li><a href="<?php echo site_url("finance_management/dispatchRegister"); ?>">COA Register</a></li>  
            <li><a href="<?php echo site_url("request_management/"); ?>" >Samples Register</a></li>
        <?php } ?> 


    </ul>
</div>



<div id="main_content">
    <?php
    $this->load->view($settings_view);
    ?>
</div>
