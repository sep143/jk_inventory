<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RequisitionSlip $requisitionSlip
 */
?>
<div class="requisitionSlips view large-9 medium-8 columns content">
    <h3><?= h($requisitionSlip->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= h($requisitionSlip->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($requisitionSlip->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($requisitionSlip->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($requisitionSlip->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($requisitionSlip->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($requisitionSlip->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($requisitionSlip->transaction_date) ?></td>
        </tr>
    </table>
</div>
