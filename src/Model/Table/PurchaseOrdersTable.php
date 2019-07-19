<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrders Model
 *
 * @property \App\Model\Table\VendorsTable|\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\GrnsTable|\Cake\ORM\Association\HasMany $Grns
 * @property \App\Model\Table\PurchaseOrderRowsTable|\Cake\ORM\Association\HasMany $PurchaseOrderRows
 *
 * @method \App\Model\Entity\PurchaseOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseOrder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrder|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseOrdersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('purchase_orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('RequisitionSlips');
        $this->belongsTo('companies');
        $this->belongsTo('GoodReceiveNotes');
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('RequisitionSlips', [
            'foreignKey' => 'requisition_slip_id',
            'joinType' => 'Left'
        ]);
        $this->hasMany('Grns', [
            'foreignKey' => 'purchase_order_id'
        ]);
        $this->hasMany('PurchaseOrderRows', [
            'foreignKey' => 'purchase_order_id',
            'saveStrategy'=>'replace'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

/*        $validator
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->decimal('total')
            ->requirePresence('total', 'create')
            ->notEmpty('total');

        $validator
            ->scalar('discount_per')
            ->maxLength('discount_per', 50)
            ->requirePresence('discount_per', 'create')
            ->notEmpty('discount_per');

        $validator
            ->scalar('packing_forwarding_charges')
            ->maxLength('packing_forwarding_charges', 50)
            ->requirePresence('packing_forwarding_charges', 'create')
            ->notEmpty('packing_forwarding_charges');

        $validator
            ->scalar('delivery_location')
            ->maxLength('delivery_location', 100)
            ->requirePresence('delivery_location', 'create')
            ->notEmpty('delivery_location');

        $validator
            ->scalar('gst_charges')
            ->maxLength('gst_charges', 50)
            ->requirePresence('gst_charges', 'create')
            ->notEmpty('gst_charges');

        $validator
            ->scalar('payment_terms')
            ->maxLength('payment_terms', 100)
            ->requirePresence('payment_terms', 'create')
            ->notEmpty('payment_terms');

        $validator
            ->date('delivery_date')
            ->requirePresence('delivery_date', 'create')
            ->notEmpty('delivery_date');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->dateTime('edited_on')
            ->requirePresence('edited_on', 'create')
            ->notEmpty('edited_on');

        $validator
            ->requirePresence('edited_by', 'create')
            ->notEmpty('edited_by');

        $validator
            ->boolean('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');*/

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'));

        return $rules;
    }
}
