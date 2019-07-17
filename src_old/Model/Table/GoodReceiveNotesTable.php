<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GoodReceiveNotes Model
 *
 * @property \App\Model\Table\PurchaseOrdersTable|\Cake\ORM\Association\BelongsTo $PurchaseOrders
 * @property \App\Model\Table\GoodReceiveNoteRowsTable|\Cake\ORM\Association\HasMany $GoodReceiveNoteRows
 *
 * @method \App\Model\Entity\GoodReceiveNote get($primaryKey, $options = [])
 * @method \App\Model\Entity\GoodReceiveNote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GoodReceiveNote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GoodReceiveNote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GoodReceiveNote|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GoodReceiveNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GoodReceiveNote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GoodReceiveNote findOrCreate($search, callable $callback = null, $options = [])
 */
class GoodReceiveNotesTable extends Table
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

        $this->setTable('good_receive_notes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PurchaseOrders', [
            'foreignKey' => 'purchase_order_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('GoodReceiveNoteRows', [
            'foreignKey' => 'good_receive_note_id',
            'saveStrategy'=>'replace',
            'dependent' => true,
            'cascadeCallbacks' => true,            
        ]);
        $this->hasMany('StockLedgers', [
            'foreignKey' => 'good_receive_note_id',
             'saveStrategy'=>'replace',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        
        $this->belongsTo('Creaters', [
            'className' => 'Employees',
            'foreignKey' => 'created_by',
            'joinType' => 'Left'
        ]);
        $this->belongsTo('Inspectors', [
            'className' => 'Employees',
            'foreignKey' => 'inspection_by',
            'joinType' => 'Left'
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
/*
        $validator
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

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
        $rules->add($rules->existsIn(['purchase_order_id'], 'PurchaseOrders'));

        return $rules;
    }
}
