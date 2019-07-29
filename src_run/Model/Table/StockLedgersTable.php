<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockLedgers Model
 *
 * @property \App\Model\Table\RowMaterialsTable|\Cake\ORM\Association\BelongsTo $RowMaterials
 * @property \App\Model\Table\GoodReceiveNotesTable|\Cake\ORM\Association\BelongsTo $GoodReceiveNotes
 * @property \App\Model\Table\GoodReceiveNoteRowsTable|\Cake\ORM\Association\BelongsTo $GoodReceiveNoteRows
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\IssueSlipsTable|\Cake\ORM\Association\BelongsTo $IssueSlips
 * @property \App\Model\Table\IssueSlipRowsTable|\Cake\ORM\Association\BelongsTo $IssueSlipRows
 * @property \App\Model\Table\ReturnSlipsTable|\Cake\ORM\Association\BelongsTo $ReturnSlips
 * @property \App\Model\Table\ReturnSlipRowsTable|\Cake\ORM\Association\BelongsTo $ReturnSlipRows
 * @property \App\Model\Table\MaterialTransferSlipsTable|\Cake\ORM\Association\BelongsTo $MaterialTransferSlips
 * @property \App\Model\Table\MaterialTransferSlipRowsTable|\Cake\ORM\Association\BelongsTo $MaterialTransferSlipRows
 *
 * @method \App\Model\Entity\StockLedger get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockLedger newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockLedger[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockLedger|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockLedger|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockLedger patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockLedger[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockLedger findOrCreate($search, callable $callback = null, $options = [])
 */
class StockLedgersTable extends Table
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

        $this->setTable('stock_ledgers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RowMaterials', [
            'foreignKey' => 'row_material_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('GoodReceiveNotes', [
            'foreignKey' => 'good_receive_note_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('GoodReceiveNoteRows', [
            'foreignKey' => 'good_receive_note_row_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('IssueSlips', [
            'foreignKey' => 'issue_slip_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('IssueSlipRows', [
            'foreignKey' => 'issue_slip_row_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('ReturnSlips', [
            'foreignKey' => 'return_slip_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('ReturnSlipRows', [
            'foreignKey' => 'return_slip_row_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('MaterialTransferSlips', [
            'foreignKey' => 'material_transfer_slip_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('MaterialTransferSlipRows', [
            'foreignKey' => 'material_transfer_slip_row_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('Disposers', [
            'className' => 'Employees',
            'foreignKey' => 'disposed_by',
            'joinType' => 'Left'
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

    /*    $validator
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->scalar('opening_balence')
            ->maxLength('opening_balence', 20)
            ->requirePresence('opening_balence', 'create')
            ->notEmpty('opening_balence');

        $validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('is_scrab', 'create')
            ->notEmpty('is_scrab');

        $validator
            ->boolean('disposed_status')
            ->requirePresence('disposed_status', 'create')
            ->notEmpty('disposed_status');

        $validator
            ->requirePresence('disposed_by', 'create')
            ->notEmpty('disposed_by');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->dateTime('disposed_on')
            ->requirePresence('disposed_on', 'create')
            ->notEmpty('disposed_on');

        $validator
            ->boolean('is_transfered')
            ->requirePresence('is_transfered', 'create')
            ->notEmpty('is_transfered');

        $validator
            ->requirePresence('is_used', 'create')
            ->notEmpty('is_used');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');*/

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
        $rules->add($rules->existsIn(['row_material_id'], 'RowMaterials'));
        $rules->add($rules->existsIn(['good_receive_note_id'], 'GoodReceiveNotes'));
        $rules->add($rules->existsIn(['good_receive_note_row_id'], 'GoodReceiveNoteRows'));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        $rules->add($rules->existsIn(['issue_slip_id'], 'IssueSlips'));
        $rules->add($rules->existsIn(['issue_slip_row_id'], 'IssueSlipRows'));
        $rules->add($rules->existsIn(['return_slip_id'], 'ReturnSlips'));
       // $rules->add($rules->existsIn(['return_slip_row_id'], 'ReturnSlipRows'));
        $rules->add($rules->existsIn(['material_transfer_slip_id'], 'MaterialTransferSlips'));
        $rules->add($rules->existsIn(['material_transfer_slip_row_id'], 'MaterialTransferSlipRows'));

        return $rules;
    }
}
