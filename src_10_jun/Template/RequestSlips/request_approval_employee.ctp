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
                <label> Transfer Slip Details For Approval</label>
                <!-- <div class="box-tools pull-right">
                    <div style="font-size:19px;  margin-top: 6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></div>
                </div> -->
            </div><hr>
            <div class="box-body">
                <div  class="row" >
                        <div class="col-md-12">
                             <?= $this->Form->create($po_data,['autocomplete'=>'off','type'=>'get']) ?>
                                <div class="row">
                                    
                                    <div class="col-sm-4">
                                        <label class="control-label"> Select Employee</label>
                                        <?php echo $this->Form->control('data[created_by]', ['options' =>$employees, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="control-lable"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date >=']])?>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="control-lable"> Date To </label>
                                        <?= $this->Form->control('data[transaction_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date <=']])?>
                                    </div>
                                     <div class="col-sm-2">
                                        <label class="control-label"> Select Status</label>
                                        <?php echo $this->Form->control('data[emp_approve_flag]', ['options' =>$status, 'empty' =>'--Select--','label'=>false,'class'=>'form-control','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-sm-1">
                                       <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                                    </div>
                                    <div class="col-sm-1">
                                       <?= $this->Html->link(__('RESET'), ['action' => 'requestApprovalEmployee'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                </div>
                                <?= $this->Form->end(); ?>
                            </div>
                    </div><br></br>
                <?php if($data_exist=='data_exist') { ?>
                <div class="form-group">
                   <?php //$page_no=$this->Paginator->current('ReturnSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Transfer By') ?></th>
                                <th scope="col"><?= ('Voucher No') ?></th>
                                <th scope="col"><?= ('Transaction Date') ?></th>
                                <th scope="col"><?= ('Transfer To') ?></th>
                                <th scope="col"><?= ('Status') ?></th>
                                <th scope="col"><?= ('Admin Status') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($materialTransfers as $returnSlip): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($returnSlip->creater->name) ?></td>
                                <td><?= 'MT-'.h($returnSlip->voucher_no) ?></td>
                                <td><?= h($returnSlip->transaction_date) ?></td>
                                <td><?= h($returnSlip->employee->name) ?></td>
                                <td>
                                  <?php if($returnSlip->emp_approve_flag=='3') { ?> 
                                    <b> Pending </b>
                                  <?php } ?>
                                   <?php if($returnSlip->emp_approve_flag=='1') { ?> 
                                    <b> Approved </b>
                                  <?php } ?>
                                   <?php if($returnSlip->emp_approve_flag=='2') { ?> 
                                    <b> Rejected </b>
                                  <?php } ?>
                                </td>
                                <td>
                                  <?php if($returnSlip->admin_approve_flag=='3') { ?> 
                                    <b> Pending </b>
                                  <?php } ?>
                                   <?php if($returnSlip->admin_approve_flag=='1') { ?> 
                                    <b> Approved </b>
                                  <?php } ?>
                                   <?php if($returnSlip->admin_approve_flag=='2') { ?> 
                                    <b> Rejected </b>
                                  <?php } ?>
                                </td>
                                <td class="actions" style="width: 15%;">
                                    <a href="#myModal<?php echo $returnSlip->id ;?>" class="btn btn-primary editbtn " data-toggle="modal" style="background-color: #1295AB!important;" /><i class="fa fa-eye"></i> 
                                    </a>
                                    <?php if(($returnSlip->emp_approve_flag=='3') && ($returnSlip->admin_approve_flag=='3'))
                                    { ?> 
                                    <a href="#approve<?php echo $returnSlip->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /><i class="fa fa-check"></i> 
                                    </a> 
                                    <a href="#reject<?php echo $returnSlip->id ;?>" class="btn btn-info btnView " data-toggle="modal" /><i class="fa fa-close"></i> 
                                    </a> 
                                    <?php } ?>
                                      <?php if(($returnSlip->emp_approve_flag=='1') && ($returnSlip->admin_approve_flag=='3'))
                                    { ?> 

                                       <a href="#reject<?php echo $returnSlip->id ;?>" class="btn btn-info btnView " data-toggle="modal" /><i class="fa fa-close"></i> 
                                      </a> 
                                      <?php } ?>

                                        <?php if(($returnSlip->emp_approve_flag=='2') && ($returnSlip->admin_approve_flag=='3'))
                                    { ?> 
                                          <a href="#approve<?php echo $returnSlip->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /><i class="fa fa-check"></i> 
                                          </a> 
                                      <?php } ?>

                                    <!-- ------------ Approve Modal Start--------------------- -->
                                        <div id="approve<?php echo $returnSlip->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                 <h4 class="modal-title">  Are you sure, you want to approve this request slip ?</h4>
                                              </div>
                                              <div class="modal-body">
                                              <label> Comment : </label>
                                                <?php 
                                                 echo $this->Form->control('approve_comment',[
                                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter comment','type'=>'textarea','rows'=>'3','style'=>'resize:none;']);
                                                  ?>
                                                <?php echo $this->Form->hidden('accept_request_id',[
                                                  'value'=>$returnSlip->id]);?>
                                                 
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
                                    <!-- ------------ Approve Modal End--------------------- -->

                                    <!-- ------------ Reject Modal  Start--------------------- -->
                                        <div id="reject<?php echo $returnSlip->id ;?>" class="modal fade" role="dialog">
                                           <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                               <h4 class="modal-title">
                                                  Are you sure, you want to reject this request slip ?
                                                </h4>
                                              </div>
                                              <div class="modal-body">
                                                <label> Comment : </label>
                                                <?php 
                                                 echo $this->Form->control('reject_comment',[
                                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter comment','type'=>'textarea','rows'=>'3','style'=>'resize:none;']);
                                                  ?>
                                                <?php echo $this->Form->hidden('reject_request_id',[
                                                  'value'=>$returnSlip->id]);?>
                                                 
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


                                    <div id="myModal<?php echo $returnSlip->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Material Transfer Slip ( <?= 'MT-'.h($returnSlip->voucher_no) ?> ) Details </h4>
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
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j=1; foreach ($returnSlip->request_slip_rows as $return_row){ ?>
                                                            <tr>
                                                                <td><?php echo  $j; ?></td>
                                                                <td><?php echo $return_row->row_material->name ;?></td>
                                                                <td><?php echo $return_row->quantity ;?></td> 
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
                                </td>
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--  <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div> -->
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