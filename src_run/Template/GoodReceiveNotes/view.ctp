<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoodReceiveNote $goodReceiveNote
 */
?>
<div class="goodReceiveNotes view large-9 medium-8 columns content">
    <h3><?= h($goodReceiveNote->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Purchase Order') ?></th>
            <td><?= $goodReceiveNote->has('purchase_order') ? $this->Html->link($goodReceiveNote->purchase_order->id, ['controller' => 'PurchaseOrders', 'action' => 'view', $goodReceiveNote->purchase_order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($goodReceiveNote->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($goodReceiveNote->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($goodReceiveNote->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($goodReceiveNote->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($goodReceiveNote->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created No') ?></th>
            <td><?= h($goodReceiveNote->created_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($goodReceiveNote->edited_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $goodReceiveNote->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Good Receive Note Rows') ?></h4>
        <?php if (!empty($goodReceiveNote->good_receive_note_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Good Receive Note Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($goodReceiveNote->good_receive_note_rows as $goodReceiveNoteRows): ?>
            <tr>
                <td><?= h($goodReceiveNoteRows->id) ?></td>
                <td><?= h($goodReceiveNoteRows->good_receive_note_id) ?></td>
                <td><?= h($goodReceiveNoteRows->row_material_id) ?></td>
                <td><?= h($goodReceiveNoteRows->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'GoodReceiveNoteRows', 'action' => 'view', $goodReceiveNoteRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'GoodReceiveNoteRows', 'action' => 'edit', $goodReceiveNoteRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'GoodReceiveNoteRows', 'action' => 'delete', $goodReceiveNoteRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $goodReceiveNoteRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
