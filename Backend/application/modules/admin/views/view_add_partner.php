 <div class="col-md-12" id="content">
    <div class="row">
    </div> 
    <div class="row">
    <div class="col-md-5" style="padding-top: 20px;">
        <p style="color: #4dd6ce; margin:0px;"><b>New Partner</b></p>
        <p>Add Partner Details</p>
    </div>
    <div class="col-md-5 col-md-offset-2" style="padding-top: 20px;">
       <p style="color: #4dd6ce; margin:0px;"><b>(Optional)</b></p>
       <p>Enter Bank Details</p>
    </div>        
    </div> 
     <form role="form" method="post" action="<?php echo base_url().'admin/verifypartner/insertpartner'?>" enctype="multipart/form-data">
    <div class="row" id="content-mid">       
        <div class="col-md-5">            
                <p>Business name</p>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="firstName" placeholder="Business name" required>
                        </div>
                    </div>
                </div>            
            <div class="form-group">
                <p>Email address</p>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                <?php if(isset($error)){
                    echo "<p style='color:red'>".$error."</p>";
                }
                ?>
            </div>
            <div class="form-group">
                <p>Password</p>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <p>Address</p>
                <input type="text" class="form-control" name="address" placeholder="Enter address" >

            </div>
            <p>Phone</p>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="phone" placeholder="Phone" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <p>Logo</p>
                <input type="file" id="image" name="image">
            </div>
        </div>
        <div class="col-md-5 col-md-offset-2">
                <div class="form-group">
                    <p>Bank Name</p>
                    <input type="text" class="form-control" name="bank_name" placeholder="" >
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <p>BSB</p>
                            <input type="text" class="form-control" name="bsb" placeholder="">
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <p>Bank Number</p>
                    <input type="text" class="form-control" name="bank_number" placeholder="" >
                </div>          
            
        </div>             
        
    </div>
    <div class="row">
        <div class="col-md-12" style="padding-top: 20px;">
            <button type="submit" class="btn submit">Done</button>
            <a style="color: #333;" href="<?php echo base_url().'admin?tab_active=0'; ?>"><button type="button" class="btn btn-default" >Cancel</button></a>
        </div>
         
    </div> 
    </form>                      
</div>      