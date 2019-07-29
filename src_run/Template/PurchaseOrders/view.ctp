<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseOrder $purchaseOrder
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Purchase Order Details</label>
            </div>
                <table class="table">
                    <tr>
                        <th scope="row"><?= __('Vendor') ?> :</th>
                        <td><?= $purchaseOrder->has('vendor') ? $this->Html->link($purchaseOrder->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $purchaseOrder->vendor->id]) : '' ?></td>
                        <th scope="row"><?= __('Discount Per') ?> :</th>
                        <td><?= h($purchaseOrder->discount_per) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Packing Forwarding Charges') ?> :</th>
                        <td><?= h($purchaseOrder->packing_forwarding_charges) ?></td>
                        <th scope="row"><?= __('Delivery Location') ?> :</th>
                        <td><?= h($purchaseOrder->delivery_location) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Payment Terms') ?> :</th>
                        <td><?= h($purchaseOrder->payment_terms) ?></td>
                       <th scope="row"><?= __('Gst Charges') ?> :</th>
                        <td><?= h($purchaseOrder->gst_charges) ?></td>
                    <tr>
                        <th scope="row"><?= __('Voucher No') ?> :</th>
                        <td><?= $this->Number->format($purchaseOrder->voucher_no) ?></td>
                        <th scope="row"><?= __('Total') ?> :</th>
                        <td><?= $this->Number->format($purchaseOrder->total) ?></td>
                    </tr>
                    <!-- <tr>
                        <th scope="row"><?= __('Created By') ?> :</th>
                        <td><?= $this->Number->format($purchaseOrder->created_by) ?></td>
                    </tr> -->
                    <tr>
                        <th scope="row"><?= __('Transaction Date') ?> :</th>
                        <td><?= h($purchaseOrder->transaction_date) ?></td>
                        <th scope="row"><?= __('Delivery Date') ?> :</th>
                        <td><?= h($purchaseOrder->delivery_date) ?></td>
                    </tr>
                </table>
                <div class="box-header with-border" >
                    <label> Item Details</label>
                </div>
                <?php if (!empty($purchaseOrder->purchase_order_rows)): ?>
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Item Name') ?></th>
                        <th scope="col"><?= __('Quantity') ?></th>
                        <th scope="col"><?= __('Rate') ?></th>
                        <th scope="col"><?= __('Amount') ?></th>
                    </tr>
                    <?php $i=1;foreach ($purchaseOrder->purchase_order_rows as $purchaseOrderRows): ?>
                    <tr>
                        <td><?= h($i) ?></td>
                        <td><?= h($purchaseOrderRows->row_material->name) ?></td>
                        <td><?= h($purchaseOrderRows->quantity) ?></td>
                        <td><?= h($purchaseOrderRows->rate) ?></td>
                        <td><?= h($purchaseOrderRows->amount) ?></td>
                    </tr>
                    <?php $i++;endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

