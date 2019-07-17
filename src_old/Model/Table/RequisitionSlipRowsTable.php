<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RequisitionSlipRows Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $RequisitionSlips
 * @property \App\Model\Table\RowMaterialsTable|\Cake\ORM\Association\BelongsTo $RowMaterials
 *
 * @method \App\Model\Entity\RequisitionSlipRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\RequisitionSlipRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RequisitionSlipRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequisitionSlipRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequisitionSlipRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequisitionSlipRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RequisitionSlipRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequisitionSlipRow findOrCreate($search, callable $callback = null, $options = [])
 */
class RequisitionSlipRowsTable extends Table
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

        $this->setTable('requisition_slip_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RequisitionSlips', [
            'foreignKey' => 'requisition_slip_id',
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
/*
        $validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

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
        $rules->add($rules->existsIn(['requisition_slip_id'], 'RequisitionSlips'));
        $rules->add($rules->existsIn(['row_material_id'], 'RowMaterials'));

        return $rules;
    }
}
