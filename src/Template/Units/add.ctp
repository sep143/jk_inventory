<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit $unit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'RowMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'RowMaterials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="units form large-9 medium-8 columns content">
    <?= $this->Form->create($unit) ?>
    <fieldset>
        <legend><?= __('Add Unit') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
