
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Purchase Order Details</label>
            </div><hr>
            <div class="box-body">
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
                                        <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'edit', $EncryptingDecrypting->encryptData($purchaseOrder->id)],['class'=>'btn btn-info editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit Purchase Order', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Purchase Order']) ?> 
                                        <?php echo $this->Form->button('<i class="fa fa-eye"></i>',['class'=>'btn btn-warning editbtn btn-xs','data-toggle'=>'modal','data-target'=>'#myModal']); ?>
                                        <div id="myModal" class="modal fade" role="dialog">
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
                                                                <td><?php echo $purchaseOrderrow->rate; ?></td>
                                                                <td><?php echo $purchaseOrderrow->amount; ?></td>
                                                            </tr>
                                                             <?php $j++; } ?>
                                                        </tbody>
                                                    </table>
                                                    <table class="table">
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
        </div>
    </div>
</div>
