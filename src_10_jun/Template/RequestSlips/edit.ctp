<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RequestSlip $requestSlip
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $requestSlip->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $requestSlip->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Request Slips'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Request Slip Rows'), ['controller' => 'RequestSlipRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request Slip Row'), ['controller' => 'RequestSlipRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requestSlips form large-9 medium-8 columns content">
    <?= $this->Form->create($requestSlip) ?>
    <fieldset>
        <legend><?= __('Edit Request Slip') ?></legend>
        <?php
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('employee_id', ['options' => $employees]);
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
            echo $this->Form->control('emp_approve_flag');
            echo $this->Form->control('emp_approved_on');
            echo $this->Form->control('admin_approve_flag');
            echo $this->Form->control('admin_approve_on');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
