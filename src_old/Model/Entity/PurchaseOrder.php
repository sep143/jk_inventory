<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrder Entity
 *
 * @property int $id
 * @property int $voucher_no
 * @property int $vendor_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property float $total
 * @property string $discount_per
 * @property string $packing_forwarding_charges
 * @property string $delivery_location
 * @property string $gst_charges
 * @property string $payment_terms
 * @property \Cake\I18n\FrozenDate $delivery_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\Grn[] $grns
 * @property \App\Model\Entity\PurchaseOrderRow[] $purchase_order_rows
 */
class PurchaseOrder extends Entity
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
        'voucher_no' => true,
        'vendor_id' => true,
        'requisition_slip_id' => true,
        'transaction_date' => true,
        'total' => true,
        'discount_per' => true,
        'packing_forwarding_charges' => true,
        'delivery_location' => true,
        'gst_charges' => true,
        'payment_terms' => true,
        'delivery_date' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'vendor' => true,
        'grns' => true,
        'purchase_order_rows' => true
    ];
}
