<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GoodReceiveNoteRow Entity
 *
 * @property int $id
 * @property int $good_receive_note_id
 * @property int $row_material_id
 * @property float $quantity
 *
 * @property \App\Model\Entity\GoodReceiveNote $good_receive_note
 * @property \App\Model\Entity\RowMaterial $row_material
 */
class GoodReceiveNoteRow extends Entity
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
        'good_receive_note_id' => true,
        'row_material_id' => true,
        'quantity' => true,
        'rate' => true,
        'amount' => true,
        'purchase_order_row_id' => true,
        'good_receive_note' => true,
        'row_material' => true
    ];
}
