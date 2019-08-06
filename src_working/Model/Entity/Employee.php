<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $mobile_no
 * @property int $department_id
 * @property string $signature
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property int $is_deleted
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\IssueSlip[] $issue_slips
 * @property \App\Model\Entity\ReturnSlip[] $return_slips
 */
class Employee extends Entity
{
     protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher())->hash($password);
    }

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
        'username' => true,
        'password' => true,
        'email' => true,
        'mobile_no' => true,
        'department_id' => true,
        'signature' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'department' => true,
        'address' => true,
        'issue_slips' => true,
        'role_id' => true,
        'return_slips' => true,
        'forgot_code' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
