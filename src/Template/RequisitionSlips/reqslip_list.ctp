<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Requisition Slip For PO</label>
                </div><hr>
            <div class="box-body">
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('RequisitionSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>

                                <th scope="col"><?= ('Select') ?></th>
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
                                <td><label>
                                    <?= $this->Form->checkbox('requisition_slip_id[]',['value'=>$requisitionSlip->id,'hiddenField'=>false,'class'=>'menu_check']) ?></label>
                                </td>  
                                <td><?php echo $i; ?></td>  
                                <td><?= h($requisitionSlip->creater->name) ?></td>
                                <td><?= 'RS-'.h($requisitionSlip->voucher_no) ?></td>
                                <td><?= h($requisitionSlip->transaction_date) ?></td>
                                <td><?= h($requisitionSlip->status) ?></td>
                                <td><?= h(@$requisitionSlip->approver->name) ?></td>
                                <td><?= h(@$requisitionSlip->approved_on) ?></td>
                                <td class="actions">
                                    <?php if($requisitionSlip->status!='Approved') { ?> 
                                        <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($requisitionSlip->id)],['class'=>'btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit Requisition Slip', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Requisition Slip']) ?> 
                                    <?php } ?>
                                    <a href="#myModal<?php echo $requisitionSlip->id ;?>" class="btn btn-danger btnView" data-toggle="modal" /><i class="fa fa-eye"></i> </a>

                                    <div id="myModal<?php echo $requisitionSlip->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Requisition Slip Details </h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table" style="width:100%;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?= ('S.No.') ?></th>
                                                                <th scope="col"><?= ('Raw Material') ?></th>
                                                                <th scope="col"><?= ('Quantity') ?></th>
                                                                <th scope="col" class="actions"><?= __('Description') ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j=1; foreach ($requisitionSlip->requisition_slip_rows as $requisitionSliprow){ ?>
                                                            <tr>
                                                                <td style="width:10%;"><?php echo  $j; ?></td>
                                                                <td style="width:25%;"><?php echo $requisitionSliprow->row_material->name ;?>
                                                                </td>
                                                                <td style="width:15%;"><?php echo $requisitionSliprow->quantity ;?>
                                                                </td>
                                                                <td style="width:45%;"><?php echo $requisitionSliprow->description; ?></td>
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
            <div class="box-footer">
                <?php echo $this->element('pagination') ?> 
            </div> 
        </div>
    </div>
</div>
 <?= $this->element('selectpicker') ?> 
 <?= $this->element('datepicker') ?> 