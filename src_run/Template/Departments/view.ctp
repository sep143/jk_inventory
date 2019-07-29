<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['controller' => 'StockLedgers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['controller' => 'StockLedgers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departments view large-9 medium-8 columns content">
    <h3><?= h($department->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($department->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($department->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($department->is_deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($department->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Mobile No') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Signature') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->employees as $employees): ?>
            <tr>
                <td><?= h($employees->id) ?></td>
                <td><?= h($employees->name) ?></td>
                <td><?= h($employees->username) ?></td>
                <td><?= h($employees->password) ?></td>
                <td><?= h($employees->email) ?></td>
                <td><?= h($employees->mobile_no) ?></td>
                <td><?= h($employees->department_id) ?></td>
                <td><?= h($employees->signature) ?></td>
                <td><?= h($employees->created_on) ?></td>
                <td><?= h($employees->created_by) ?></td>
                <td><?= h($employees->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Stock Ledgers') ?></h4>
        <?php if (!empty($department->stock_ledgers)): ?>
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
            <?php foreach ($department->stock_ledgers as $stockLedgers): ?>
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
