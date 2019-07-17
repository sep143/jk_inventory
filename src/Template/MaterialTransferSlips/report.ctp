
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label>Material Transfer Report</label>
                <!-- <div class="box-tools pull-right">
                    <div style="font-size:19px;  margin-top: 6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></div>
                </div> -->
            </div><hr>
            <div class="box-body">
                <div  class="row" >
                        <div class="col-md-12">
                             <?= $this->Form->create($po_data,['autocomplete'=>'off','type'=>'get']) ?>
                                <div class="row">
                                     <div class="col-sm-3">
                                        <label class="control-label"> Transfer To</label>
                                        <?php echo $this->Form->control('data[employee_id]', ['options' =>$employees, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div> 
                                    <div class="col-sm-3">
                                        <label class="control-label"> Transfer By</label>
                                        <?php echo $this->Form->control('data[created_by]', ['options' =>$creaters, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="control-lable"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date >=']])?>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="control-lable"> Date To </label>
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
                   <?php //$page_no=$this->Paginator->current('ReturnSlips'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('Transfer By') ?></th>
                                <th scope="col"><?= ('Voucher No') ?></th>
                                <th scope="col"><?= ('Transaction Date') ?></th>
                                <th scope="col"><?= ('Transfer To') ?></th>
                                <th scope="col"><?= ('Action') ?></th>
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
                                <td class="actions">
                                    <a href="#myModal<?php echo $returnSlip->id ;?>" class="btn btn-danger btnView" data-toggle="modal" /><i class="fa fa-eye"></i> </a>
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
                                                                <th scope="col"><?= $this->Paginator->sort('Raw Material') ?></th>
                                                                <th scope="col"><?= $this->Paginator->sort('Quantity') ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $j=1; foreach ($returnSlip->material_transfer_slip_rows as $return_row){ ?>
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