 <!-- <li class=" <?= (@$active_li=='Dashboard')?'active':'' ?>">
    <a href="<?=$this->Url->build(['controller'=>'Employees','action'=>'dashboard'])?>">
        <!-- i class="fa fa-dashboard"></i>  -->
        <?= $this->Html->image('/img/Username.png',['style'=> '
        width: 14%;']); ?>
        <span>Dashboard</span>
    </a>
</li>
<?php if(($role_id=='5') || ($role_id=='1'))  { ?>
<li class="treeview <?= (@$active_li=='Settings')?'active':'' ?>">
    <a href="#">
        <?= $this->Html->image('/img/Master.png',['style'=> '
        width: 14%;']); ?>
        <span> Masters</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="<?= (@$active_sub_li=='Roles')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Roles','action' =>'index'])?>"> Roles</a></li>
        <li class="<?= (@$active_sub_li=='Departments')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Departments','action' =>'index'])?>"> Departments</a></li>
        <li class="<?= (@$active_sub_li=='Units')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Units','action' =>'index'])?>"> Units</a></li>
        <li class="<?= (@$active_sub_li=='Vendors')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Vendors','action' =>'index'])?>">Vendors</a></li> 
        <li class="<?= (@$active_sub_li=='RowMaterialCategories')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'RowMaterialCategories','action' =>'index'])?>"> RM Category</a></li>
        <li class="<?= (@$active_sub_li=='RowMaterials')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'RowMaterials','action' =>'index'])?>"> Materials</a></li>
    </ul>
</li>
    <li class="treeview">
            <a href="#"><?= $this->Html->image('/img/Employee.png',['style'=> '
        width: 14%;']); ?>
         <span> Employees</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="<?= (@$active_sub_li=='Employees')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Employees','action' =>'add'])?>"><i class="fa fa-plus"></i> Add</a></li>  
                <li class="<?= (@$active_sub_li=='Employees')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Employees','action' =>'index'])?>"><i class="fa fa-eye"></i> View</a></li> 

            </ul>
        </li>
<?php } ?>
 <?php if(($role_id=='5') || ($role_id=='4'))  { ?>
        <li class="treeview">
            <a href="#">
                <?= $this->Html->image('/img/Requistion Slip.png',['style'=> 'width: 14%;']); ?>
                <span> Requisition Slips</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="<?= (@$active_sub_li=='RequisitionSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'RequisitionSlips','action' =>'add'])?>"><i class="fa fa-plus"></i> Add</a></li>  
                <li class="<?= (@$active_sub_li=='RequisitionSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'RequisitionSlips','action' =>'index'])?>"><i class="fa fa-eye"></i> View</a></li> 
            </ul>
        </li>
    <?php } ?>
    <?php if(($role_id=='5') || ($role_id=='1'))  { ?>
        <li class="treeview">
            <a href="#"><?= $this->Html->image('/img/Purchase Order.png',['style'=> '
        width: 14%;']); ?> <span> Purchase Order</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="<?= (@$active_sub_li=='PurchaseOrders')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'PurchaseOrders','action' =>'add'])?>"><i class="fa fa-plus"></i> Add</a></li>  
                <li class="<?= (@$active_sub_li=='PurchaseOrders')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'PurchaseOrders','action' =>'index'])?>"><i class="fa fa-eye"></i> View</a></li> 
            </ul>
        </li> 
        <li class="treeview">
            <a href="#"><?= $this->Html->image('/img/GRN.png',['style'=> '
        width: 14%;']); ?> <span> GRN</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="<?= (@$active_sub_li=='PurchaseOrders')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'PurchaseOrders','action' =>'poList'])?>"><i class="fa fa-plus"></i> Create</a></li>  
                <li class="<?= (@$active_sub_li=='GoodReceiveNotes')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'GoodReceiveNotes','action' =>'index'])?>"><i class="fa fa-eye"></i> View</a></li> 
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
            <?= $this->Html->image('/img/Issue Slip.png',['style'=> '
            width: 14%;']); ?>
            <span> Issue Slips</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="<?= (@$active_sub_li=='IssueSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'IssueSlips','action' =>'add'])?>"><i class="fa fa-plus"></i> Create</a></li>  
                <li class="<?= (@$active_sub_li=='IssueSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'IssueSlips','action' =>'index'])?>"><i class="fa fa-eye"></i> View</a></li> 
            </ul>
        </li>
    <?php } ?>
     <?php if(($role_id=='5') || ($role_id=='1'))  { ?>
        <li class="treeview">
            <a href="#">
            <?= $this->Html->image('/img/Return Slip.png',['style'=> '
            width: 14%;']); ?>
             <span> Return Slips</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="<?= (@$active_sub_li=='ReturnSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'ReturnSlips','action' =>'add'])?>"><i class="fa fa-plus"></i> Create</a></li>  
                <li class="<?= (@$active_sub_li=='ReturnSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'ReturnSlips','action' =>'index'])?>"><i class="fa fa-eye"></i> View</a></li> 
            </ul>
        </li>
    <?php } ?>
      <?php if(($role_id=='5') || ($role_id=='4'))  { ?>
        <li class="treeview">
            <a href="#"><?= $this->Html->image('/img/Material Transfer.png',['style'=> '
        width: 14%;']); ?> <span> Material Transfer </span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="<?= (@$active_sub_li=='ReturnSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'MaterialTransferSlips','action' =>'add'])?>"><i class="fa fa-plus"></i> Create</a></li>  
                <li class="<?= (@$active_sub_li=='ReturnSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'MaterialTransferSlips','action' =>'index'])?>"><i class="fa fa-eye"></i> View</a></li> 
            </ul>
        </li>
    <?php if($role_id=='1') { ?>
     <li class="<?= (@$active_sub_li=='Employees')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Employees','action' =>'employeeStock'])?>"><i class="fa fa-shopping-cart"></i> Employee Stock</a></li> 

     <li class="<?= (@$active_sub_li=='Employees')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Employees','action' =>'itemConsumptions'])?>"><i class="fa fa-star"></i> Item Consumptions</a></li>
     <li class="<?= (@$active_sub_li=='Employees')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'MaterialTransferSlips','action' =>'transferItems'])?>"><i class="fa fa-exchange"></i> Transfered Stock </a>
     </li> 
    <?php } }?>
    <?php if($role_id=='5') { ?>
    <li class="<?= (@$active_sub_li=='Employees')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'Employees','action' =>'mainStock'])?>"><i class="fa fa-shopping-cart"></i> Main Stock</a></li> 
<?php } ?>
     <?php if(($role_id=='5') || ($role_id=='3'))  { ?>
        <li class="treeview">
            <a href="#"><?= $this->Html->image('/img/Approval.png',['style'=> '
        width: 14%;']); ?> <span> Approval </span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="<?= (@$active_sub_li=='RequisitionSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'RequisitionSlips','action' =>'reqListApproval'])?>">
                    <i class="fa fa-check"></i> Requisition Approval</a></li>  
               
                <li class="<?= (@$active_sub_li=='ReturnSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'ReturnSlips','action' =>'scrabApproval'])?>">
                    <i class="fa fa-check"></i> Scrap Approval</a></li>  
          </ul>
        </li>
    <?php } ?>
   <?php if(($role_id=='5') || ($role_id=='1') || ($role_id=='4'))  { ?>
         <li class="treeview">
            <a href="#"><?= $this->Html->image('/img/Reports.png',['style'=> '
        width: 14%;']); ?> <span> Reports </span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                 <li class="<?= (@$active_sub_li=='RequisitionSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'RequisitionSlips','action' =>'report'])?>">
                    <i class="fa fa-circle-o" style="font-size: 10px;"></i> Requisition Slips</a>
                </li>
                 <li class="<?= (@$active_sub_li=='IssueSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'IssueSlips','action' =>'report'])?>">
                    <i class="fa fa-circle-o" style="font-size: 10px;"></i> Issue Slips</a>
                </li>
                 <li class="<?= (@$active_sub_li=='RequisitionSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'MaterialTransferSlips','action' =>'report'])?>">
                    <i class="fa fa-circle-o" style="font-size: 10px;"></i> Material Transfer Slips</a>
                </li>
                <li class="<?= (@$active_sub_li=='ReturnSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'ReturnSlips','action' =>'report'])?>">
                    <i class="fa fa-circle-o" style="font-size: 10px;"></i> Return Slips</a>
                </li>
                <li class="<?= (@$active_sub_li=='ReturnSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'ReturnSlips','action' =>'scrabMaterialReport'])?>">
                    <i class="fa fa-circle-o" style="font-size: 10px;"></i> Scrap Material</a>
                </li>
                <li class="<?= (@$active_sub_li=='ReturnSlips')?'active':'' ?>"><a href="<?= $this->Url->build(['controller'=>'ReturnSlips','action' =>'disposedMaterialReport'])?>">
                    <i class="fa fa-circle-o" style="font-size: 10px;"></i> Disposed Material</a></li> 
                      
            </ul>
        </li>
    <?php } ?>
     <li style="padding-left: 30px;padding-top: 25px;">
        <a href="<?php echo $this->Url->build(["controller" => "Employees",'action'=>'logout']); ?>" class="" style="font-size:15px;width:80%;background-color:#00B17A;height:33px;border-radius:5px;padding-bottom: 25px;color:white;text-align:center;padding-top:5px;padding-left: 5px;"><i class="fa fa-sign-out"></i>Log out</a>
    </li>
</li>
 -->