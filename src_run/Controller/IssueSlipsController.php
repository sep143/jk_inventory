<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * IssueSlips Controller
 *
 * @property \App\Model\Table\IssueSlipsTable $IssueSlips
 *
 * @method \App\Model\Entity\IssueSlip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IssueSlipsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($value='')
    {
      $user_id = $this->Auth->User('id');
        $issue_data = $this->IssueSlips->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['get']))
        {
           // pr($this->request->getData('data'));exit;
           if(!empty(@$this->request->query('data'))) 
                {
            //pr($this->request->getData('data'));exit;
                foreach ($this->request->query('data') as $key => $v) 
                  {
                    if(!empty($v))
                    {
                        if (strpos($key, 'transaction_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where['IssueSlips.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['Employees','IssueSlipRows'=>['RowMaterials'=>['Units']]]
          ];
          $issueSlips = $this->paginate($this->IssueSlips->find()->where([$where,'IssueSlips.is_deleted'=>'0','IssueSlips.created_by'=>$this->Auth->User('id')]));
          if(!empty($issueSlips->toArray()))
            {
              $data_exist='data_exist';
            }
          else{
            $data_exist='No Record Found';
          }
      
        }
        
        $companies=$this->IssueSlips->Companies->get(1,['contain'=> ['States']]);
        $employees = $this->IssueSlips->Employees->find('list')->where(['Employees.id <>'=>$user_id, 'Employees.is_deleted '=>0]);
        // pr($issueSlips->toArray()); exit;
        $this->set(compact('issueSlips','employees','issue_data','data_exist','companies'));
    }

    /**
     * View method
     *
     * @param string|null $id Issue Slip id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $issueSlip = $this->IssueSlips->get($id, [
            'contain' => ['Employees', 'IssueSlipRows', 'StockLedgers']
        ]);

        $this->set('issueSlip', $issueSlip);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
        //$this->IssueSlips->StockLedgers->find()->select('quantity');
        $issueSlip = $this->IssueSlips->newEntity();
        if ($this->request->is('post')) {
            $issueSlip = $this->IssueSlips->patchEntity($issueSlip, $this->request->getData());
            $issueSlip->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $query=$this->IssueSlips->find();
            $invoice_first=$query->select(['max_value'=>$query->func()->max('voucher_no')])->toArray();
            $issueSlip->voucher_no=$invoice_first[0]->max_value+1;
            $issueSlip->created_by = $user_id;
            $emp_id=$issueSlip->employee_id;
            $depts=$this->IssueSlips->Employees->find()->select('department_id')->where(['Employees.id'=>$emp_id])->first();
            $emp_dept_id=$depts->department_id;
            // pr($issueSlip); exit;
            if ($this->IssueSlips->save($issueSlip)) {
                
                foreach ($issueSlip->issue_slip_rows as  $issue_slip_row) 
                {
                    $stockledger = $this->IssueSlips->StockLedgers->newEntity();
                    $stockledger->issue_slip_id=$issue_slip_row->issue_slip_id;
                    $stockledger->issue_slip_row_id=$issue_slip_row->id;
                    $stockledger->transaction_date=$issueSlip->transaction_date;
                    $stockledger->row_material_id=$issue_slip_row->row_material_id;
                    $stockledger->quantity=$issue_slip_row->quantity;
                    $stockledger->description=$issue_slip_row->description;
                    $stockledger->created_by=$this->Auth->User('id');
                    $stockledger->department_id=$this->Auth->User('department_id');
                    $stockledger->employee_id=$this->Auth->User('id');

                    //$stockledger->employee_id=$issueSlip->employee_id;
                    $stockledger->status='Out';
                    $this->IssueSlips->StockLedgers->save($stockledger);
                }
                 foreach ($issueSlip->issue_slip_rows as  $issue_slip_row) 
                {
                    $stockledger = $this->IssueSlips->StockLedgers->newEntity();
                    $stockledger->issue_slip_id=$issue_slip_row->issue_slip_id;
                    $stockledger->issue_slip_row_id=$issue_slip_row->id;
                    $stockledger->transaction_date=$issueSlip->transaction_date;
                    $stockledger->row_material_id=$issue_slip_row->row_material_id;
                    $stockledger->quantity=$issue_slip_row->quantity;
                    $stockledger->description=$issue_slip_row->description;
                    $stockledger->department_id=$emp_dept_id;
                    $stockledger->created_by=$this->Auth->User('id');
                    $stockledger->employee_id=$issueSlip->employee_id;
                    $stockledger->status='In';
                    $this->IssueSlips->StockLedgers->save($stockledger);
                }

                $this->Flash->success(__('The issue slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue slip could not be saved. Please, try again.'));
        }
        /*$rowMaterials= $this->IssueSlips->IssueSlipRows->RowMaterials->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
       ]);
       $rowMaterials->select(['id'=>'RowMaterials.id',
            'name'=>$rowMaterials->func()->concat(['
                RowMaterials.name' => 'identifier',
                ' (',
                'Units.name'=> 'identifier',
                ')'
            ])
        ])
       ->contain(['Units']);*/
       
       $query=$this->IssueSlips->IssueSlipRows->RowMaterials->find();
       $row_material_list = $query
       ->contain(['Units','StockLedgers'=>function($query){
          $totalInCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'In','department_id' => $this->Auth->User('department_id')]),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              $totalOutCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'Out','department_id' => $this->Auth->User('department_id')]),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              return $query->select([
                'total_in' => $query->func()->sum($totalInCase),
                'total_out' => $query->func()->sum($totalOutCase),'id','row_material_id'
              ])
              ->group('row_material_id')
              ->enableAutoFields(true); 
          }]);
      //  pr($row_material_list->toArray());exit;
        $rowMaterial=[];
        foreach ($row_material_list as $row_materials) {
          $rowMaterial[]=['value' => $row_materials->id,'text' => $row_materials->name.' ('.$row_materials->unit->name.')','current_stock'=>@$row_materials->stock_ledgers[0]->total_in - @$row_materials->stock_ledgers[0]->total_out];
        }

        $RowMaterialCategory= $this->IssueSlips->IssueSlipRows->RowMaterials->RowMaterialCategories->find('list',[
          'keyField' => 'id',
          'valueField' => 'name',
     ]);
        //pr($rowMaterial);exit;
        $employees = $this->IssueSlips->Employees->find('list')->where(['Employees.id <>'=>$user_id, 'Employees.is_deleted '=>0]);
        $this->set(compact('issueSlip', 'employees','rowMaterials','rowMaterial','RowMaterialCategory'));
    }

    /*
	* category select then meterial get category wise
	*/
	public function meterialShow($cat_id=null){
    $this->viewBuilder()->setLayout('');

    $query=$this->IssueSlips->IssueSlipRows->RowMaterials->find()->where(['row_material_category_id'=>$cat_id]);
       $row_material_list = $query
       ->contain(['Units','StockLedgers'=>function($query){
          $totalInCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'In','department_id' => $this->Auth->User('department_id')]),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              $totalOutCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'Out','department_id' => $this->Auth->User('department_id')]),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              return $query->select([
                'total_in' => $query->func()->sum($totalInCase),
                'total_out' => $query->func()->sum($totalOutCase),'id','row_material_id'
              ])
              ->group('row_material_id')
              ->enableAutoFields(true); 
          }]);
       
        $findDatas=[];
        foreach ($row_material_list as $row_materials) {
          $findDatas[]=['value' => $row_materials->id,'text' => $row_materials->name.' ('.$row_materials->unit->name.')','current_stock'=>@$row_materials->stock_ledgers[0]->total_in - @$row_materials->stock_ledgers[0]->total_out];
        }

   $this->set(compact('findDatas'));
 }

    /**
     * Edit method
     *
     * @param string|null $id Issue Slip id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
        $issueSlip = $this->IssueSlips->get($id, [
            'contain' => []
        ]);
        $issueSlip->edited_by = $user_id;
        $emp_id=$issueSlip->employee_id;
        $depts=$this->IssueSlips->Employees->find()
        ->select('department_id')
        ->where(['Employees.id'=>$emp_id])->first();
        $emp_dept_id=$depts->department_id;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $issueSlip = $this->IssueSlips->patchEntity($issueSlip, $this->request->getData());
             $issueSlip->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            if ($this->IssueSlips->save($issueSlip)) {
                $this->Flash->success(__('The issue slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue slip could not be saved. Please, try again.'));
        }
        $employees = $this->IssueSlips->Employees->find('list', ['limit' => 200]);
        $this->set(compact('issueSlip', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Issue Slip id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $id = $this->EncryptingDecrypting->decryptData($id);
        $issueSlip = $this->IssueSlips->get($id);
        if ($this->IssueSlips->delete($issueSlip)) {
            $this->Flash->success(__('The issue slip has been deleted.'));
        } else {
            $this->Flash->error(__('The issue slip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
     public function disposedMaterialReport($value='')
    {
        $disposed_data = $this->ReturnSlips->StockLedgers->newEntity();
        $where = [];
        if($this->request->is(['post']))
        {
            //pr($this->request->getData('data'));exit;
            foreach ($this->request->getData('data') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'transaction_date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['StockLedgers.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
            $disposedData=$this->ReturnSlips->StockLedgers->find()
            ->where([$where,'StockLedgers.is_scrab'=>'1','StockLedgers.disposed_status'=>'1',])
            ->contain(['RowMaterials'=>'Units','Employees'=>'Departments','Disposers']);
        }
           
            //pr($disposedData->toArray());exit;
            $employees = $this->ReturnSlips->StockLEdgers->Employees->find('list');
            $departments = $this->ReturnSlips->StockLEdgers->Departments->find('list');
            $this->set(compact('disposedData','disposed_data','employees','departments'));
    }
    public function findQuantity($id = null)
    {
        $loginId=$this->Auth->User('id');
        $department_id=$this->Auth->User('department_id');
        $query=$this->IssueSlips->StockLedgers->RowMaterials->find();
        $row_material_list = $query
        ->contain(['Units','StockLedgers'=>function($query){
          $totalInCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'In','department_id' => $this->Auth->User('department_id'),'employee_id'=> $this->Auth->User('id')]),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              $totalOutCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'Out','department_id' => $this->Auth->User('department_id'),'employee_id'=> $this->Auth->User('id')]),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              return $query->select([
                'total_in' => $query->func()->sum($totalInCase),
                'total_out' => $query->func()->sum($totalOutCase),'id','row_material_id'
              ])
              ->group('row_material_id')
              ->enableAutoFields(true); 
            }]);
        pr($row_material_list->toArray());exit;
        //$mystocks=$this->IssueSlips->StockLedgers->find()->where(['StockLedgers.employee_id'=>$loginId,'StockLedgers.department_id'=>$department_id,'StockLedgers.status'=>'In'])->contain(['RowMaterials']);
        //pr($mystocks->toArray());exit;
        $this->set(compact('row_material_list')); 

    }
     public function employeeStock()
    {
        $loginId=$this->Auth->User('id');
        $department_id=$this->Auth->User('department_id');
        $query=$this->IssueSlips->StockLedgers->RowMaterials->find();
        $row_material_list = $query
        ->contain(['Units','StockLedgers'=>function($query){
          $totalInCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'In','department_id' => $this->Auth->User('department_id'),'employee_id'=> $this->Auth->User('id')]),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              $totalOutCase = $query->newExpr()
              ->addCase(
                 $query->newExpr()->add(['status' => 'Out','department_id' => $this->Auth->User('department_id'),'employee_id'=> $this->Auth->User('id')]),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              return $query->select([
                'total_in' => $query->func()->sum($totalInCase),
                'total_out' => $query->func()->sum($totalOutCase),'id','row_material_id'
              ])
              ->group('row_material_id')
              ->enableAutoFields(true); 
            }]);
        //pr($row_material_list->toArray());exit;
        //$mystocks=$this->IssueSlips->StockLedgers->find()->where(['StockLedgers.employee_id'=>$loginId,'StockLedgers.department_id'=>$department_id,'StockLedgers.status'=>'In'])->contain(['RowMaterials']);
        //pr($mystocks->toArray());exit;
        $this->set(compact('row_material_list')); 
    }
    public function report($value='')
    {
       
        $issue_data = $this->IssueSlips->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['get']))
        {
           // pr($this->request->getData('data'));exit;
           if(!empty(@$this->request->query('data'))) 
                {
            //pr($this->request->getData('data'));exit;
                foreach ($this->request->query('data') as $key => $v) 
                  {
                    if(!empty($v))
                    {
                        if (strpos($key, 'transaction_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where['IssueSlips.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['Employees','IssueSlipRows'=>['RowMaterials'=>['Units']]]
          ];
          $issueSlips = $this->paginate($this->IssueSlips->find()->where([$where,'IssueSlips.is_deleted'=>'0']));
          if(!empty($issueSlips->toArray()))
            {
              $data_exist='data_exist';
            }
          else{
            $data_exist='No Record Found';
          }
      
        }

        $companies=$this->IssueSlips->Companies->get(1,['contain'=> ['States']]);
        $employees = $this->IssueSlips->Employees->find('list');
        $this->set(compact('issueSlips','employees','issue_data','data_exist','companies'));
    }
}
