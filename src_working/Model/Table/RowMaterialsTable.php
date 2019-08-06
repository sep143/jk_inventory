<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RowMaterials Model
 *
 * @property \App\Model\Table\RowMaterialCategoriesTable|\Cake\ORM\Association\BelongsTo $RowMaterialCategories
 * @property \App\Model\Table\UnitsTable|\Cake\ORM\Association\BelongsTo $Units
 * @property \App\Model\Table\GrnRowTable|\Cake\ORM\Association\HasMany $GrnRow
 * @property \App\Model\Table\IssueSlipRowsTable|\Cake\ORM\Association\HasMany $IssueSlipRows
 * @property \App\Model\Table\PurchaseOrderRowsTable|\Cake\ORM\Association\HasMany $PurchaseOrderRows
 * @property \App\Model\Table\RequisitionSlipRowsTable|\Cake\ORM\Association\HasMany $RequisitionSlipRows
 * @property \App\Model\Table\ReturnSlipRowsTable|\Cake\ORM\Association\HasMany $ReturnSlipRows
 * @property \App\Model\Table\StockLedgersTable|\Cake\ORM\Association\HasMany $StockLedgers
 *
 * @method \App\Model\Entity\RowMaterial get($primaryKey, $options = [])
 * @method \App\Model\Entity\RowMaterial newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RowMaterial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RowMaterial|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RowMaterial|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RowMaterial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RowMaterial[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RowMaterial findOrCreate($search, callable $callback = null, $options = [])
 */
class RowMaterialsTable extends Table
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

        $this->setTable('row_materials');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('RowMaterialCategories', [
            'foreignKey' => 'row_material_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('GrnRow', [
            'foreignKey' => 'row_material_id'
        ]);
        $this->hasMany('IssueSlipRows', [
            'foreignKey' => 'row_material_id'
        ]);
        $this->hasMany('PurchaseOrderRows', [
            'foreignKey' => 'row_material_id'
        ]);
        $this->hasMany('RequisitionSlipRows', [
            'foreignKey' => 'row_material_id'
        ]);
        $this->hasMany('ReturnSlipRows', [
            'foreignKey' => 'row_material_id'
        ]);
        $this->hasMany('StockLedgers', [
            'foreignKey' => 'row_material_id'
        ]);

        $this->hasMany('StockLedgersNews', [
            'className' => 'StockLedgers',
            'foreignKey' => 'row_material_id',
            'joinType'=>'INNER'
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
            ->notEmpty('is_deleted');
*/
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
        $rules->add($rules->existsIn(['row_material_category_id'], 'RowMaterialCategories'));
        $rules->add($rules->existsIn(['unit_id'], 'Units'));

        return $rules;
    }
}
