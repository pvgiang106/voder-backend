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

		<!-- Optional theme -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css">
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
              //date picker 
              $('#cu_date_keyword').datepicker({
                    format: "yyyy-mm-dd"
                });
               $("#cu_date_keyword").on("changeDate",function (e) {
                    $("form#search").submit();
                });
            }); 
        </script>
    </head>
    <body>
       	<div class="container-fluid">            
            <div class="row" id="header">
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-6"><a href="<?php echo base_url().'customer'; ?>"><img src="<?php echo base_url(); ?>assets/img_logo.png" /></a></div>
                    <div class="col-md-6" id="setting">
                        <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false"><?php echo $user['email'] ?><img src="<?php echo base_url(); ?>assets/icon_setting.png" /></button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="<?php echo base_url().'customer/editcustomer' ?>">Edit Details</a></li>
                                <li><a href="<?php echo base_url().'customer/changepass'?>">New Password</a></li>
                                <li><a href="<?php echo base_url() ?>login/logout">Log Out</a></li>
                                
                            </ul>
                    </div><!-- /.col-lg-6 -->
                    </div>
                <div class="row">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="header_nav">
                    <li role="presentation" class="active"><a href="#customer"role="tab" data-toggle="tab">Customer</a></li>
                   
                    </ul>                
                </div>
                </div>                
            </div>
            <div class="row" id="content">
                 <!-- Tab panes -->
                    <div role="tabpanel" class="tab-pane active" id="customer">
                        <?php
                            $this->load->view($module . '/' . $view_customer);
                         ?>	              
                    </div>
            </div>
            <div class="row" id="footter">
            
            </div>
        </div>
    </body>
</html>
