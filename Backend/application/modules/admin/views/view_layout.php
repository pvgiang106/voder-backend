<?php
    if(!isset($tab_active)){
        $tab = 0;
    }else{
        $tab = $tab_active;
    }
?>
<!DOCTYPE html>
<html>
    <head>       
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Access the desktop camera and video using HTML, JavaScript, and Canvas.  The camera may be controlled using HTML5 and getUserMedia." />        <!--bootstrap-->
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>
        <!--custome css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin.css" />
        <title>vOder Backend</title>
        <script type="text/javascript">
            $(document).ready(function(){
              $('#cu_name_keyword').on('input',function(e){
                    var delimage="<image src='<?php echo base_url() ?>assets/icon_del_search.png' />";
                    $('#cu_del_search').html(delimage);                    
                });
              $('#cu_del_search').click(function(){
                    $('#cu_name_keyword').val('');
                     $('#cu_del_search').html('');
              });
              
              $('#pa_name_keyword').on('input',function(e){
                    var delimage="<image src='<?php echo base_url() ?>assets/icon_del_search.png' />";
                    $('#pa_del_search').html(delimage);                    
                });
              $('#pa_del_search').click(function(){
                    $('#pa_name_keyword').val('');
                     $('#pa_del_search').html('');
              });
              //date picker 
              $('#cu_date_keyword').datepicker({
                    format: "yyyy-mm-dd"
                });
                $("#cu_date_keyword").on("changeDate",function (e) {
                    $("form#cu_search").submit();
                });
                $('#pa_date_keyword').datepicker({
                    format: "yyyy-mm-dd"
                });
                $("#pa_date_keyword").on("changeDate",function (e) {
                    $("form#pa_search").submit();
                });
                $("#tab_partner").click(function (e) {
                    window.location.replace("<?php echo base_url().'admin'?>");
                });
                $("#tab_customer").click(function (e) {
                    window.location.replace("<?php echo base_url().'admin?tab_active=1'?>");
                });
                $('#expire_date').datepicker({
                    format: "yyyy-mm-dd"
                });
            }); 
        </script>
    </head>
    <body>
       	<div class="container-fluid">            
            <div class="row" id="header">
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-6"><a href="<?php echo base_url().'admin'; ?>"><img src="<?php echo base_url(); ?>assets/img_logo.png" /></a></div>
                    <div class="col-md-6" id="setting">
                        <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false"><?php echo $user['email'] ?><img src="<?php echo base_url(); ?>assets/icon_setting.png" /></button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="<?php echo base_url().'admin/edituser'?>">Edit detail</a></li>
                                <li><a href="<?php echo base_url().'admin/changepass'?>">New Password</a></li>
                                <li><a href="<?php echo base_url() ?>login/logout">Log Out</a></li>
                                
                            </ul>
                    </div><!-- /.col-lg-6 -->
                    </div>
                <div class="row">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="header_nav">
                    <li role="presentation" <?php if($tab == 0) echo "class='active'";?> id="tab_partner"><a href="#business_partner"role="tab" data-toggle="tab">Business Partners</a></li>
                    <li role="presentation" <?php if($tab == 1) echo "class='active'";?> id="tab_customer"><a href="#customer" role="tab" data-toggle="tab">Customer</a></li>
                    </ul>                
                </div>
                </div>                
            </div>
            <div class="row" id="content">
                 <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane <?php if($tab == 0) echo "active";?>" id="business_partner">
                        <?php
                            $this->load->view($module . '/' . $view_partner);
                         ?>	
                    </div>
                    <div role="tabpanel" class="tab-pane <?php if($tab == 1) echo "active";?>" id="customer">
                        <?php
                            $this->load->view($module . '/' . $view_customer);
                         ?>	              
                    </div>
                  </div>
            </div>
            <div class="row" id="footter">
            
            </div>
        </div>
    </body>
</html>
