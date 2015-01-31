<?php 
//    var_dump()
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="header">
            <img src="<?php echo base_url() ?>assets/img_logo_2x.png" />
            <p>New to us?</p>
        </div>    
    </div>
    <div class="row">
        <div class="col-md-12" id="mid-contain">
            <form class="form-inline" role="form" action="<?php echo base_url().'login/verifylogin/register' ?>" method="post">
            <div class="error_message" style="margin-top: 19px;color:red"><?php if(isset($error))echo $error; ?></div>
            <div class="row" id="first-row">
                <div class="form-group">
                    <div class="input-group">
                     <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_user.png"/></div>
                    <input type="text" class="form-control" name="firstName" placeholder="Name" required>
                    </div>
                </div>
            </div>
            <div class="row">
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
                     <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_phone.png"/></div>
                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="input-group">
                     <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_password.png"/></div>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <div class="input-group" >
                    <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_user.png"/></div>
                    <select class="form-control" name="userType" >
                      <option value="customer">Customer</option>
                      <option value="partner">Partner</option>
                     </select>                
                </div>
                </div>
            </div>
            <div class="row" id="last-row">
                <button type="submit" class="btn btn-info" id="btn-login-form">Register</button>
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