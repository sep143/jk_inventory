<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RowMaterial $rowMaterial
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rowMaterial->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rowMaterial->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Material Categories'), ['controller' => 'RowMaterialCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material Category'), ['controller' => 'RowMaterialCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grn Row'), ['controller' => 'GrnRow', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grn Row'), ['controller' => 'GrnRow', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Issue Slip Rows'), ['controller' => 'IssueSlipRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Issue Slip Row'), ['controller' => 'IssueSlipRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Order Rows'), ['controller' => 'PurchaseOrderRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Order Row'), ['controller' => 'PurchaseOrderRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requisition Slip Rows'), ['controller' => 'RequisitionSlipRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requisition Slip Row'), ['controller' => 'RequisitionSlipRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Return Slip Rows'), ['controller' => 'ReturnSlipRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Return Slip Row'), ['controller' => 'ReturnSlipRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['controller' => 'StockLedgers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['controller' => 'StockLedgers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rowMaterials form large-9 medium-8 columns content">
    <?= $this->Form->create($rowMaterial) ?>
    <fieldset>
        <legend><?= __('Edit Material') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('row_material_category_id', ['options' => $rowMaterialCategories]);
            echo $this->Form->control('unit_id', ['options' => $units]);
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
