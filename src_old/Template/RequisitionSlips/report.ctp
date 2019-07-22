
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Requisition Slip Details</label>
                </div><hr>
            <div class="box-body">
                <div class="row">
                        <div class="col-md-12">
                             <?= $this->Form->create($requisition_data,['autocomplete'=>'off','type'=>'get']) ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label"> Employee</label>
                                        <?php echo $this->Form->control('data[created_by]', ['options' =>$empfff, 'empty' =>'Select Employee','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
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
                                    <div class="col-sm-1">
                                       <?= $this->Html->link(__('RESET'), ['action' => 'report'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                </div>
                                <?= $this->Form->end(); ?>
                            </div>
                    </div><br></br>
                <?php if($data_exist=='data_exist') { ?>
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('RequisitionSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Employee Name') ?></th>
                                <th scope="col"><?= ('Voucher No') ?></th>
                                <th scope="col"><?= ('Transaction Date') ?></th>
                                <th scope="col"><?= ('Approve Status') ?></th>
                                <th scope="col"><?= ('Approve By') ?></th>
                                <th scope="col"><?= ('Approve On') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($requisitionSlips as $requisitionSlip): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= h($requisitionSlip->creater->name) ?></td>
                                <td><?= 'RS-'.h($requisitionSlip->voucher_no) ?></td>
                                <td><?= h($requisitionSlip->transaction_date) ?></td>
                                <td><?= h($requisitionSlip->status) ?></td>
                                <td><?= h(@$requisitionSlip->approver->name) ?></td>
                                <td><?= h(@$requisitionSlip->approved_on) ?></td>
                              
                                <td class="actions">
                                    <a href="#myModal<?php echo $requisitionSlip->id ;?>" class="btn btn-danger btnView" data-toggle="modal" /><i class="fa fa-eye"></i> </a>
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
                                </td>
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
             <!-- <div class="box-footer">
                <?php // echo $this->element('pagination') ?> 
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