
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Purchase Order List For GRN</label>
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
                                        <?= $this->Html->link(__('RESET'), ['action' => 'poList'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;color:white;']) ?>
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
                                <th scope="col"><?= ('Delivered To ') ?></th>
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
                                <td><?= h($purchaseOrder->delivery_location) ?></td>
                                <td class="actions">
                                        <?= $this->Html->link(__('Convert To GRN '), ['controller'=>'GoodReceiveNotes','action' => 'add', $EncryptingDecrypting->encryptData($purchaseOrder->id)],['class'=>'btn btn-primary  btn-xs','escape'=>false, 'data-widget'=>'Create GRN', 'data-toggle'=>'tooltip', 'data-original-title'=>'Create GRN']) ?> 
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