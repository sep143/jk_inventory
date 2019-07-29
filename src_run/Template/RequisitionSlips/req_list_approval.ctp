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
                <label> Requisition Slip Approval</label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('RequisitionSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Sr.No') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Employee Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Status') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($requisitionSlips as $requisitionSlip): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= 'RS-'.h($requisitionSlip->voucher_no) ?></td>
                                <td><?= h($requisitionSlip->transaction_date) ?></td>
                                <td><?= h($requisitionSlip->creater->name) ?></td>
                                <td><?= h($requisitionSlip->status) ?></td>
                                <td style="width: 20%;" class="actions">
                                        <a href="#myModal<?php echo $requisitionSlip->id ;?>" class="btn btn-danger btnView" data-toggle="modal" /><i class="fa fa-eye"></i> </a>

                                        <?php if($requisitionSlip->status!='Approved') { ?> 
                                        <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'adminEdit', $EncryptingDecrypting->encryptData($requisitionSlip->id)],['class'=>'btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit Requisition Slip', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Requisition Slip','style'=>'background-color:#7A70A2 !important;']) ?> 
                                    <?php } ?>
                                        <?php
                                        if($requisitionSlip->status=='Pending') { ?>
                                          <a href="#approve<?php echo $requisitionSlip->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> <i class="fa fa-check"></i></a>
                                          <a href="#reject<?php echo $requisitionSlip->id ;?>" class="btn btn-danger btnreject " data-toggle="modal" /> <i class="fa fa-times"></i></a>
                                       <?php } ?>
                                       <?php
                                        if($requisitionSlip->status=='Rejected') { ?>
                                          <a href="#approve<?php echo $requisitionSlip->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> <i class="fa fa-check"></i></a>
                                       <?php } ?>

                                        <?php
                                        if($requisitionSlip->status=='Approved') { ?>
                                          <a href="#reject<?php echo $requisitionSlip->id ;?>" class="btn btn-info btnreject " data-toggle="modal" /> <i class="fa fa-times"></i></a>
                                       <?php } ?>

                                    <div id="myModal<?php echo $requisitionSlip->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Requisition Slip Details </h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table cellpadding="0" cellspacing="0" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?= $this->Paginator->sort('Sr.No') ?></th>
                                                                <th scope="col"><?= $this->Paginator->sort('Material') ?></th>
                                                                <th scope="col"><?= $this->Paginator->sort('Quantity') ?></th>
                                                                <th scope="col" class="actions"><?= __('Description') ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j=1; foreach ($requisitionSlip->requisition_slip_rows as $requisitionSliprow){ ?>
                                                            <tr>
                                                                <td><?php echo  $j; ?></td>
                                                                <td><?php echo $requisitionSliprow->row_material->name ;?></td>
                                                                <td><?php echo $requisitionSliprow->quantity ;?></td>
                                                                <td><?php echo $requisitionSliprow->description; ?></td>
                                                            </tr>
                                                             <?php $j++; } ?>
                                                        </tbody>
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

								                    <!-- ------------ Details Modal  Start--------------------- -->
                                        <div id="view" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Requisition Slip Details </h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table cellpadding="0" cellspacing="0" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?= $this->Paginator->sort('Sr.No') ?></th>
                                                                <th scope="col"><?= $this->Paginator->sort('Material') ?></th>
                                                                <th scope="col"><?= $this->Paginator->sort('Quantity') ?></th>
                                                                <th scope="col" class="actions"><?= __('Description') ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j=1; foreach ($requisitionSlip->requisition_slip_rows as $requisitionSliprow){ ?>
                                                            <tr>
                                                                <td><?php echo  $j; ?></td>
                                                                <td><?php echo $requisitionSliprow->row_material->name ;?></td>
                                                                <td><?php echo $requisitionSliprow->quantity ;?></td>
                                                                <td><?php echo $requisitionSliprow->description; ?></td>
                                                            </tr>
                                                             <?php $j++; } ?>
                                                        </tbody>
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
                                    <!-- ------------ Details Modal  End--------------------- -->

                                    <!-- ------------ Approve Modal  Start--------------------- -->
                                    	<div id="approve<?php echo $requisitionSlip->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">  Are you sure, you want to approve this requisition slip ?</h4>
                                              </div>
                                              <div class="modal-body">
                                              <label> Comment : </label>
                                                <?php 
                                                 echo $this->Form->control('approve_comment',[
                                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter comment','type'=>'textarea','required'=>'required','rows'=>'3','style'=>'resize:none;']);
                                                  ?>
                                                <?php echo $this->Form->hidden('accept_request_id',[
                                                  'value'=>$requisitionSlip->id]);?>
                                                 
                                              </div>
                                              <div class="modal-footer">
                                              <?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                                <?= $this->Form->unlockField('id') ;?>
                                              <?= $this->Form->end() ?>
                                            </div>
                                        </div>
                                    </div> 		
                                    <!-- ------------ Approve Modal  End--------------------- -->

                                    <!-- ------------ Reject Modal  Start--------------------- -->
                                        <div id="reject<?php echo $requisitionSlip->id ;?>" class="modal fade" role="dialog">
                                           <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">
                                                  Are you sure, you want to reject this requisition slip ?
                                                </h4>
                                              </div>
                                              <div class="modal-body">
                                                <label> Reject Reason : </label>
                                                <?php echo $this->Form->control('reject_comment',[
                                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter reason','type'=>'textarea','required'=>'required','rows'=>'3','style'=>'resize:none;']);
                                                ?>
                                                <?php echo $this->Form->hidden('reject_request_id',[
                                                  'value'=>$requisitionSlip->id]);?>
                                                 
                                              </div>
                                              <div class="modal-footer">
                                              <?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                                <?= $this->Form->unlockField('id') ;?>
                                              <?= $this->Form->end() ?>
                                            </div>
                                        </div>
                                    </div> 		
                                    <!-- ------------ Reject Modal  End--------------------- ---->
                                </td>
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
             <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
        </div>
    </div>
</div>
