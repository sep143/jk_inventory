<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RowMaterialCategory Entity
 *
 * @property int $id
 * @property string $name
 * @property int $is_deleted
 *
 * @property \App\Model\Entity\RowMaterial[] $row_materials
 */
class RowMaterialCategory extends Entity
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
        'is_deleted' => true,
        'row_materials' => true
    ];
}
