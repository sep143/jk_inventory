<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['controller' => 'StockLedgers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['controller' => 'StockLedgers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departments form large-9 medium-8 columns content">
    <?= $this->Form->create($department) ?>
    <fieldset>
        <legend><?= __('Add Department') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
