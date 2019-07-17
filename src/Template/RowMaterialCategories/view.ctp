<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RowMaterialCategory $rowMaterialCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Material Category'), ['action' => 'edit', $rowMaterialCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Material Category'), ['action' => 'delete', $rowMaterialCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rowMaterialCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Material Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'RowMaterials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'RowMaterials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rowMaterialCategories view large-9 medium-8 columns content">
    <h3><?= h($rowMaterialCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rowMaterialCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rowMaterialCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($rowMaterialCategory->is_deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Materials') ?></h4>
        <?php if (!empty($rowMaterialCategory->row_materials)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Material Category Id') ?></th>
                <th scope="col"><?= __('Unit Id') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rowMaterialCategory->row_materials as $rowMaterials): ?>
            <tr>
                <td><?= h($rowMaterials->id) ?></td>
                <td><?= h($rowMaterials->name) ?></td>
                <td><?= h($rowMaterials->row_material_category_id) ?></td>
                <td><?= h($rowMaterials->unit_id) ?></td>
                <td><?= h($rowMaterials->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RowMaterials', 'action' => 'view', $rowMaterials->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RowMaterials', 'action' => 'edit', $rowMaterials->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RowMaterials', 'action' => 'delete', $rowMaterials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rowMaterials->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
