<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Issue Slips'), ['controller' => 'IssueSlips', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Issue Slip'), ['controller' => 'IssueSlips', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Return Slips'), ['controller' => 'ReturnSlips', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Return Slip'), ['controller' => 'ReturnSlips', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($employee->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($employee->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($employee->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($employee->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile No') ?></th>
            <td><?= h($employee->mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $employee->has('department') ? $this->Html->link($employee->department->name, ['controller' => 'Departments', 'action' => 'view', $employee->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Signature') ?></th>
            <td><?= h($employee->signature) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employee->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($employee->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($employee->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($employee->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Issue Slips') ?></h4>
        <?php if (!empty($employee->issue_slips)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Voucher No') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->issue_slips as $issueSlips): ?>
            <tr>
                <td><?= h($issueSlips->id) ?></td>
                <td><?= h($issueSlips->voucher_no) ?></td>
                <td><?= h($issueSlips->employee_id) ?></td>
                <td><?= h($issueSlips->transaction_date) ?></td>
                <td><?= h($issueSlips->created_on) ?></td>
                <td><?= h($issueSlips->created_by) ?></td>
                <td><?= h($issueSlips->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'IssueSlips', 'action' => 'view', $issueSlips->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'IssueSlips', 'action' => 'edit', $issueSlips->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'IssueSlips', 'action' => 'delete', $issueSlips->id], ['confirm' => __('Are you sure you want to delete # {0}?', $issueSlips->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Return Slips') ?></h4>
        <?php if (!empty($employee->return_slips)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Voucher No') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->return_slips as $returnSlips): ?>
            <tr>
                <td><?= h($returnSlips->id) ?></td>
                <td><?= h($returnSlips->voucher_no) ?></td>
                <td><?= h($returnSlips->employee_id) ?></td>
                <td><?= h($returnSlips->transaction_date) ?></td>
                <td><?= h($returnSlips->created_on) ?></td>
                <td><?= h($returnSlips->created_by) ?></td>
                <td><?= h($returnSlips->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ReturnSlips', 'action' => 'view', $returnSlips->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ReturnSlips', 'action' => 'edit', $returnSlips->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReturnSlips', 'action' => 'delete', $returnSlips->id], ['confirm' => __('Are you sure you want to delete # {0}?', $returnSlips->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
