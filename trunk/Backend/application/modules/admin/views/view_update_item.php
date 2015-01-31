 <?php
 //   var_dump($itemInfo);
 ?>
 
 <div class="col-md-12" id="content">
    <div class="row">
    </div> 
    <div class="row">
    <div class="col-md-12" style="padding-top: 20px;">
        <p style="color: #4dd6ce; margin:0px;"><b>New Item</b></p>
        <p>Add Item Details</p>
    </div>
      
    </div> 
     <form role="form" method="post" action="<?php echo base_url().'admin/verifypartner/updateitem'?>" enctype="multipart/form-data">
    <div class="row" id="content-mid">       
        <div class="col-md-5">            
                <p>Name</p>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" name="menuID">
                            <?php for($i=0;$i<sizeof($listGroupName);$i++) {?>
                              <option value="<?php echo $listGroupName[$i]->menuID; ?>"><?php echo $listGroupName[$i]->groupName; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>            
            <div class="form-group">
                <p>Item Name</p>
                <input type="text" class="form-control" name="title" value="<?php echo $itemInfo->title ?>" required>
            </div>
            <div class="form-group">
                <p>Description</p>
                <textarea class="form-control" rows="3" name="description" ><?php echo $itemInfo->description ?></textarea>
            </div>
            <p>Price</p>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="price" value="<?php echo $itemInfo->price ?>" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <p>Image</p>
                <input type="file" id="image" name="image">
            </div>
            <?php if(isset($error)) echo "<p style='color:red'>".$error."</p>" ?>
        </div>      
    </div>
    <div class="row">
        <div class="col-md-12" style="padding-top: 20px;">
            <input type="hidden" name="partnerID" value="<?php echo $partner[0]->partnerID?>" />
            <input type="hidden" name="itemID" value="<?php echo $itemInfo->itemID?>" />
            <button type="submit" class="btn submit">Done</button>
            <a style="color: #333;" href="<?php echo base_url().'admin?tab_active=0'; ?>"><button type="button" class="btn btn-default" name="reset">Cancel</button></a>
        </div>
         
    </div> 
    </form>                      
</div>      