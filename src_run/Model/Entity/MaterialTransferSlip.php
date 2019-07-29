<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MaterialTransferSlip Entity
 *
 * @property int $id
 * @property int $voucher_no
 * @property int $employee_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property int $is_deleted
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\MaterialTransferSlipRow[] $material_transfer_slip_rows
 * @property \App\Model\Entity\StockLedger[] $stock_ledgers
 */
class MaterialTransferSlip extends Entity
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
        'employee_id' => true,
        'transaction_date' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'employee' => true,
        'material_transfer_slip_rows' => true,
        'stock_ledgers' => true
    ];
}
