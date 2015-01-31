<?php
//var_dump($partnerInfo);
?>
    <div class="col-md-12" id="content">
        <div class="row">
        </div> 
        <div class="row">
        <div class="col-md-5" style="padding-top: 20px;">
            <p style="color: #4dd6ce; margin:0px;"><b>Add business</b></p>
            <p>Business Details</p>
        </div>
     
        </div> 
        <form role="form" method="post" action="<?php echo base_url().'admin/verifypartner/insertbusiness' ;?>" enctype="multipart/form-data">
        <div class="row" id="content-mid">       
            <div class="col-md-5">      
                    
                <div class="form-group"> 
                    <p>Name</p>                     
                    <input type="text" class="form-control" name="name" value="" required >
                </div>
                
                <div class="form-group">
                    <p>Address</p>
                    <input type="text"  name="address" class="form-control" value="" />
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Longitude</p>
                            <input type="text" name="longtitude" class="form-control" value=""  />
                        </div>
                        <div class="col-md-6">
                            <p>Latitude</p>
                            <input type="text" name="latitude" class="form-control" value=""  />
                        </div>
                    </div>                    
                </div>
                <div class="form-group">
                    <p>Image</p>
                    <input type="file" id="image" name="image">
                </div>
            </div>
            <div class="col-md-5 col-md-offset-2">
            </div>
    </div>        
    <div class="row">
        <div class="col-md-12" style="padding-top: 20px;">
            <input type="hidden" name="partnerID" value="<?php echo $partnerInfo->partnerID ?>" />
            <button type="submit" class="btn submit">Create</button>
            <a style="color: #333;" href="<?php echo base_url().'admin/partner/'.$partnerInfo->partnerID ; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
        </div>
         
    </div> 
    </form>                      
</div>      