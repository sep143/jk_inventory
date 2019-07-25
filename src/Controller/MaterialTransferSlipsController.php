<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * MaterialTransferSlips Controller
 *
 * @property \App\Model\Table\MaterialTransferSlipsTable $MaterialTransferSlips
 *
 * @method \App\Model\Entity\MaterialTransferSlip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MaterialTransferSlipsController extends AppController
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
    public function index()
    {
      $user_id = $this->Auth->User('id');
        $po_data = $this->MaterialTransferSlips->newEntity();
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
                        $where['MaterialTransferSlips.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['MaterialTransferSlipRows'=>['RowMaterials'=>['Units']],'Employees','Creaters']
          ];
          $materialTransfers=$this->paginate($this->MaterialTransferSlips->find()
          ->where([$where,'MaterialTransferSlips.is_deleted'=>'0','MaterialTransferSlips.created_by'=>$this->Auth->User('id')])->order(['MaterialTransferSlips.id'=>'DESC']));

          if(!empty($materialTransfers->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }
        //$materialTransferSlips = $this->paginate($this->MaterialTransferSlips);
        $companies=$this->MaterialTransferSlips->Companies->get(1,['contain'=> ['States']]);
        $employees = $this->MaterialTransferSlips->Employees->find('list')->where(['Employees.id <>'=>$user_id, 'Employees.is_deleted '=>0]);
        $this->set(compact('employees','materialTransfers','po_data','data_exist','companies'));
    }

    /**
     * View method
     *
     * @param string|null $id Material Transfer Slip id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $materialTransferSlip = $this->MaterialTransferSlips->get($id, [
            'contain' => ['Employees', 'MaterialTransferSlipRows', 'StockLedgers']
        ]);

        $this->set('materialTransferSlip', $materialTransferSlip);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id= null)
    {
        $req_id=$this->request->getQuery('id');

        $materialTransfers=$this->MaterialTransferSlips->RequestSlips->find()
          ->where(['RequestSlips.is_deleted'=>'0','RequestSlips.emp_approve_flag'=>'1','RequestSlips.admin_approve_flag'=>'1','RequestSlips.id'=>$req_id])
          ->contain(['RequestSlipRows'=>'RowMaterials','Employees'])->first();
          $user_id=$materialTransfers->created_by;
          $deptsas=$this->MaterialTransferSlips->Employees->find()->select('department_id')->where(['Employees.id'=>$user_id])->first();
          $department_id=$deptsas->department_id;
        //pr($materialTransfers);exit;
        
        $materialTransferSlip = $this->MaterialTransferSlips->newEntity();

        if ($this->request->is('post')) {
            $materialTransferSlip = $this->MaterialTransferSlips->patchEntity($materialTransferSlip, $this->request->getData());
            //pr($this->request->getData());exit;
            $materialTransferSlip->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $query=$this->MaterialTransferSlips->find();
            $invoice_first=$query->select(['max_value'=>$query->func()->max('voucher_no')])->toArray();
            $materialTransferSlip->voucher_no=$invoice_first[0]->max_value+1;
            $materialTransferSlip->employee_id = $materialTransferSlip->employee_id;
            $materialTransferSlip->created_by = $materialTransferSlip->created_by;
            $emp_id=$materialTransferSlip->employee_id;
            $depts=$this->MaterialTransferSlips->Employees->find()->select('department_id')->where(['Employees.id'=>$emp_id])->first();
            $emp_dept_id=$depts->department_id;
           /* pr($user_id);
            pr($department_id);
            exit;*/
            
            //$department_id = $this->Auth->User('department_id');

            //pr($materialTransferSlip);exit;
            if ($this->MaterialTransferSlips->save($materialTransferSlip))
             {

               foreach ($materialTransferSlip->material_transfer_slip_rows as  $return_slip_row) 
                {
                   
                        $stockledger = $this->MaterialTransferSlips->StockLedgers->newEntity();
                        $stockledger->material_transfer_slip_id=$return_slip_row->material_transfer_slip_id;
                        $stockledger->material_transfer_slip_row_id=$return_slip_row->id;
                        $stockledger->transaction_date=$materialTransferSlip->transaction_date;
                        $stockledger->row_material_id=$return_slip_row->row_material_id;
                        $stockledger->quantity=$return_slip_row->quantity;
                        $stockledger->employee_id=$user_id;
                        $stockledger->department_id=$department_id;
                        $stockledger->created_by=$user_id;
                        $stockledger->status='Out';
                        $stockledger->is_transfered='1';
                        $this->MaterialTransferSlips->StockLedgers->save($stockledger);
                }
                //pr($materialTransferSlip->material_transfer_slip_rows);exit;
                foreach ($materialTransferSlip->material_transfer_slip_rows as  $return_slip_row) 
                {
                   
                        $stockledger = $this->MaterialTransferSlips->StockLedgers->newEntity();
                        $stockledger->material_transfer_slip_id=$return_slip_row->material_transfer_slip_id;
                        $stockledger->material_transfer_slip_row_id=$return_slip_row->id;
                        $stockledger->transaction_date=$materialTransferSlip->transaction_date;
                        $stockledger->row_material_id=$return_slip_row->row_material_id;
                        $stockledger->quantity=$return_slip_row->quantity;
                        $stockledger->employee_id=$materialTransferSlip->employee_id;
                        $stockledger->department_id=$emp_dept_id;
                        $stockledger->created_by=$user_id;
                        $stockledger->status='In';
                        $stockledger->is_transfered='1';
                        
                        $this->MaterialTransferSlips->StockLedgers->save($stockledger);
                        //pr($stockledger);
                }
                //pr($materialTransferSlip);exit;
                $this->Flash->success(__('The material transfer slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The material transfer slip could not be saved. Please, try again.'));
        }
       /* $rowMaterials= $this->MaterialTransferSlips->MaterialTransferSlipRows->RowMaterials->find('list',[
            'keyField' => 'id',
            'valueField' => 'name',
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

       $query=$this->MaterialTransferSlips->MaterialTransferSlipRows->RowMaterials->find();
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
     //   pr($row_material_list->toArray());exit;
        $rowMaterial=[];
        foreach ($row_material_list as $row_materials) {
          $rowMaterial[]=['value' => $row_materials->id,'text' => $row_materials->name.' ('.$row_materials->unit->name.')','current_stock'=>@$row_materials->stock_ledgers[0]->total_in - @$row_materials->stock_ledgers[0]->total_out];
        }
        //pr($rowMaterial);exit;
        $employees = $this->MaterialTransferSlips->Employees->find('list')->where(['Employees.id <>'=>$user_id]);
        $this->set(compact('materialTransferSlip', 'employees','rowMaterial','materialTransfers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Material Transfer Slip id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $materialTransferSlip = $this->MaterialTransferSlips->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $materialTransferSlip = $this->MaterialTransferSlips->patchEntity($materialTransferSlip, $this->request->getData());
            if ($this->MaterialTransferSlips->save($materialTransferSlip)) {
                $this->Flash->success(__('The material transfer slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The material transfer slip could not be saved. Please, try again.'));
        }
        $employees = $this->MaterialTransferSlips->Employees->find('list', ['limit' => 200]);
        $this->set(compact('materialTransferSlip', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Material Transfer Slip id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $id = $this->EncryptingDecrypting->decryptData($id);
        $materialTransferSlip = $this->MaterialTransferSlips->get($id);
        if ($this->MaterialTransferSlips->delete($materialTransferSlip)) {
            $this->Flash->success(__('The material transfer slip has been deleted.'));
        } else {
            $this->Flash->error(__('The material transfer slip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function transferItems()
    {
       
        $po_data = $this->MaterialTransferSlips->newEntity();
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
                        $where['MaterialTransferSlips.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['MaterialTransferSlipRows'=>'RowMaterials','Employees','Creaters']
          ];
          $materialTransfers=$this->paginate($this->MaterialTransferSlips->find()
          ->where([$where,'MaterialTransferSlips.is_deleted'=>'0','MaterialTransferSlips.employee_id'=>$this->Auth->User('id')])->order(['MaterialTransferSlips.id'=>'DESC']));

          if(!empty($materialTransfers->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }
        //$materialTransferSlips = $this->paginate($this->MaterialTransferSlips);
        $employees = $this->MaterialTransferSlips->Employees->find('list');
        $this->set(compact('employees','materialTransfers','po_data','data_exist'));
    }
    public function report()
    {
       
        $po_data = $this->MaterialTransferSlips->newEntity();
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
                        $where['MaterialTransferSlips.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['MaterialTransferSlipRows'=>'RowMaterials','Employees','Creaters']
          ];
          $materialTransfers=$this->paginate($this->MaterialTransferSlips->find()
          ->where([$where,'MaterialTransferSlips.is_deleted'=>'0'])->order(['MaterialTransferSlips.id'=>'DESC']));

          if(!empty($materialTransfers->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }
        //$materialTransferSlips = $this->paginate($this->MaterialTransferSlips);
        $creaters = $this->MaterialTransferSlips->Creaters->find('list');
        $employees = $this->MaterialTransferSlips->Employees->find('list');
        $this->set(compact('employees','materialTransfers','po_data','data_exist','creaters'));
    }
}
