<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RequestSlipRow Entity
 *
 * @property int $id
 * @property int $request_slip_id
 * @property int $row_material_id
 * @property float $quantity
 *
 * @property \App\Model\Entity\RequestSlip $request_slip
 * @property \App\Model\Entity\RowMaterial $row_material
 */
class RequestSlipRow extends Entity
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
