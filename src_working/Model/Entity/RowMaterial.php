<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RowMaterial Entity
 *
 * @property int $id
 * @property string $name
 * @property int $row_material_category_id
 * @property int $unit_id
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property int $is_deleted
 *
 * @property \App\Model\Entity\RowMaterialCategory $row_material_category
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\GrnRow[] $grn_row
 * @property \App\Model\Entity\IssueSlipRow[] $issue_slip_rows
 * @property \App\Model\Entity\PurchaseOrderRow[] $purchase_order_rows
 * @property \App\Model\Entity\RequisitionSlipRow[] $requisition_slip_rows
 * @property \App\Model\Entity\ReturnSlipRow[] $return_slip_rows
 * @property \App\Model\Entity\StockLedger[] $stock_ledgers
 */
class RowMaterial extends Entity
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
        'name' => true,
        'row_material_category_id' => true,
        'unit_id' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'reuseable' => true,
        'row_material_category' => true,
        'unit' => true,
        'grn_row' => true,
        'issue_slip_rows' => true,
        'purchase_order_rows' => true,
        'requisition_slip_rows' => true,
        'return_slip_rows' => true,
        'stock_ledgers' => true
    ];
}
