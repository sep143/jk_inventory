<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity
 *
 * @property int $id
 * @property string $menu_name
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $controller
 * @property string $action
 * @property string $icon_class_name
 * @property string $is_hidden
 * @property string $query_string
 * @property string $target
 *
 * @property \App\Model\Entity\Menu $parent_menu
 * @property \App\Model\Entity\Menu[] $child_menus
 */
class Menu extends Entity
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
        'menu_name' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'controller' => true,
        'action' => true,
        'icon_class_name' => true,
        'is_hidden' => true,
        'query_string' => true,
        'target' => true,
        'parent_menu' => true,
        'child_menus' => true
    ];
}
