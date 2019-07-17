<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Department Entity
 *
 * @property int $id
 * @property string $name
 * @property int $is_deleted
 *
 * @property \App\Model\Entity\Employee[] $employees
 * @property \App\Model\Entity\StockLedger[] $stock_ledgers
 */
class Department extends Entity
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
        'employees' => true,
        'stock_ledgers' => true
    ];
}
