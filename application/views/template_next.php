
<!--Latest updates to JS-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>


                <!--Updated JS and CSS via Yarn Begin-->

                <!--Site-wide General CSS-->
                <link href="<?php echo base_url() . 'CSS/style.css' ?>" type="text/css" rel="stylesheet"/> 

                <!--Bulma CSS-->
                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'node_modules/bulma/css/bulma.css';?>">

                <!--JQuery-->
                <script src="<?php echo base_url() . 'node_modules/jquery/dist/jquery.js' ?>" type="text/javascript"></script>

                <!--JQuery-UI-->
                <script src="<?php echo base_url() . 'node_modules/jquery-ui/dist/jquery-ui.js' ?>" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'node_modules/jquery-ui/themes/south-street/jquery-ui.css';?>">
                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'node_modules/jquery-ui/themes/south-street/jquery-ui.theme.css';?>">

                <!--Datatables-->
                <script src="<?php echo base_url() . 'node_modules/datatables/media/js/jquery.datatables.js' ?>" type="text/javascript"></script>
                <script src="<?php echo base_url() . 'node_modules/datatables-buttons/js/dataTables.buttons.js' ?>" type="text/javascript"></script>
                <script src="<?php echo base_url() . 'node_modules/datatables-buttons/js/buttons.jqueryui.js' ?>" type="text/javascript"></script>

                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'node_modules/datatables/media/css/jquery.dataTables.css';?>">
                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'node_modules/datatables-buttons/css/buttons.jqueryui.css';?>">

                
                <!--Fancybox-->
                <script src="<?php echo base_url() . 'node_modules/fancybox/dist/js/jquery.fancybox.js' ?>" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'node_modules/fancybox/dist/css/jquery.fancybox.css';?>">

                <!--Accounting-->
                <script src="<?php echo base_url() . 'node_modules/accounting/accounting.js' ?>" type="text/javascript"></script> 

                <!--Money-->
                <script src="<?php echo base_url() . 'node_modules/money/money.js' ?>" type="text/javascript"></script>   

                <!--Vue JS -->
                <!--script src="<?php //echo base_url() . 'node_modules/vue/dist/vue.js' ?>" type="text/javascript"></script-->

                <!--Axios-->
                <script src="<?php echo base_url() . 'node_modules/axios/dist/axios.js' ?>" type="text/javascript"></script>

                <!--Noty-->
                <script src="<?php echo base_url() . 'node_modules/noty/lib/noty.js' ?>" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'node_modules/noty/lib/noty.css';?>">
                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'node_modules/noty/lib/themes/mint.css';?>">                

                <!--End-->

        </head>
        <div> 
                <?php $this -> load -> view($content_view);?>
        </div>
</html>