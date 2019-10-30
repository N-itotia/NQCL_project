﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title> NQCL Admin | Dashboard  </title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dashboard/css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dashboard/css/text.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dashboard/css/grid.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dashboard/css/layout.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dashboard/css/nav.css" media="screen" />
        <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
        <!-- BEGIN: load jquery -->
        <script src="<?php echo base_url();?>dashboard/js/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url();?>dashboard/js/jquery-ui/jquery.ui.core.min.js"></script>
        <script src="<?php echo base_url();?>dashboard/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>dashboard/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>dashboard/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>dashboard/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
        <!-- END: load jquery -->
       <link href="<?php echo base_url(); ?>scripts/jquery-ui-1.10.3/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />

        
        <!-- BEGIN: load jqplot -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dashboard/css/jquery.jqplot.min.css" />
        <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="js/jqPlot/excanvas.min.js"></script><![endif]-->
        <script language="javascript" type="text/javascript" src="<?php echo base_url();?>dashboard/js/jqPlot/jquery.jqplot.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url();?>dashboard/js/jqPlot/plugins/jqplot.barRenderer.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url();?>dashboard/js/jqPlot/plugins/jqplot.pieRenderer.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url();?>dashboard/js/jqPlot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url();?>dashboard/js/jqPlot/plugins/jqplot.highlighter.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url();?>dashboard/js/jqPlot/plugins/jqplot.pointLabels.min.js"></script>
        <!-- END: load jqplot -->
        
        <link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css'?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url().'javascripts/DataTables-1.9.3/media/js/jquery.dataTables.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'javascripts/DataTables-1.9.3/media/js/jquery.dataTables.grouping.js'?>" type="text/javascript"></script> 


        <script src="<?php echo base_url();?>dashboard/js/setup.js" type="text/javascript"></script>
        <script type="text/javascript">

            $(document).ready(function() {
                //setupDashboardChart('chart1');
                setupLeftMenu();
                setSidebarHeight();


            });
        </script>
    </head>