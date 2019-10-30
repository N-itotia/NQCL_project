<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/jquery.modal.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>coa_engine/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/main.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/select2.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/jquery-confirm.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/js/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>coa_engine/css/smartadmin-production-plugins.min.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery.js"></script>

    </head>
    
    <style>
    
    </style>
    <script>
    
        </script>

    <body>
        <div class="fadeMe">
            <img src="<?php echo base_url(); ?>coa_engine/img/processing.gif " alt="Loader" style="margin-top:300px; margin-left: 500px;" >          
        </div>
       
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">NQCL COA ENGINE</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">COA HOME <span class="sr-only">(current)</span></a></li>
                        <li><a href="#Copy-to-Clipboard" id="hrefCopy"><span class="fa fa-copy" title="Copy to Browser Clipboard  Ctl+C"></span></a></li>
                        <li><a href="#Paste-from-Clipboard" id="hrefPaste"><span class="fa fa-paste" title="Copy from Browser Clipboard   Ctl+V"></span></a></li>
                        <li><a href="#EmptyClipboard" id="hrefEmpty"><span class="fa fa-cut" title="Empty Browser Clipboard"></span></a></li>
                        <li><a href="#UndoClipboard" id="hrefUndo"><span class="fa fa-undo" title="Undo Previous Action"></span></a></li>
                       <a href="<?php echo base_url().'coa/generatecoa_invoice/'.$labref.'/INVOICE';?>" target="_blank"><span class="fa fa-money" title="Invoice"></span></a>

                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <select  class="form-control select select2" placeholder="Search" id="labrefs_area" style="width:200px;"></select>
                        </div>
                        <button type="button" class="btn btn-primary" id="makeCOPY1" title="Get a generated BAT file for the COA draft currently on the page coppied to the word docx">Get Ms.Word Ext File</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#View-Changes" id="show_logs">Sample Change Log</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div id="content" style="margin-top: 55px;">
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-md-9 col-md-offset-2" id="COA_AREA">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
                        <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"

                        -->
                        <header>
                            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>


                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->