<?php

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="header">
            <img src="<?php echo base_url() ?>assets/img_logo_2x.png" />
            <p>Login to get Start!</p>
        </div>    
    </div>
    <div class="row">
        <div class="col-md-12" id="mid-contain">
            <form class="form-inline" role="form" action="<?php echo base_url().'login/verifylogin' ?>" method="post">
            <div class="error_message" style="margin-top: 19px;color:red"><?php if(isset($error))echo $error; ?></div>
            <div class="row" id="first-row">
                <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_email.png"/></div>
                      <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="input-group">
                     <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_password.png"/></div>
                    <input type="password" class="form-control" name="password" placeholder="Password" required />
                    </div>
                </div>
            </div>  
            <div class="row" id="last-row">
                <button type="submit" class="btn btn-info" id="btn-login-form">Log In</button>
            </div>          
            </form>
        </div>            
    </div>
    <div class="row">
        <div class="col-md-12" id="bottom">
            <p><a href="<?php echo base_url().'login/signup' ?>">Register!</a></p>
            <p><a href="<?php echo base_url().'login/forgotpass' ?>">Forgotten password!</a></p>            
        </div>    
    </div>
</div>