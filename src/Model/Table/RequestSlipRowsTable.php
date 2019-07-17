<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RequestSlipRows Model
 *
 * @property \App\Model\Table\RequestSlipsTable|\Cake\ORM\Association\BelongsTo $RequestSlips
 * @property \App\Model\Table\RowMaterialsTable|\Cake\ORM\Association\BelongsTo $RowMaterials
 *
 * @method \App\Model\Entity\RequestSlipRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\RequestSlipRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RequestSlipRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequestSlipRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequestSlipRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequestSlipRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RequestSlipRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequestSlipRow findOrCreate($search, callable $callback = null, $options = [])
 */
class RequestSlipRowsTable extends Table
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

        $this->setTable('request_slip_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RequestSlips', [
            'foreignKey' => 'request_slip_id',
            'joinType' => 'INNER'
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

        $validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

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
        $rules->add($rules->existsIn(['request_slip_id'], 'RequestSlips'));
        $rules->add($rules->existsIn(['row_material_id'], 'RowMaterials'));

        return $rules;
    }
}
