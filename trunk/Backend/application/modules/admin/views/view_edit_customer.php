<?php
//var_dump($cardInfo);
?>
 <div class="col-md-12" id="content">
    <div class="row">
    </div> 
    <div class="row">
    <div class="col-md-5" style="padding-top: 20px;">
        <p style="color: #4dd6ce; margin:0px;"><b>Edit Customer</b></p>
        <p>Customer Details</p>
    </div>
    <div class="col-md-5 col-md-offset-2" style="padding-top: 20px;">
       <p style="color: #4dd6ce; margin:0px;"><b>(Optional)</b></p>
       <p>Enter Credit Card Details</p>
    </div>        
    </div> 
     <form role="form" method="post" action="<?php echo base_url().'admin/verifycustomer/updatecustomer/'.$customerInfo->customerID ?>" enctype="multipart/form-data">
    <div class="row" id="content-mid">       
        <div class="col-md-5">            
                <p>Name</p>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="firstName" value="<?php echo $customerInfo->firstName ; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="lastName" value="<?php echo $customerInfo->lastName ; ?>" >
                        </div>
                    </div>
                </div>
            
            <div class="form-group">
                <p>Email address</p>
                <input type="email" class="form-control" value="<?php echo $customerInfo->email ; ?>" disabled="disbale" />
            </div>        

            <p>Phone</p>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $customerInfo->phone ; ?>" >
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
                    <input type="text" class="form-control" name="card_name" value="<?php if($cardInfo) echo $cardInfo->name ; ?>" >
                </div>
                <div class="form-group">
                    <p>Card Number</p>
                    <input type="text" class="form-control" name="card_number" value="<?php if($cardInfo) echo $cardInfo->number ; ?>">
                </div> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Expire Day</p>
                            <input type="date" class="form-control" name="expire_date" value="<?php if($cardInfo) echo $cardInfo->expire_date ; ?>" >
                        </div>
                        <div class="col-md-6">
                            <p>CCV</p>
                            <input type="text" class="form-control" name="ccv" value="<?php if($cardInfo) echo $cardInfo->ccv ; ?>" >
                        </div>
                    </div>
                </div>
        </div>             
        
    </div>
    <div class="row">
        <div class="col-md-12" style="padding-top: 20px;">
            <input type="hidden" name="customerID" value="<?php echo $customerInfo->customerID ?>" />
            <input type="hidden" name="email" value="<?php echo $customerInfo->email ; ?>" />
            <?php if($cardInfo){
                echo "<input type='hidden' name='cardTypeID' value='".$cardInfo->cardTypeID."' />" ;
            }            
            ?>
            <button type="submit" class="btn submit">Update</button>
            <a style="color: #333;" href="<?php echo base_url().'admin?tab_active=1'; ?>"><button  type="button" class="btn btn-default">Cancel</button></a>
        </div>
         
    </div> 
    </form>                      
</div>      