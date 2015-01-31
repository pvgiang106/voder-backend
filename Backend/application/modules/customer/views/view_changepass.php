 <div class="col-md-12" id="content">
    <div class="row">
    </div> 
    <div class="row">
    <div class="col-md-5" style="padding-top: 20px;">
        <p style="color: #4dd6ce; margin:0px;"><b>Change Password</b></p>
    </div>     
    </div> 
     <form role="form" method="post" action="<?php echo base_url().'customer/changepass'?>">
    <div class="row" id="content-mid">       
        <div class="col-md-5">            
            <div class="form-group">
                <p>Old Password</p>
                <input type="password" class="form-control" name="old_password" placeholder="Enter current password" required>
            </div>
            <div class="form-group">
                <p>New Password</p>
                <input type="password" class="form-control" name="new_password" placeholder="New Password" required>
            </div>
            <div class="form-group"> 
                <p>Confirm Password</p>              
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm pass" required>
            </div>
            <?php if(isset($error)){
                    echo "<p style='color:red'>".$error."</p>";
                }
                ?>
        </div>
     
        
    </div>
    <div class="row">
        <div class="col-md-12" style="padding-top: 20px;">
            <button type="submit" class="btn submit">Done</button>
            <a style="color: #333;" href="<?php echo base_url().'customer'; ?>"><button  type="button" class="btn btn-default" name="reset">Cancel</button></a>
        </div>
         
    </div> 
    </form>                      
</div>      