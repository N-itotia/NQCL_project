<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>elfinder/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>elfinder/css/theme.css">	

		<script src="<?php echo base_url();?>elfinder/js/elfinder.min.js"></script>
                	<script type="text/javascript" charset="utf-8">
			// Documentation for client options:
			// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
			$(document).ready(function() {
				$('#elfinder').elfinder({
					url : '<?php echo base_url();?>custom_sheets/connector' // connector URL (REQUIRED)
					// , lang: 'ru'                    // language (OPTIONAL)
				});
			});
		</script>
    </head>
    <body>
        <div id="elfinder" style="margin-top:20px !important;"></div>
    </body>
</html>
