<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 */
class CompaniesTable extends Table
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

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
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

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->date('financial_year_begins_from')
            ->requirePresence('financial_year_begins_from', 'create')
            ->notEmpty('financial_year_begins_from');

        $validator
            ->date('financial_year_valid_to')
            ->requirePresence('financial_year_valid_to', 'create')
            ->notEmpty('financial_year_valid_to');

        $validator
            ->date('books_beginning_from')
            ->requirePresence('books_beginning_from', 'create')
            ->notEmpty('books_beginning_from');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('phone_no')
            ->maxLength('phone_no', 20)
            ->requirePresence('phone_no', 'create')
            ->notEmpty('phone_no');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 10)
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->scalar('fax_no')
            ->maxLength('fax_no', 20)
            ->requirePresence('fax_no', 'create')
            ->notEmpty('fax_no');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('gstin')
            ->maxLength('gstin', 20)
            ->requirePresence('gstin', 'create')
            ->notEmpty('gstin');

        $validator
            ->scalar('pan')
            ->maxLength('pan', 20)
            ->requirePresence('pan', 'create')
            ->notEmpty('pan');

        $validator
            ->scalar('bank_name')
            ->maxLength('bank_name', 100)
            ->requirePresence('bank_name', 'create')
            ->notEmpty('bank_name');

        $validator
            ->scalar('bank_branch')
            ->maxLength('bank_branch', 50)
            ->requirePresence('bank_branch', 'create')
            ->notEmpty('bank_branch');

        $validator
            ->scalar('bank_address')
            ->maxLength('bank_address', 255)
            ->requirePresence('bank_address', 'create')
            ->notEmpty('bank_address');

        $validator
            ->scalar('account_number')
            ->maxLength('account_number', 15)
            ->requirePresence('account_number', 'create')
            ->notEmpty('account_number');

        $validator
            ->scalar('ifsc')
            ->maxLength('ifsc', 15)
            ->requirePresence('ifsc', 'create')
            ->notEmpty('ifsc');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->requirePresence('logo', 'create')
            ->notEmpty('logo');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
