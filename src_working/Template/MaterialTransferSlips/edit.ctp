<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaterialTransferSlip $materialTransferSlip
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $materialTransferSlip->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $materialTransferSlip->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Material Transfer Slips'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Material Transfer Slip Rows'), ['controller' => 'MaterialTransferSlipRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material Transfer Slip Row'), ['controller' => 'MaterialTransferSlipRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['controller' => 'StockLedgers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['controller' => 'StockLedgers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="materialTransferSlips form large-9 medium-8 columns content">
    <?= $this->Form->create($materialTransferSlip) ?>
    <fieldset>
        <legend><?= __('Edit Material Transfer Slip') ?></legend>
        <?php
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('employee_id', ['options' => $employees]);
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
