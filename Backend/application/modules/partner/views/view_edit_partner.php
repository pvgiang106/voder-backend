<?php
//var_dump($bankInfo);
?>
    <div class="col-md-12" id="content">
        <div class="row">
        </div> 
        <div class="row">
        <div class="col-md-5" style="padding-top: 20px;">
            <p style="color: #4dd6ce; margin:0px;"><b>Edit partner</b></p>
            <p>partner Details</p>
        </div>
        <div class="col-md-5 col-md-offset-2" style="padding-top: 20px;">
           <p style="color: #4dd6ce; margin:0px;"><b>(Optional)</b></p>
           <p>Enter Bank Details</p>
        </div>        
        </div> 
         <form role="form" method="post" action="<?php echo base_url().'partner/verifypartner/updatepartner'?>" enctype="multipart/form-data" >
        <div class="row" id="content-mid">       
            <div class="col-md-5">            
                    <p>Partner Name</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="firstName" value="<?php echo $partnerInfo->firstName ; ?>" required >
                            </div>                            
                        </div>
                    </div>
                
                <div class="form-group">
                    <p>Email address</p>
                    <input type="email" class="form-control" value="<?php echo $partnerInfo->email ; ?>" disabled="disbale" />
                </div>
                <div class="form-group">
                    <p>Address</p>
                    <input type="text"  name="address" class="form-control" value="<?php echo $partnerInfo->address ; ?>" />
                </div>
                <p>Phone</p>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" value="<?php echo $partnerInfo->phone ; ?>" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p>Logo</p>
                    <input type="file" id="image" name="image">
                </div>
                <div class="form-group">
                    <p>Your Password</p>
                    <input type="password" class="form-control" name="old_password" required >
                    <?php if(isset($error)){
                        echo "<p style='color:red'>".$error."</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-2">
                    <div class="form-group">
                        <p>Bank Name</p>
                        <input type="text" class="form-control" name="bank_name" value="<?php if($bankInfo) echo $bankInfo->name ; ?>" >
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                 <p>BSB</p>
                                 <input type="text" class="form-control" name="bsb" value="<?php if($bankInfo) echo $bankInfo->bsb ; ?>">
                            </div>
                        </div>                   
                    </div> 
                    <div class="form-group">
                        <p>Bank Number</p>
                        <input type="date" class="form-control" name="bank_number" value="<?php if($bankInfo) echo $bankInfo->number ; ?>" >
                    </div>
            </div>
        </div>        
    <div class="row">
        <div class="col-md-12" style="padding-top: 20px;">
            <input type="hidden" name="partnerID" value="<?php echo $partnerInfo->partnerID ?>" />
            <input type="hidden" name="email" value="<?php echo $partnerInfo->email ; ?>" />
            <?php if($bankInfo){
                echo "<input type='hidden' name='bankTypeID' value='".$bankInfo->bankTypeID."' />" ;
            }            
            ?>
            <button type="submit" class="btn submit">Update</button>
            <a style="color: #333;" href="<?php echo base_url().'partner'; ?>"><button  type="button"  class="btn btn-default">Cancel</button></a>
        </div>
         
    </div> 
    </form>                      
</div>      