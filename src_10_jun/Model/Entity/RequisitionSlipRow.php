<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RequisitionSlipRow Entity
 *
 * @property int $id
 * @property int $requisition_slip_id
 * @property int $row_material_id
 * @property float $quantity
 * @property string $description
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\RequistionSlip $requistion_slip
 * @property \App\Model\Entity\RowMaterial $row_material
 */
class RequisitionSlipRow extends Entity
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
        'requisition_slip_id' => true,
        'row_material_id' => true,
        'quantity' => true,
        'description' => true,
        'requistion_slip' => true,
        'row_material' => true,
        'po_flag' => true
    ];
}
