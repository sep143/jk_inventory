<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RequestSlip Entity
 *
 * @property int $id
 * @property int $voucher_no
 * @property int $employee_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property int $emp_approve_flag
 * @property \Cake\I18n\FrozenTime $emp_approved_on
 * @property int $admin_approve_flag
 * @property \Cake\I18n\FrozenTime $admin_approve_on
 * @property int $is_deleted
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\RequestSlipRow[] $request_slip_rows
 */
class RequestSlip extends Entity
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
        'emp_approve_flag' => true,
        'emp_approved_on' => true,
        'admin_approve_flag' => true,
        'admin_approve_on' => true,
        'is_deleted' => true,
        'admin_comment' => true,
        'emp_comment' => true,
        'employee' => true,
        'request_slip_rows' => true
    ];
}
