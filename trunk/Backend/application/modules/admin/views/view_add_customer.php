 <div class="col-md-12" id="content">
    <div class="row">
    </div> 
    <div class="row">
    <div class="col-md-5" style="padding-top: 20px;">
        <p style="color: #4dd6ce; margin:0px;"><b>New Customer</b></p>
        <p>Add Customer Details</p>
    </div>
    <div class="col-md-5 col-md-offset-2" style="padding-top: 20px;">
       <p style="color: #4dd6ce; margin:0px;"><b>(Optional)</b></p>
       <p>Enter Credit Card Details</p>
    </div>        
    </div> 
     <form role="form" method="post" action="<?php echo base_url().'admin/verifycustomer/insertcustomer'?>" enctype="multipart/form-data">
    <div class="row" id="content-mid">       
        <div class="col-md-5">            
                <p>Name</p>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="firstName" placeholder="First" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="lastName" placeholder="Last" >
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
                <input type="password" class="form-control" name="password" placeholder="Password">
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
                <p>Avatar</p>
                <input type="file" id="image" name="image">
            </div>
        </div>
        <div class="col-md-5 col-md-offset-2">
                <div class="form-group">
                    <p>Card Name</p>
                    <input type="text" class="form-control" name="card_name" placeholder="" >
                </div>
                <div class="form-group">
                    <p>Card Number</p>
                    <input type="text" class="form-control" name="card_number" placeholder="">
                </div> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Expire Day</p>
                            <input type="date" class="form-control" id="expire_date" name="expire_date" placeholder="" >
                        </div>
                        <div class="col-md-6">
                            <p>CCV</p>
                            <input type="text" class="form-control" name="ccv" placeholder="" >
                        </div>
                    </div>
                </div>           
            
        </div>             
        
    </div>
    <div class="row">
        <div class="col-md-12" style="padding-top: 20px;">
            <button type="submit" class="btn submit">Done</button>
            <a style="color: #333;" href="<?php echo base_url().'admin?tab_active=1'; ?>"><button type="button" class="btn btn-default" name="reset">Cancel</button></a>
        </div>
         
    </div> 
    </form>                      
</div>      