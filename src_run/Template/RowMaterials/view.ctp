<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RowMaterial $rowMaterial
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Material'), ['action' => 'edit', $rowMaterial->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Material'), ['action' => 'delete', $rowMaterial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rowMaterial->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Material Categories'), ['controller' => 'RowMaterialCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material Category'), ['controller' => 'RowMaterialCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grn Row'), ['controller' => 'GrnRow', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grn Row'), ['controller' => 'GrnRow', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Issue Slip Rows'), ['controller' => 'IssueSlipRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Issue Slip Row'), ['controller' => 'IssueSlipRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Order Rows'), ['controller' => 'PurchaseOrderRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Order Row'), ['controller' => 'PurchaseOrderRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requisition Slip Rows'), ['controller' => 'RequisitionSlipRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Requisition Slip Row'), ['controller' => 'RequisitionSlipRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Return Slip Rows'), ['controller' => 'ReturnSlipRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Return Slip Row'), ['controller' => 'ReturnSlipRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['controller' => 'StockLedgers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['controller' => 'StockLedgers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rowMaterials view large-9 medium-8 columns content">
    <h3><?= h($rowMaterial->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rowMaterial->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Category') ?></th>
            <td><?= $rowMaterial->has('row_material_category') ? $this->Html->link($rowMaterial->row_material_category->name, ['controller' => 'RowMaterialCategories', 'action' => 'view', $rowMaterial->row_material_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= $rowMaterial->has('unit') ? $this->Html->link($rowMaterial->unit->name, ['controller' => 'Units', 'action' => 'view', $rowMaterial->unit->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rowMaterial->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($rowMaterial->is_deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Grn Row') ?></h4>
        <?php if (!empty($rowMaterial->grn_row)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Grn Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rowMaterial->grn_row as $grnRow): ?>
            <tr>
                <td><?= h($grnRow->id) ?></td>
                <td><?= h($grnRow->grn_id) ?></td>
                <td><?= h($grnRow->row_material_id) ?></td>
                <td><?= h($grnRow->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'GrnRow', 'action' => 'view', $grnRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'GrnRow', 'action' => 'edit', $grnRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'GrnRow', 'action' => 'delete', $grnRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grnRow->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Issue Slip Rows') ?></h4>
        <?php if (!empty($rowMaterial->issue_slip_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Issue Slip Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rowMaterial->issue_slip_rows as $issueSlipRows): ?>
            <tr>
                <td><?= h($issueSlipRows->id) ?></td>
                <td><?= h($issueSlipRows->issue_slip_id) ?></td>
                <td><?= h($issueSlipRows->row_material_id) ?></td>
                <td><?= h($issueSlipRows->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'IssueSlipRows', 'action' => 'view', $issueSlipRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'IssueSlipRows', 'action' => 'edit', $issueSlipRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'IssueSlipRows', 'action' => 'delete', $issueSlipRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $issueSlipRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Purchase Order Rows') ?></h4>
        <?php if (!empty($rowMaterial->purchase_order_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Purchase Order Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Return Qty') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rowMaterial->purchase_order_rows as $purchaseOrderRows): ?>
            <tr>
                <td><?= h($purchaseOrderRows->id) ?></td>
                <td><?= h($purchaseOrderRows->purchase_order_id) ?></td>
                <td><?= h($purchaseOrderRows->row_material_id) ?></td>
                <td><?= h($purchaseOrderRows->quantity) ?></td>
                <td><?= h($purchaseOrderRows->rate) ?></td>
                <td><?= h($purchaseOrderRows->amount) ?></td>
                <td><?= h($purchaseOrderRows->return_qty) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseOrderRows', 'action' => 'view', $purchaseOrderRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseOrderRows', 'action' => 'edit', $purchaseOrderRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseOrderRows', 'action' => 'delete', $purchaseOrderRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrderRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Requisition Slip Rows') ?></h4>
        <?php if (!empty($rowMaterial->requisition_slip_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Requistion Slip Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rowMaterial->requisition_slip_rows as $requisitionSlipRows): ?>
            <tr>
                <td><?= h($requisitionSlipRows->id) ?></td>
                <td><?= h($requisitionSlipRows->requistion_slip_id) ?></td>
                <td><?= h($requisitionSlipRows->row_material_id) ?></td>
                <td><?= h($requisitionSlipRows->quantity) ?></td>
                <td><?= h($requisitionSlipRows->description) ?></td>
                <td><?= h($requisitionSlipRows->created_on) ?></td>
                <td><?= h($requisitionSlipRows->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RequisitionSlipRows', 'action' => 'view', $requisitionSlipRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RequisitionSlipRows', 'action' => 'edit', $requisitionSlipRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RequisitionSlipRows', 'action' => 'delete', $requisitionSlipRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requisitionSlipRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Return Slip Rows') ?></h4>
        <?php if (!empty($rowMaterial->return_slip_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Return Slip Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Return Scrab') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rowMaterial->return_slip_rows as $returnSlipRows): ?>
            <tr>
                <td><?= h($returnSlipRows->id) ?></td>
                <td><?= h($returnSlipRows->return_slip_id) ?></td>
                <td><?= h($returnSlipRows->row_material_id) ?></td>
                <td><?= h($returnSlipRows->quantity) ?></td>
                <td><?= h($returnSlipRows->return_scrab) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ReturnSlipRows', 'action' => 'view', $returnSlipRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ReturnSlipRows', 'action' => 'edit', $returnSlipRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReturnSlipRows', 'action' => 'delete', $returnSlipRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $returnSlipRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Stock Ledgers') ?></h4>
        <?php if (!empty($rowMaterial->stock_ledgers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Opening Balence') ?></th>
                <th scope="col"><?= __('Grn Id') ?></th>
                <th scope="col"><?= __('Grn Row Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Issue Slip Id') ?></th>
                <th scope="col"><?= __('Issue Slip Row Id') ?></th>
                <th scope="col"><?= __('Return Slip Id') ?></th>
                <th scope="col"><?= __('Return Slip Row Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rowMaterial->stock_ledgers as $stockLedgers): ?>
            <tr>
                <td><?= h($stockLedgers->id) ?></td>
                <td><?= h($stockLedgers->row_material_id) ?></td>
                <td><?= h($stockLedgers->transaction_date) ?></td>
                <td><?= h($stockLedgers->opening_balence) ?></td>
                <td><?= h($stockLedgers->grn_id) ?></td>
                <td><?= h($stockLedgers->grn_row_id) ?></td>
                <td><?= h($stockLedgers->department_id) ?></td>
                <td><?= h($stockLedgers->issue_slip_id) ?></td>
                <td><?= h($stockLedgers->issue_slip_row_id) ?></td>
                <td><?= h($stockLedgers->return_slip_id) ?></td>
                <td><?= h($stockLedgers->return_slip_row_id) ?></td>
                <td><?= h($stockLedgers->quantity) ?></td>
                <td><?= h($stockLedgers->status) ?></td>
                <td><?= h($stockLedgers->created_on) ?></td>
                <td><?= h($stockLedgers->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StockLedgers', 'action' => 'view', $stockLedgers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StockLedgers', 'action' => 'edit', $stockLedgers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StockLedgers', 'action' => 'delete', $stockLedgers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockLedgers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
