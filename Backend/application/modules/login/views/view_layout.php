<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />        <!--bootstrap-->
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <title>vOder Backend</title>
        <!--custome css --!>
        <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            $( document ).ready(function() {
  			var header_height = $("#header").height();
            var contain_height = $("#mid-contain").height();
            var bottom_height = 768-(header_height+contain_height);
            $("#bottom").css("height",bottom_height + "px");
		});
        </script>
    </head>
    <body>
         <?php
                $this->load->view($module . '/' . $view_file);
         ?>	
    </body>
</html>

