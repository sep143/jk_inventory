
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Purchase Order Details</label>
            </div><hr>
            <div class="box-body">
                <div  class="row">
                        <div class="col-md-12">
                             <?= $this->Form->create($po_data,['autocomplete'=>'off','type'=>'get']) ?>
                                <div class="row">
                                     <div class="col-md-3">
                                        <label class="control-label"> Select Vendor</label>
                                        <?php echo $this->Form->control('data[vendor_id]', ['options' =>$vendors, 'empty' =>'Select Vendor','label'=>false,'class'=>'select2','style'=>'width:100%;',]);?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label"> Date From </label>
                                        <?= $this->Form->control('data[transaction_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date >=']])?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label"> Date To </label>
                                        <?= $this->Form->control('data[transaction_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['in_date <=']])?>
                                    </div>
                                    <div class="col-md-1">
                                         <?= $this->Form->submit('SEARCH',['class'=>'btn btn-info btnClass','style'=>'margin-top:28px;'])?>
                                    </div>
                                    <div class="col-md-1">
                                        <?= $this->Html->link(__('RESET'), ['action' => 'index'],['class'=>'btn btn-danger btnClass','escape'=>false, 'data-widget'=>'Reset', 'data-toggle'=>'tooltip', 'data-original-title'=>'Reset','style'=>'margin-top:28px;']) ?>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-3 text-center">
                                      
                                    </div>
                                </div> -->
                                <?= $this->Form->end(); ?>
                            </div>
                        </div><br></br>
                   <?php if($data_exist=='data_exist') { ?>
                <div class="form-group">
                   <?php $page_no=$this->Paginator->current('PurchaseOrders'); $page_no=($page_no-1)*20; ?>
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Sr.No') ?></th>
                                <th scope="col"><?= ('Vendor') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                                <th scope="col"><?= ('Order Date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Total Amount') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Delivery Date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Delivered To ') ?></th>
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
                                    <?php if (in_array($purchaseOrder->id, $po_grn_match_data)) { ?>
                                       
                                    <?php } else{ ?>
                                         <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($purchaseOrder->id)],['class'=>' btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit Purchase Order', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Purchase Order']) ?> 
                                    <?php } ?>
                                        &nbsp;
                                    <a href="#myModal<?php echo $purchaseOrder->id ;?>" class="btn btn-danger btnView" data-toggle="modal" /><i class="fa fa-eye"></i> </a>
                                    <?= $this->Html->link(__('<i class="fa fa-print"></i>'), ['action' => 'view', $EncryptingDecrypting->encryptData($purchaseOrder->id)],['class'=>' btn btn-info editbtn','escape'=>false, 'data-widget'=>'Print Purchase Order', 'data-toggle'=>'tooltip', 'data-original-title'=>'Print Purchase Order','style'=>'background-color:#1295AB!important;']) ?> 
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
                <?= $this->element('pagination') ?> 
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