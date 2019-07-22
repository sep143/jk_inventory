<style type="text/css">

  .btnreject{
    border-radius: 5px !important;
    background-color: #1295AB  ! important;
    border: none !important;
    padding: 3px 5px 5px 5px !important;
    margin-right: 2px;
    margin-top: 2px;
    width:30px;
    height: 26px !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Purchase Order Approval</label>
                 <!-- <div class="box-tools pull-right">
                    <div style="font-size:19px;  margin-top: 6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></div>
                </div> -->
            </div><hr>
            <div class="box-body">
                <div  class="row " >
                        <div class="col-md-12">
                             <?= $this->Form->create($po_data,['autocomplete'=>'off','type'=>'get']) ?>
                                <div class="row">
                                     <div class="col-sm-4">
                                        <label class="control-label"> Select Vendor</label>
                                        <?php echo $this->Form->control('data[vendor_id]', ['options' =>$vendors, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date >=']])?>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('data[transaction_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date <=']])?>
                                    </div>
                                    <div class="col-sm-1">
                                         <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                                    </div>
                                    <div class="col-md-1">
                                        <?= $this->Html->link(__('RESET'), ['action' => 'poApproval'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;color:white;']) ?>
                                    </div>
                                </div>
                               <!--  <div class="row">
                                    <div class="col-md-12 text-center">
                                      
                                    </div>
                                </div> -->
                                <?= $this->Form->end(); ?>
                            </div>
                    </div><br></br>
                <?php if($data_exist=='data_exist') { ?>
                <div class="form-group">
                   <?php //$page_no=$this->Paginator->current('PurchaseOrders'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Vendor') ?></th>
                                <th scope="col"><?= ('voucher_no') ?></th>
                                <th scope="col"><?= ('Order Date') ?></th>
                                <th scope="col"><?= ('Total Amount') ?></th>
                                <th scope="col"><?= ('Delivery Date') ?></th>
                                <th scope="col"><?= ('Status') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($purchaseOrders as $purchaseOrder): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($purchaseOrder->vendor->name) ?></td>
                                <td><?= 'PO-'.h($purchaseOrder->voucher_no) ?></td>
                                <td><?= h($purchaseOrder->transaction_date) ?></td>
                                <td><?= h($purchaseOrder->total) ?></td>
                                <td><?= h($purchaseOrder->delivery_date) ?></td>
                                <td>
                                     <?php
                                        if($purchaseOrder->approve_flag=='0') { ?>

                                            <b> Pending </b>

                                        <?php } else if($purchaseOrder->approve_flag=='1') {  ?>
                                            <b> Approved </b>
                                        <?php } else {  ?>
                                            <b> Rejected</b>
                                        <?php } ?>

                                </td>
                                <td class="actions">

                                    <a href="#myModal<?php echo $purchaseOrder->id ;?>" class="btn btn-danger btnView" data-toggle="modal" /><i class="fa fa-eye"></i> </a>

                                      <?php
                                        if($purchaseOrder->approve_flag=='0') { ?>
                                          <a href="#approve<?php echo $purchaseOrder->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> <i class="fa fa-check"></i></a>
                                          <a href="#reject<?php echo $purchaseOrder->id ;?>" class="btn btn-danger btnreject " data-toggle="modal" /> <i class="fa fa-times"></i></a>
                                       <?php } ?>

                                        <?php
                                        if($purchaseOrder->approve_flag=='2') { ?>
                                          <a href="#approve<?php echo $purchaseOrder->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> <i class="fa fa-check"></i></a>
                                       <?php } ?>

                                        <?php
                                        if($purchaseOrder->approve_flag=='1') { ?>
                                          <a href="#reject<?php echo $purchaseOrder->id ;?>" class="btn btn-info btnreject " data-toggle="modal" /> <i class="fa fa-times"></i></a>
                                       <?php } ?>

                                       <!-- ------------ Approve Modal  Start--------------------- -->
                                        <div id="approve<?php echo $purchaseOrder->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">  Are you sure, you want to approve this purchase order ?</h4>
                                              </div>
                                              <div class="modal-body">
                                              <label> Comment : </label>
                                                <?php 
                                                 echo $this->Form->control('approve_comment',[
                                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter comment','type'=>'textarea','rows'=>'3','style'=>'resize:none;']);
                                                  ?>
                                                <?php echo $this->Form->hidden('accept_request_id',[
                                                  'value'=>$purchaseOrder->id]);?>
                                                 
                                              </div>
                                              <div class="modal-footer">
                                              <?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                                <?= $this->Form->unlockField('accept_request_id') ;?>
                                              <?= $this->Form->end() ?>
                                            </div>
                                        </div>
                                    </div>      
                                    <!-- ------------ Approve Modal  End--------------------- -->

                                    <!-- ------------ Reject Modal  Start--------------------- -->
                                        <div id="reject<?php echo $purchaseOrder->id ;?>" class="modal fade" role="dialog">
                                           <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">
                                                  Are you sure, you want to reject this purchase order ?
                                                </h4>
                                              </div>
                                              <div class="modal-body">
                                                <label> Reject Reason : </label>
                                                <?php echo $this->Form->control('reject_comment',[
                                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter reason','type'=>'textarea','rows'=>'3','style'=>'resize:none;']);
                                                ?>
                                                <?php echo $this->Form->hidden('reject_request_id',[
                                                  'value'=>$purchaseOrder->id]);?>
                                                 
                                              </div>
                                              <div class="modal-footer">
                                              <?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                                <?= $this->Form->unlockField('reject_request_id') ;?>
                                              <?= $this->Form->end() ?>
                                            </div>
                                        </div>
                                    </div>      
                                    <!-- ------------ Reject Modal  End--------------------- ---->



                                    <div id="myModal<?php echo $purchaseOrder->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Purchase Order Details </h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table cellpadding="0" cellspacing="0" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?= ('Sr.No') ?></th>
                                                                <th scope="col"><?= ('Material') ?></th>
                                                                <th scope="col"><?= ('Quantity') ?></th>
                                                                <th scope="col"><?= ('Rate') ?></th>
                                                                <th scope="col"><?= ('Total') ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j=1; foreach ($purchaseOrder->purchase_order_rows as $purchaseOrderrow){ ?>
                                                            <tr>
                                                                <td><?php echo  $j; ?></td>
                                                                <td><?php echo $purchaseOrderrow->row_material->name ;?></td>
                                                                <td><?php echo $purchaseOrderrow->quantity ;?></td>
                                                                <td><?php echo $purchaseOrderrow->rate; ?> &#8377;</td>
                                                                <td><?php echo $purchaseOrderrow->amount; ?> &#8377;</td>
                                                            </tr>
                                                             <?php $j++; } ?>
                                                        </tbody>
                                                    </table>
                                                    <table class="table" style=" box-shadow: 0 0 0px #969b9e8a !important; ">
                                                            <tr>
                                                                <td><label> Discount Percentage :</label></td>
                                                                <td><label><?= $purchaseOrder->discount_per ?> %</label></td>
                                                                <td><label>P/F Charges :</label></td>
                                                                <td><label><?= $purchaseOrder->packing_forwarding_charges ?>  &#8377;</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>GST Charges :</label></td>
                                                                <td><label><?= $purchaseOrder->gst_charges ?>  &#8377;</label></td>
                                                                <td><label> Payment Terms :</label></td>
                                                                <td><label><?= $purchaseOrder->payment_terms ?>  </label></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                 
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
             <div class="box-footer">
                <?php echo $this->element('pagination') ?> 
            </div> 
        <?php } else { ?>
             <div class="row">
                <div class="col-md-12 text-center">
                    <h3> <?= $data_exist ?></h3>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 