 <?php
    if(!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }
 ?>
 <script>
    function confirmDeletePartner(idPartner){
        var url = "<?php echo base_url().'admin/verifypartner/deletepartner/'?>"+idPartner;
        $("#delete_confirm_partner").attr('href', url);
    }
 </script>
 <div class="col-md-12" id="content">
    <div class="row" id="content-top">
        <div class="col-md-8" style="padding: 0px;">
            <p style="color: #4dd6ce;"><b>Partner</b></p>
        </div>
        <div class="col-md-4" style="padding: 0px;">
            <p style="color: #4dd6ce; text-align: right;">New partner  <a href="<?php echo base_url().'admin/addpartner?tab_active=1' ?>"><img src="<?php echo base_url() ?>assets/icon_add_new.png"/></a></p>
        </div>
    </div> 
    <div class="row">
    <div class="col-md-9">
        <p style="color: #797979;"><b>All partner</b></p>
    </div>
    <div class="col-md-3" id="div_search">
		<form role="form" method="get" action="<?php echo base_url().'admin' ;?>">
       <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><img src="<?php echo base_url() ?>assets/icon_search.png"/></div>
              <input type="text" class="form-control" name="pa_keyword" id="pa_name_keyword" placeholder="Search" >
              <div class="input-group-addon" id="pa_del_search"></div>
            </div>
        </div>
		</form>
    </div>        
    </div> 
    <div class="row" id="content-mid">
       <table class="table table-bordered">
            <tr id="tbl_header">
                <td><b>ID</b></td>
                <td><b>partner Name</b></td>
                <td><b>Email</b></td>                
                <td><b>Phone Number</b></td>
                <td><b>Address</b></td>
                <td><b>Avatar</b></td>
                <td><b>Details</b></td>
                <td><b>Funtions</b></td>
            </tr>
       <?php for($i=8*($page-1);$i<sizeof($partner);$i++){ if($i == 8*$page){ break;} $row = $partner[$i];?>
            <tr>
                <td><?php echo $row->partnerID?></td>
                <td><?php echo $row->firstName.' '.$row->lastName;?></td>
                <td><?php echo $row->email;?></td>
                <td><?php echo $row->phone;?></td>
                <td><?php echo $row->address;?></td>                
                <td style="text-align: center;"><img width="40" height="40" src="<?php if($row->image != null && $row->image != ''){echo base_url().$row->image;} else { echo  base_url().'image/default.jpg' ;}?>" /></td>
                <td style="text-align: center;"><a href="<?php echo base_url().'admin/partner/'.$row->partnerID;?>"><button class="btn">View</button></a></td>
                <td style="text-align: center;letter-spacing: 10px;">
                        <a href="#"><img data-toggle="modal" data-target="#modalConfirmPartner" onclick="confirmDeletePartner(<?php echo $row->partnerID ?>)" src="<?php echo base_url()?>assets/icon_delete.png"/></a>
                        <a href="<?php echo base_url().'admin/editpartner/'.$row->partnerID;?>"><img src="<?php echo base_url()?>assets/icon_edit.png"/></a></td>
            </tr>
       <?php  } ?>
       </table>
    </div>
    <div class="row" id="content-bottom">
        <?php 
           
            if(sizeof($partner)%8 != 0){
                 $tmp = 1 + sizeof($partner)/8;
                 $numerpage = (int)$tmp;
            }else{
                 $tmp = sizeof($partner)/8;
                 $numerpage = (int)$tmp;
            }
            if($numerpage >= 5){
                if($page <= 5){
                    $minpage = 1;
                    $maxpage = 5;
                }else if($page >= $numerpage){
                    $minpage = $numerpage-4;
                    $maxpage = $numerpage;
                }else{
                    $minpage = $page - 2;
                    $maxpage = $page + 2;
                }            
            }else{
                $minpage = 1;
                $maxpage = $numerpage;
            }
        ?>
        <nav>
          <ul class="pagination">
            <li <?php $back = $page - 1; if($back == 0) echo "class='disabled'"; ?>><?php if($back > 0){ if(!isset($_GET['pa_keyword'])){ echo "<a href='".base_url().'admin?tab_active=0&page='.$back."'";} else {echo "<a href='".base_url().'admin?tab_active=0&page='.$back."&pa_keyword=".$_GET['pa_keyword']."'";} }?><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_back.png';?>" /></span><?php if($back > 0){ echo "</a>";} ?></li>
            <?php for($j = $minpage;$j<$maxpage+1;$j++){ ?>
            <li <?php if($j == $page)  echo "class='active'";?>><a href="<?php if(!isset($_GET['pa_keyword'])) { echo base_url().'admin?tab_active=0&page='.$j ;} else { echo base_url().'admin?tab_active=0&page='.$j.'&pa_keyword='.$_GET['pa_keyword'] ;} ?>"><?php echo $j; ?></a></li>
            <?php } ?>
            <li <?php $next = $page+1; if($next > $numerpage) echo "class='disabled'"; ?>><?php if($next <= $numerpage){ if(!isset($_GET['pa_keyword'])){ echo "<a href='".base_url().'admin?tab_active=0&page='.$next."'";} else {echo "<a href='".base_url().'admin?tab_active=0&page='.$next."&pa_keyword=".$_GET['pa_keyword']."'";} }?><span aria-hidden="true"><img src="<?php echo base_url().'assets/arrow_page_next.png';?>" /></span><?php if($next <= $numerpage){ echo "</a>";} ?></li>
          </ul>
        </nav>
    </div> 

        <!-- Modal -->
        <div class="modal fade" id="modalConfirmPartner" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body" style="text-align: center;">
               <p><h3>Are you sure want to delele this partner ?</h3></p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                <a id="delete_confirm_partner" href="#"><button type="button" class="btn submit">YES</button></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
              </div>
            </div>
          </div>
        </div>

                     
</div>      