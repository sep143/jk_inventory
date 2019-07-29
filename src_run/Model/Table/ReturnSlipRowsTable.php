<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReturnSlipRows Model
 *
 * @property \App\Model\Table\ReturnSlipsTable|\Cake\ORM\Association\BelongsTo $ReturnSlips
 * @property \App\Model\Table\RowMaterialsTable|\Cake\ORM\Association\BelongsTo $RowMaterials
 * @property \App\Model\Table\StockLedgersTable|\Cake\ORM\Association\HasMany $StockLedgers
 *
 * @method \App\Model\Entity\ReturnSlipRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReturnSlipRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReturnSlipRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReturnSlipRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReturnSlipRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReturnSlipRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReturnSlipRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReturnSlipRow findOrCreate($search, callable $callback = null, $options = [])
 */
class ReturnSlipRowsTable extends Table
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

        $this->setTable('return_slip_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('RowMaterialCategories');
        $this->belongsTo('Units');
        $this->belongsTo('ReturnSlips', [
            'foreignKey' => 'return_slip_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RowMaterials', [
            'foreignKey' => 'row_material_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('StockLedgers', [
            'foreignKey' => 'return_slip_row_id'
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
            ->notEmpty('quantity');

        $validator
            ->scalar('return_scrab')
            ->maxLength('return_scrab', 10)
            ->requirePresence('return_scrab', 'create')
            ->notEmpty('return_scrab');*/

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
        $rules->add($rules->existsIn(['return_slip_id'], 'ReturnSlips'));
        $rules->add($rules->existsIn(['row_material_id'], 'RowMaterials'));

        return $rules;
    }
}
