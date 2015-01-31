<?php
//   var_dump($listMenu);
   if(!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }
    //var_dump($listMenu);
    $current_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>
<script>
    function confirmDeleteItem(idItem){
        var url = "<?php echo base_url().'partner/verifypartner/deleteitem/'?>"+idItem;
        $("#delete_item_confirm").attr('href', url);
    }
 </script>
 <div class="col-md-12" id="content">
    <div class="row" id="content-top">
        <div class="col-md-2">
          <img width="110" height="110" src="<?php if($partner->image != null && $partner->image != ''){echo base_url().$partner->image;} else { echo  base_url().'image/default.jpg' ;}?>" />
        </div>
        <div class="col-md-8">
            <p style="color: #4dd6ce; margin:0px;font-size: 30px;"><b><?php echo $partner->firstName.' '.$partner->lastName ?></b></p>
            <p style="margin-bottom: 5px;">Email: <?php echo $partner->email ?></p>
            <p style="margin-bottom: 5px;">Phone: <?php echo $partner->phone ?></p>
            <p style="margin-bottom: 5px;">Address: <?php echo $partner->address ?></p>
        </div>
    </div> 
    <div class="row" id="content-top1" >
    <div class="col-md-2">
        <p>Bank Account Name:</p>
        <p>Bank Name:</p>
    </div>
    <div class="col-md-2" >
        <p><?php if($bankInfo!= null) echo $partner->firstName.' '.$partner->lastName ?></p>
        <p><?php if($bankInfo!= null) echo $bankInfo->name ?></p>
    </div>
    <div class="col-md-2">
        <p>Bank Numer</p>
        <p>BSB:</p>
    </div>
    <div class="col-md-2">
        <p><?php if($bankInfo!= null) echo $bankInfo->number ?></p>
        <p><?php if($bankInfo!= null) echo $bankInfo->bsb ?></p>
    </div>
    <div class="col-md-3 col-md-offset-1" id="div_search">
        <form role="form" method="get" action="<?php echo base_url().'partner' ;?>" id="search">
       <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_search.png"/></div>
              <input type="text" class="form-control" name="pa_name_keyword" id="pa_name_keyword" placeholder="Search" required>
              <div class="input-group-addon" id="pa_del_search"></div>
            </div>
        </div>
        </form>
    </div>        
    </div> 
    <div class="row" id="content-mid">
    <?php if ($business != null) {?>
       <table class="table table-bordered">
            <tr id="tbl_header">
                <td><b>Menu</b><a href="<?php echo base_url().'partner/additem/'.$business->businessID ?>"><img style="margin-left: 712px;;"src="<?php echo base_url().'assets/icon_add_menu.png' ?>" /></a> New item<a href="#"><img data-toggle="modal" data-target="#modalMenuItem" style="margin-left: 20px;;"src="<?php echo base_url().'assets/icon_add_menu.png' ?>" /></a> New group</td>
            </tr>
            <tr>
                <td>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php if($listMenu != null){ for($i=8*($page-1);$i<sizeof($listMenu);$i++){ if($i == 8*$page){ break;} $menu = $listMenu[$i]; ?>           
                    
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="<?php echo "heading_".$menu->menuID; ?>">
                          <h4 class="panel-title">
                            <a href="#" style="margin-bottom: 10px;"><img height="15" data-toggle="modal" data-target="<?php echo '#modal_'.$menu->menuID ?>" src="<?php echo base_url()?>assets/icon_edit.png"/></a>
                            <a data-toggle="collapse" data-parent="#accordion" href="<?php echo "#collapse_".$menu->menuID; ?>" aria-controls="<?php echo "collapse_".$menu->menuID; ?>">
                              <?php echo $menu->groupName?>
                            </a>
                          </h4>
                        </div>
                        <div id="<?php echo "collapse_".$menu->menuID; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo "heading_".$menu->menuID; ?>">
                          <div class="panel-body">
                            <table class="table table-bordered">
                                <tr id="tbl_header">
                                    <td><b>Title</b></td>
                                    <td><b>Description</b></td>
                                    <td><b>Price</b></td>
                                    <td><b>Image</b></td>
                                    <td><b>Function</b></td>
                                </tr>
                           <?php $listItem = $menu->listItem ; for($j=0;$j<sizeof($listItem);$j++){ $item = $listItem[$j];?>
                                <tr>
                                    <td><?php echo $item->title ?></td>
                                    <td><?php echo $item->description ?></td>
                                    <td><?php echo $item->price;?></td>
                                    <td style="text-align: center;"><img width="40" height="40" src="<?php echo base_url().$item->image;?>" /></td>
                                     <td style="text-align: center;">
                                        <a href="<?php echo base_url().'partner/updateitem/'.$item->itemID;?>"><img src="<?php echo base_url()?>assets/icon_edit.png"/></a>
                                        <a href="#"><img data-toggle="modal" data-target="#myModalDelItem" onclick="confirmDeleteItem(<?php echo $item->itemID ?>)" style="padding-right: 10px;"src="<?php echo base_url()?>assets/icon_delete.png"/></a>
                                    </td>
                                </tr>
                           <?php  } ?>
                           </table>
                          </div>
                        </div>
 <div class="modal fade" id="<?php echo 'modal_'.$menu->menuID ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Change menu group</h4>
        </div>
        <form role="form" method="post" action="<?php echo base_url().'partner/verifypartner/editmenugroup'?>">
      <div class="modal-body" >
        <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control" name="groupName" value="<?php echo $menu->groupName?>" required>
        </div>
      </div>
      <div class="modal-footer" style="text-align: center;">
      <input type="hidden" name="menuID" value="<?php echo $menu->menuID; ?>" />                            
        <button type="submit" class="btn submit">Change</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      </form> 
    </div>
  </div>
</div>
                      </div>                    
                
                    <?php }} ?>
                </div>   
                </td>
            </tr>
       </table>
       <?php } else {?>
            <p style="text-align: center;"><a href="<?php echo base_url().'partner/addbusiness' ?>"><button class="btn submit">Create business</button></a></p>
       <?php } ?>
    </div>
    <div class="row" id="content-bottom">
        <?php 
            if($listMenu != null){
                if(sizeof($listMenu)%8 != 0){
                     $tmp = 1 + sizeof($listMenu)/8;
                     $numberpage = (int)$tmp;
                }else{
                     $tmp = sizeof($listMenu)/8;
                     $numberpage = (int)$tmp;
                }
                if($numberpage >= 5){
                    if($page <= 5){
                        $minpage = 1;
                        $maxpage = 5;
                    }else if($page >= $numberpage-2){
                        $minpage = $numberpage-4;
                        $maxpage = $numberpage;
                    }else{
                        $minpage = $page - 2;
                        $maxpage = $page + 2;
                    }            
                }else{
                    $minpage = 1;
                    $maxpage = $numberpage;
                }
            }else{
                $minpage = 1;
                $maxpage = 1;
                $numberpage = 0;
            }
           
            
        ?>
        <nav>
          <ul class="pagination">
            <li <?php $back = $page - 1; if($back == 0) echo "class='disabled'"; ?>><?php if($back > 0){ echo "<a href='".base_url().'partner/partnerdetail?page='.$back."'>";}?><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_back.png';?>" /></span><?php if($back > 0){ echo "</a>";} ?></li>
            <?php for($j = $minpage;$j<$maxpage+1;$j++){ ?>
            <li <?php if($j == $page)  echo "class='active'";?>><a href="<?php echo base_url().'partner/partnerdetail?page='.$j ; ?>"><?php echo $j; ?></a></li>
            <?php } ?>
            <li <?php $next = $page+1; if($next > $numberpage) echo "class='disabled'"; ?>><?php if($next <= $numberpage){ echo "<a href='".base_url().'partner/partnerdetail?page='.$next."'>";}?><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_next.png';?>" /></span><?php if($next <= $numberpage){ echo "</a>";} ?></li>
          </ul>
        </nav>
    </div> 
       <!-- Modal config delete item -->
        <div class="modal fade" id="myModalDelItem" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body" style="text-align: center;">
               <p><h3>Are you sure want to delele this item ?</h3></p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                <a id="delete_item_confirm" href="#"><button type="button" class="btn submit">YES</button></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
              </div>
            </div>
          </div>
        </div> 
    <!-- Modal -->
    <?php if($business != null) { ?>
        <div class="modal fade" id="modalMenuItem" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new menu group</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url().'partner/verifypartner/insertmenugroup'?>">
              <div class="modal-body" >
                <div class="form-group">
                    <label>Group Name</label>
                    <input type="text" class="form-control" name="groupName" placeholder="Group Name" required>
                </div>
              </div>
              <div class="modal-footer" style="text-align: center;">
              <input type="hidden" name="businessID" value="<?php echo $business->businessID; ?>" />
              <input type="hidden" name="partnerID" value="<?php echo $partner->partnerID; ?>" />                            
                <button type="submit" class="btn submit">Create</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
              </form> 
            </div>
          </div>
        </div>
    <?php } ?>                       
</div>      