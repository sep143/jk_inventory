<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GoodReceiveNote Entity
 *
 * @property int $id
 * @property int $voucher_no
 * @property int $purchase_order_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property \Cake\I18n\FrozenTime $created_no
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\PurchaseOrder $purchase_order
 * @property \App\Model\Entity\GoodReceiveNoteRow[] $good_receive_note_rows
 */
class GoodReceiveNote extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'voucher_no' => true,
        'purchase_order_id' => true,
        'transaction_date' => true,
        'bill_no' => true,
        'transport' => true,
        'inspection_by' => true,
        'inspection_remark' => true,
        'created_no' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'purchase_order' => true,
        'good_receive_note_rows' => true
    ];
}
