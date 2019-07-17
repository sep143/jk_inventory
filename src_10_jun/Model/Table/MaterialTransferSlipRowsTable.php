<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaterialTransferSlipRows Model
 *
 * @property \App\Model\Table\MaterialTransferSlipsTable|\Cake\ORM\Association\BelongsTo $MaterialTransferSlips
 * @property \App\Model\Table\RowMaterialsTable|\Cake\ORM\Association\BelongsTo $RowMaterials
 * @property \App\Model\Table\StockLedgersTable|\Cake\ORM\Association\HasMany $StockLedgers
 *
 * @method \App\Model\Entity\MaterialTransferSlipRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\MaterialTransferSlipRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MaterialTransferSlipRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaterialTransferSlipRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaterialTransferSlipRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaterialTransferSlipRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MaterialTransferSlipRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaterialTransferSlipRow findOrCreate($search, callable $callback = null, $options = [])
 */
class MaterialTransferSlipRowsTable extends Table
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

        $this->setTable('material_transfer_slip_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('MaterialTransferSlips', [
            'foreignKey' => 'material_transfer_slip_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RowMaterials', [
            'foreignKey' => 'row_material_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('StockLedgers', [
            'foreignKey' => 'material_transfer_slip_row_id'
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

      /*  $validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');*/

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
        $rules->add($rules->existsIn(['material_transfer_slip_id'], 'MaterialTransferSlips'));
        $rules->add($rules->existsIn(['row_material_id'], 'RowMaterials'));

        return $rules;
    }
}
