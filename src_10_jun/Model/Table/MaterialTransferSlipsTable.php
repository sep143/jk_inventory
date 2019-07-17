<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaterialTransferSlips Model
 *
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\MaterialTransferSlipRowsTable|\Cake\ORM\Association\HasMany $MaterialTransferSlipRows
 * @property \App\Model\Table\StockLedgersTable|\Cake\ORM\Association\HasMany $StockLedgers
 *
 * @method \App\Model\Entity\MaterialTransferSlip get($primaryKey, $options = [])
 * @method \App\Model\Entity\MaterialTransferSlip newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MaterialTransferSlip[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaterialTransferSlip|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaterialTransferSlip|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaterialTransferSlip patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MaterialTransferSlip[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaterialTransferSlip findOrCreate($search, callable $callback = null, $options = [])
 */
class MaterialTransferSlipsTable extends Table
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

        $this->setTable('material_transfer_slips');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('RequestSlips');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('Creaters', [
            'className' => 'Employees',
            'foreignKey' => 'created_by',
            'joinType' => 'left'
        ]);
        $this->hasMany('MaterialTransferSlipRows', [
            'foreignKey' => 'material_transfer_slip_id',
            'saveStrategy'=>'replace',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
        $this->hasMany('StockLedgers', [
            'foreignKey' => 'material_transfer_slip_id',
            'saveStrategy'=>'replace',
            'dependent' => true,
            'cascadeCallbacks' => true
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
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));

        return $rules;
    }
}
