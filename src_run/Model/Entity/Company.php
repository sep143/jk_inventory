<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $name
 * @property int $state_id
 * @property \Cake\I18n\FrozenDate $financial_year_begins_from
 * @property \Cake\I18n\FrozenDate $financial_year_valid_to
 * @property \Cake\I18n\FrozenDate $books_beginning_from
 * @property string $address
 * @property string $phone_no
 * @property string $mobile
 * @property string $fax_no
 * @property string $email
 * @property string $gstin
 * @property string $pan
 * @property string $bank_name
 * @property string $bank_branch
 * @property string $bank_address
 * @property string $account_number
 * @property string $ifsc
 * @property string $logo
 *
 * @property \App\Model\Entity\State $state
 */
class Company extends Entity
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
        'state_id' => true,
        'financial_year_begins_from' => true,
        'financial_year_valid_to' => true,
        'books_beginning_from' => true,
        'address' => true,
        'phone_no' => true,
        'mobile' => true,
        'fax_no' => true,
        'email' => true,
        'gstin' => true,
        'pan' => true,
        'bank_name' => true,
        'bank_branch' => true,
        'bank_address' => true,
        'account_number' => true,
        'ifsc' => true,
        'logo' => true,
        'state' => true
    ];
}
