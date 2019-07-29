<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RequisitionSlip Entity
 *
 * @property int $id
 * @property string $voucher_no
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property string $status
 * @property \Cake\I18n\FrozenTime $approved_on
 * @property int $approved_by
 * @property int $is_deleted
 */
class RequisitionSlip extends Entity
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
        'created_on' => true,
        'created_by' => true,
        'transaction_date' => true,
        'status' => true,
        'approved_on' => true,
        'admin_comment' => true,
        'approved_by' => true,
        'is_deleted' => true,
        'po_flag' => true,
        'requisition_slip_rows' => true,
    ];
}
