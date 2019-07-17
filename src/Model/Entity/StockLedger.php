<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockLedger Entity
 *
 * @property int $id
 * @property int $row_material_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property string $opening_balence
 * @property int $good_receive_note_id
 * @property int $good_receive_note_row_id
 * @property int $department_id
 * @property int $employee_id
 * @property int $issue_slip_id
 * @property int $issue_slip_row_id
 * @property int $return_slip_id
 * @property int $return_slip_row_id
 * @property int $material_transfer_slip_id
 * @property int $material_transfer_slip_row_id
 * @property float $quantity
 * @property string $status
 * @property int $is_scrab
 * @property bool $disposed_status
 * @property int $disposed_by
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $disposed_on
 * @property bool $is_transfered
 * @property int $is_used
 * @property string $description
 *
 * @property \App\Model\Entity\RowMaterial $row_material
 * @property \App\Model\Entity\GoodReceiveNote $good_receive_note
 * @property \App\Model\Entity\GoodReceiveNoteRow $good_receive_note_row
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\IssueSlip $issue_slip
 * @property \App\Model\Entity\IssueSlipRow $issue_slip_row
 * @property \App\Model\Entity\ReturnSlip $return_slip
 * @property \App\Model\Entity\ReturnSlipRow $return_slip_row
 * @property \App\Model\Entity\MaterialTransferSlip $material_transfer_slip
 * @property \App\Model\Entity\MaterialTransferSlipRow $material_transfer_slip_row
 * @property \App\Model\Entity\Employee $disposer
 */
class StockLedger extends Entity
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
        'row_material_id' => true,
        'transaction_date' => true,
        'opening_balence' => true,
        'good_receive_note_id' => true,
        'good_receive_note_row_id' => true,
        'department_id' => true,
        'employee_id' => true,
        'issue_slip_id' => true,
        'issue_slip_row_id' => true,
        'return_slip_id' => true,
        'return_slip_row_id' => true,
        'material_transfer_slip_id' => true,
        'material_transfer_slip_row_id' => true,
        'quantity' => true,
        'rate' => true,
        'status' => true,
        'is_scrab' => true,
        'disposed_status' => true,
        'disposed_by' => true,
        'created_on' => true,
        'created_by' => true,
        'disposed_on' => true,
        'is_transfered' => true,
        'is_used' => true,
        'description' => true,
        'row_material' => true,
        'good_receive_note' => true,
        'good_receive_note_row' => true,
        'department' => true,
        'employee' => true,
        'issue_slip' => true,
        'issue_slip_row' => true,
        'return_slip' => true,
        'return_slip_row' => true,
        'material_transfer_slip' => true,
        'material_transfer_slip_row' => true,
        'disposer' => true
    ];
}
