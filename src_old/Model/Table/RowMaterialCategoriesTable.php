<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RowMaterialCategories Model
 *
 * @property \App\Model\Table\RowMaterialsTable|\Cake\ORM\Association\HasMany $RowMaterials
 *
 * @method \App\Model\Entity\RowMaterialCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\RowMaterialCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RowMaterialCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RowMaterialCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RowMaterialCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RowMaterialCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RowMaterialCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RowMaterialCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class RowMaterialCategoriesTable extends Table
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

        $this->setTable('row_material_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('RowMaterials', [
            'foreignKey' => 'row_material_category_id'
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');
*/
        return $validator;
    }
}
