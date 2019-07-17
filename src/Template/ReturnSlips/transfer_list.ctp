
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Return Slip Details</label>
                <div class="box-tools pull-right">
                    <div style="font-size:19px;  margin-top: 6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></div>
                </div>
            </div><hr>
            <div class="box-body">
                <div  class="row collapse"  id="myModal122" aria-expanded="false">
                        <div class="col-md-12">
                            <div class="box-header with-border">
                             <?= $this->Form->create($return_data,['autocomplete'=>'off']) ?>
                                <div class="row">
                                     <div class="col-sm-4">
                                        <label class="control-label"> Select Employee</label>
                                        <?php echo $this->Form->control('data[employee_id]', ['options' =>$employees, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="control-lable"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['in_date >=']])?>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="control-lable"> Date To </label>
                                        <?= $this->Form->control('data[transaction_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['in_date <=']])?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                       <?= $this->Form->submit('search',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                                    </div>
                                </div>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($returnSlips)) { ?>
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('ReturnSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Voucher No') ?></th>
                                <th scope="col"><?= ('Return From') ?></th>
                                <th scope="col"><?= ('Return Date') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($returnSlips as $returnSlip): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?= 'RS-'.h($returnSlip->voucher_no) ?></td>
                                <td><?= h($returnSlip->employee->name) ?></td>
                                <td><?= h($returnSlip->transaction_date) ?></td>
                                <td class="actions">
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $EncryptingDecrypting->encryptData($returnSlip->id)],['class'=>'btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit Return Slip', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Return Slip']) ?> 
                                          <a href="#myModal<?php echo $returnSlip->id ;?>" class="btn btn-danger editbtn" data-toggle="modal" /> View</a>
                                        <div id="myModal<?php echo $returnSlip->id ;?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Return Slip Details </h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table cellpadding="0" cellspacing="0" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?= $this->Paginator->sort('Sr.No') ?></th>
                                                                <th scope="col"><?= $this->Paginator->sort('Raw Material') ?></th>
                                                                <th scope="col"><?= $this->Paginator->sort('Quantity') ?></th>
                                                                <th scope="col"><?= $this->Paginator->sort('Status') ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j=1; foreach ($returnSlip->return_slip_rows as $return_row){ ?>
                                                            <tr>
                                                                <td><?php echo  $j; ?></td>
                                                                <td><?php echo $return_row->row_material->name ;?></td>
                                                                <td><?php echo $return_row->quantity ;?></td> 
                                                                <td><?php echo $return_row->return_scrab ;?></td>
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
                <?= $this->element('pagination') ?> 
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 