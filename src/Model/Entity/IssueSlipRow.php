<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IssueSlipRow Entity
 *
 * @property int $id
 * @property int $issue_slip_id
 * @property int $row_material_id
 * @property float $quantity
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\IssueSlip $issue_slip
 * @property \App\Model\Entity\RowMaterial $row_material
 * @property \App\Model\Entity\StockLedger[] $stock_ledgers
 */
class IssueSlipRow extends Entity
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
        '*' => true,
        'id' => false
    ];
}
