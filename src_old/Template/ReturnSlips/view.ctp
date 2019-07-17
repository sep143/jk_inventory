<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReturnSlip $returnSlip
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Return Slip'), ['action' => 'edit', $returnSlip->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Return Slip'), ['action' => 'delete', $returnSlip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $returnSlip->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Return Slips'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Return Slip'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Return Slip Rows'), ['controller' => 'ReturnSlipRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Return Slip Row'), ['controller' => 'ReturnSlipRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['controller' => 'StockLedgers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['controller' => 'StockLedgers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="returnSlips view large-9 medium-8 columns content">
    <h3><?= h($returnSlip->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $returnSlip->has('employee') ? $this->Html->link($returnSlip->employee->name, ['controller' => 'Employees', 'action' => 'view', $returnSlip->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($returnSlip->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($returnSlip->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($returnSlip->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($returnSlip->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($returnSlip->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($returnSlip->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($returnSlip->edited_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $returnSlip->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Return Slip Rows') ?></h4>
        <?php if (!empty($returnSlip->return_slip_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Return Slip Id') ?></th>
                <th scope="col"><?= __('Row Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Return Scrab') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($returnSlip->return_slip_rows as $returnSlipRows): ?>
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
        <?php if (!empty($returnSlip->stock_ledgers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Row Material Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Opening Balence') ?></th>
                <th scope="col"><?= __('Good Receive Note Id') ?></th>
                <th scope="col"><?= __('Good Receive Note Row Id') ?></th>
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
            <?php foreach ($returnSlip->stock_ledgers as $stockLedgers): ?>
            <tr>
                <td><?= h($stockLedgers->id) ?></td>
                <td><?= h($stockLedgers->row_material_id) ?></td>
                <td><?= h($stockLedgers->transaction_date) ?></td>
                <td><?= h($stockLedgers->opening_balence) ?></td>
                <td><?= h($stockLedgers->good_receive_note_id) ?></td>
                <td><?= h($stockLedgers->good_receive_note_row_id) ?></td>
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
