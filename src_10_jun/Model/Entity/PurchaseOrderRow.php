<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrderRow Entity
 *
 * @property int $id
 * @property int $purchase_order_id
 * @property int $requisition_slip_id
 * @property int $requisition_slip_row_id
 * @property int $row_material_id
 * @property float $quantity
 * @property float $rate
 * @property float $amount
 * @property float $received_qty
 *
 * @property \App\Model\Entity\PurchaseOrder $purchase_order
 * @property \App\Model\Entity\RowMaterial $row_material
 */
class PurchaseOrderRow extends Entity
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
        'purchase_order_id' => true,
        'requisition_slip_id' => true,
        'requisition_slip_row_id' => true,
        'row_material_id' => true,
        'quantity' => true,
        'rate' => true,
        'amount' => true,
        'received_qty' => true,
        'purchase_order' => true,
        'row_material' => true
    ];
}
