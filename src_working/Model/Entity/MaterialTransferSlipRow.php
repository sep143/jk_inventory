<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MaterialTransferSlipRow Entity
 *
 * @property int $id
 * @property int $material_transfer_slip_id
 * @property int $row_material_id
 * @property float $quantity
 *
 * @property \App\Model\Entity\MaterialTransferSlip $material_transfer_slip
 * @property \App\Model\Entity\RowMaterial $row_material
 * @property \App\Model\Entity\StockLedger[] $stock_ledgers
 */
class MaterialTransferSlipRow extends Entity
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
        'material_transfer_slip_id' => true,
        'row_material_id' => true,
        'quantity' => true,
        'material_transfer_slip' => true,
        'row_material' => true,
        'stock_ledgers' => true
    ];
}
