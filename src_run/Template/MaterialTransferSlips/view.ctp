<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaterialTransferSlip $materialTransferSlip
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Material Transfer Slip'), ['action' => 'edit', $materialTransferSlip->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Material Transfer Slip'), ['action' => 'delete', $materialTransferSlip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materialTransferSlip->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Material Transfer Slips'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material Transfer Slip'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Material Transfer Slip Rows'), ['controller' => 'MaterialTransferSlipRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material Transfer Slip Row'), ['controller' => 'MaterialTransferSlipRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['controller' => 'StockLedgers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['controller' => 'StockLedgers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="materialTransferSlips view large-9 medium-8 columns content">
    <h3><?= h($materialTransferSlip->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $materialTransferSlip->has('employee') ? $this->Html->link($materialTransferSlip->employee->name, ['controller' => 'Employees', 'action' => 'view', $materialTransferSlip->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($materialTransferSlip->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($materialTransferSlip->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($materialTransferSlip->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($materialTransferSlip->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($materialTransferSlip->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($materialTransferSlip->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($materialTransferSlip->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($materialTransferSlip->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Material Transfer Slip Rows') ?></h4>
        <?php if (!empty($materialTransferSlip->material_transfer_slip_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Material Transfer Slip Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($materialTransferSlip->material_transfer_slip_rows as $materialTransferSlipRows): ?>
            <tr>
                <td><?= h($materialTransferSlipRows->id) ?></td>
                <td><?= h($materialTransferSlipRows->material_transfer_slip_id) ?></td>
                <td><?= h($materialTransferSlipRows->row_material_id) ?></td>
                <td><?= h($materialTransferSlipRows->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MaterialTransferSlipRows', 'action' => 'view', $materialTransferSlipRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MaterialTransferSlipRows', 'action' => 'edit', $materialTransferSlipRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MaterialTransferSlipRows', 'action' => 'delete', $materialTransferSlipRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materialTransferSlipRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Stock Ledgers') ?></h4>
        <?php if (!empty($materialTransferSlip->stock_ledgers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Opening Balence') ?></th>
                <th scope="col"><?= __('Good Receive Note Id') ?></th>
                <th scope="col"><?= __('Good Receive Note Row Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Issue Slip Id') ?></th>
                <th scope="col"><?= __('Issue Slip Row Id') ?></th>
                <th scope="col"><?= __('Return Slip Id') ?></th>
                <th scope="col"><?= __('Return Slip Row Id') ?></th>
                <th scope="col"><?= __('Material Transfer Slip Id') ?></th>
                <th scope="col"><?= __('Material Transfer Slip Row Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Is Scrab') ?></th>
                <th scope="col"><?= __('Disposed Status') ?></th>
                <th scope="col"><?= __('Disposed By') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Disposed On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($materialTransferSlip->stock_ledgers as $stockLedgers): ?>
            <tr>
                <td><?= h($stockLedgers->id) ?></td>
                <td><?= h($stockLedgers->row_material_id) ?></td>
                <td><?= h($stockLedgers->transaction_date) ?></td>
                <td><?= h($stockLedgers->opening_balence) ?></td>
                <td><?= h($stockLedgers->good_receive_note_id) ?></td>
                <td><?= h($stockLedgers->good_receive_note_row_id) ?></td>
                <td><?= h($stockLedgers->department_id) ?></td>
                <td><?= h($stockLedgers->employee_id) ?></td>
                <td><?= h($stockLedgers->issue_slip_id) ?></td>
                <td><?= h($stockLedgers->issue_slip_row_id) ?></td>
                <td><?= h($stockLedgers->return_slip_id) ?></td>
                <td><?= h($stockLedgers->return_slip_row_id) ?></td>
                <td><?= h($stockLedgers->material_transfer_slip_id) ?></td>
                <td><?= h($stockLedgers->material_transfer_slip_row_id) ?></td>
                <td><?= h($stockLedgers->quantity) ?></td>
                <td><?= h($stockLedgers->status) ?></td>
                <td><?= h($stockLedgers->is_scrab) ?></td>
                <td><?= h($stockLedgers->disposed_status) ?></td>
                <td><?= h($stockLedgers->disposed_by) ?></td>
                <td><?= h($stockLedgers->created_on) ?></td>
                <td><?= h($stockLedgers->created_by) ?></td>
                <td><?= h($stockLedgers->disposed_on) ?></td>
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
