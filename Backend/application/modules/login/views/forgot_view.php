<script type="text/javascript">
    $( document ).ready(function() {
    $("#mid-contain #first-row").css("margin-top","39px");
    $("#mid-contain #last-row").css("padding-bottom","39px");
	});
  </script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="header">
            <img src="<?php echo base_url() ?>assets/img_logo_2x.png" />
            <p>Forgotten Password?</p>
        </div>    
    </div>
    <div class="row">
        <div class="col-md-12" id="mid-contain">
            <form class="form-inline" role="form" action="<?php echo base_url().'login/verifylogin/resetpass' ?>" method="post">
            <div class="row" id="first-row">
				<?php if(isset($error)){
                    echo "<p style='color:red'>".$error."</p>";
                }
                ?>
                <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_email.png"/></div>
                      <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                    </div>
                </div>
            </div>
            <div class="row" id="last-row">
                <button type="submit" class="btn btn-info" id="btn-login-form">Submit</button>
            </div>          
            </form>
        </div>            
    </div>
    <div class="row">
        <div class="col-md-12" id="bottom">
            <p><a href="<?php echo base_url(); ?>">Back to Log In</a></p>
        </div>    
    </div>
</div>