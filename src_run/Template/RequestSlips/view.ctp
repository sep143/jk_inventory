<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RequestSlip $requestSlip
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Request Slip'), ['action' => 'edit', $requestSlip->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Request Slip'), ['action' => 'delete', $requestSlip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestSlip->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Request Slips'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request Slip'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Request Slip Rows'), ['controller' => 'RequestSlipRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request Slip Row'), ['controller' => 'RequestSlipRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requestSlips view large-9 medium-8 columns content">
    <h3><?= h($requestSlip->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $requestSlip->has('employee') ? $this->Html->link($requestSlip->employee->name, ['controller' => 'Employees', 'action' => 'view', $requestSlip->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($requestSlip->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($requestSlip->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($requestSlip->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($requestSlip->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Emp Approve Flag') ?></th>
            <td><?= $this->Number->format($requestSlip->emp_approve_flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Approve Flag') ?></th>
            <td><?= $this->Number->format($requestSlip->admin_approve_flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($requestSlip->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($requestSlip->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($requestSlip->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($requestSlip->edited_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Emp Approved On') ?></th>
            <td><?= h($requestSlip->emp_approved_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Approve On') ?></th>
            <td><?= h($requestSlip->admin_approve_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Request Slip Rows') ?></h4>
        <?php if (!empty($requestSlip->request_slip_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Request Slip Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($requestSlip->request_slip_rows as $requestSlipRows): ?>
            <tr>
                <td><?= h($requestSlipRows->id) ?></td>
                <td><?= h($requestSlipRows->request_slip_id) ?></td>
                <td><?= h($requestSlipRows->row_material_id) ?></td>
                <td><?= h($requestSlipRows->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RequestSlipRows', 'action' => 'view', $requestSlipRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RequestSlipRows', 'action' => 'edit', $requestSlipRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RequestSlipRows', 'action' => 'delete', $requestSlipRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestSlipRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
