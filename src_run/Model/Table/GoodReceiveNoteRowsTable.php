<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GoodReceiveNoteRows Model
 *
 * @property \App\Model\Table\GoodReceiveNotesTable|\Cake\ORM\Association\BelongsTo $GoodReceiveNotes
 * @property \App\Model\Table\RowMaterialsTable|\Cake\ORM\Association\BelongsTo $RowMaterials
 *
 * @method \App\Model\Entity\GoodReceiveNoteRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\GoodReceiveNoteRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GoodReceiveNoteRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GoodReceiveNoteRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GoodReceiveNoteRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GoodReceiveNoteRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GoodReceiveNoteRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GoodReceiveNoteRow findOrCreate($search, callable $callback = null, $options = [])
 */
class GoodReceiveNoteRowsTable extends Table
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

        $this->setTable('good_receive_note_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        //$this->belongsTo('Companies');
        $this->belongsTo('GoodReceiveNotes', [
            'foreignKey' => 'good_receive_note_id',
            'joinType' => 'INNER'
        ]); 
        $this->belongsTo('PurchaseOrderRows', [
            'foreignKey' => 'purchase_order_row_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RowMaterials', [
            'foreignKey' => 'row_material_id',
            'joinType' => 'INNER'
        ]); 
        $this->belongsTo('StockLedgers', [
            'foreignKey' => 'good_receive_note_id',
            'joinType' => 'LEFT',
            'saveStrategy'=>'replace'  
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
        $rules->add($rules->existsIn(['good_receive_note_id'], 'GoodReceiveNotes'));
        $rules->add($rules->existsIn(['row_material_id'], 'RowMaterials'));

        return $rules;
    }
}
