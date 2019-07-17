<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrderRows Model
 *
 * @property \App\Model\Table\PurchaseOrdersTable|\Cake\ORM\Association\BelongsTo $PurchaseOrders
 * @property |\Cake\ORM\Association\BelongsTo $RequisitionSlips
 * @property |\Cake\ORM\Association\BelongsTo $RequisitionSlipRows
 * @property \App\Model\Table\RowMaterialsTable|\Cake\ORM\Association\BelongsTo $RowMaterials
 *
 * @method \App\Model\Entity\PurchaseOrderRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseOrderRowsTable extends Table
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

        $this->setTable('purchase_order_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PurchaseOrders', [
            'foreignKey' => 'purchase_order_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RequisitionSlips', [
            'foreignKey' => 'requisition_slip_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('RequisitionSlipRows', [
            'foreignKey' => 'requisition_slip_row_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('RowMaterials', [
            'foreignKey' => 'row_material_id',
            'joinType' => 'INNER'
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

       /* $validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->decimal('received_qty')
            ->requirePresence('received_qty', 'create')
            ->notEmpty('received_qty');*/

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
        $rules->add($rules->existsIn(['purchase_order_id'], 'PurchaseOrders'));
        $rules->add($rules->existsIn(['requisition_slip_id'], 'RequisitionSlips'));
        $rules->add($rules->existsIn(['requisition_slip_row_id'], 'RequisitionSlipRows'));
        $rules->add($rules->existsIn(['row_material_id'], 'RowMaterials'));

        return $rules;
    }
}
