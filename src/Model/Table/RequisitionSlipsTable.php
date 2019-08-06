<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RequisitionSlips Model
 *
 * @method \App\Model\Entity\RequisitionSlip get($primaryKey, $options = [])
 * @method \App\Model\Entity\RequisitionSlip newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RequisitionSlip[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequisitionSlip|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequisitionSlip|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequisitionSlip patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RequisitionSlip[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequisitionSlip findOrCreate($search, callable $callback = null, $options = [])
 */
class RequisitionSlipsTable extends Table
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

        $this->setTable('requisition_slips');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('Companies');
        $this->belongsTo('IssueSlips');
        $this->hasMany('RequisitionSlipRows', [
            'foreignKey' => 'requisition_slip_id',
            'joinType' => 'INNER',
            'saveStrategy'=>'replace'
        ]);
        $this->belongsTo('Creaters', [
            'className' => 'Employees',
            'foreignKey' => 'created_by',
            'joinType' => 'left'
        ]);
        $this->belongsTo('Approvers', [
            'className' => 'Employees',
            'foreignKey' => 'approved_by',
            'joinType' => 'left'
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

     /*   $validator
            ->scalar('voucher_no')
            ->maxLength('voucher_no', 100)
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->dateTime('approved_on')
            ->requirePresence('approved_on', 'create')
            ->notEmpty('approved_on');

        $validator
            ->requirePresence('approved_by', 'create')
            ->notEmpty('approved_by');

        $validator
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');*/

        return $validator;
    }
}
