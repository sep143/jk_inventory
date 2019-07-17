<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RowMaterialCategory $rowMaterialCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Material Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'RowMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'RowMaterials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rowMaterialCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($rowMaterialCategory) ?>
    <fieldset>
        <legend><?= __('Add Material Category') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
