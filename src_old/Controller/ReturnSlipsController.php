<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * ReturnSlips Controller
 *
 * @property \App\Model\Table\ReturnSlipsTable $ReturnSlips
 *
 * @method \App\Model\Entity\ReturnSlip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReturnSlipsController extends AppController
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

        $return_data = $this->ReturnSlips->newEntity();
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
                        $where['ReturnSlips.'.$key] = $v;
                    }
                  }
                }
        $this->set(compact('where'));
        $this->paginate = [
            'contain' => ['Employees','ReturnSlipRows'=>'RowMaterials']
        ];
        $returnSlips = $this->paginate($this->ReturnSlips->find()->where([$where,'ReturnSlips.is_deleted'=>'0','ReturnSlips.created_by'=>$this->Auth->User('id')]));
        if(!empty($returnSlips->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }
        
        $employees = $this->ReturnSlips->Employees->find('list');
        $this->set(compact('returnSlips','employees','return_data','data_exist'));
    }

    /**
     * View method
     *
     * @param string|null $id Return Slip id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $returnSlip = $this->ReturnSlips->get($id, [
            'contain' => ['Employees', 'ReturnSlipRows', 'StockLedgers']
        ]);

        $this->set('returnSlip', $returnSlip);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id= null)
    {
        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
              $employee_id=$this->request->getQuery('employee-id');
                //pr($employee_id);exit;
                $stockledgerData = $this->ReturnSlips->StockLedgers->find()->where(['StockLedgers.employee_id' => $employee_id]);
                
                $this->loadModel('StockLedgers');

                $query=$this->StockLedgers->find()->where(['employee_id' =>$employee_id]);
                $totalInCase = $query->newExpr()
                  ->addCase(
                    $query->newExpr()->add(['status' => 'In','employee_id' =>$employee_id]),
                    $query->newExpr()->add(['quantity']),
                    'integer'
                  );
                $totalOutCase = $query->newExpr()
                  ->addCase(
                    $query->newExpr()->add(['status' => 'Out','employee_id' =>$employee_id]),
                    $query->newExpr()->add(['quantity']),
                    'integer'
                  );
                 $query->select([
                    'return_slip_id',
                    'total_in' => $query->func()->sum($totalInCase),
                    'total_out' => $query->func()->sum($totalOutCase),'id','row_material_id'
                  ])
                 ->group('row_material_id')
                 ->contain(['RowMaterials'])
                 ->enableAutoFields(true); 
                //pr($query->toArray());exit;
            $this->set(compact('query','employee_id'));
            $returnSlip = $this->ReturnSlips->newEntity();

          if ($this->request->is('post')) {
            $returnSlip = $this->ReturnSlips->patchEntity($returnSlip, $this->request->getData());
            //pr($this->request->getData());exit;
            $returnSlip->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $query=$this->ReturnSlips->find();
            $invoice_first=$query->select(['max_value'=>$query->func()->max('voucher_no')])->toArray();
            $returnSlip->voucher_no=$invoice_first[0]->max_value+1;
            $returnSlip->employee_id = $returnSlip->employee_id;
            $returnSlip->created_by = $user_id;
            $emp_id=$returnSlip->employee_id;
           // pr($emp_id);exit;
            $depts=$this->ReturnSlips->Employees->find()->select('department_id')->where(['Employees.id'=>$emp_id])->first();
            
            $emp_dept_id=$depts->department_id;
            //pr($returnSlip);exit;
            if ($this->ReturnSlips->save($returnSlip)) {
                foreach ($returnSlip->return_slip_rows as  $return_slip_row) 
                {
                    if($return_slip_row->return_scrab=='Return') 
                    {
                        $stockledger = $this->ReturnSlips->StockLedgers->newEntity();
                        $stockledger->return_slip_id=$return_slip_row->return_slip_id;
                        $stockledger->return_slip_row_id=$return_slip_row->id;
                        $stockledger->transaction_date=$returnSlip->transaction_date;
                        $stockledger->row_material_id=$return_slip_row->row_material_id;
                        $stockledger->quantity=$return_slip_row->quantity;
                        $stockledger->description=$return_slip_row->description;
                        $stockledger->created_by=$this->Auth->User('id');
                        $stockledger->department_id=$this->Auth->User('department_id');
                        $stockledger->employee_id=$this->Auth->User('id');
                        $stockledger->status='In';
                        $this->ReturnSlips->StockLedgers->save($stockledger);
                    }
                    if($return_slip_row->return_scrab=='Scrape') 
                    {
                    $stockledger = $this->ReturnSlips->StockLedgers->newEntity();
                    $stockledger->return_slip_id=$return_slip_row->return_slip_id;
                    $stockledger->return_slip_row_id=$return_slip_row->id;
                    $stockledger->transaction_date=$returnSlip->transaction_date;
                    $stockledger->row_material_id=$return_slip_row->row_material_id;
                    $stockledger->quantity=$return_slip_row->quantity;
                    $stockledger->description=$return_slip_row->description;
                    $stockledger->created_by=$this->Auth->User('id');
                    $stockledger->department_id=$this->Auth->User('department_id');
                    $stockledger->employee_id=$this->Auth->User('id');
                    if($return_slip_row->return_scrab=='Scrape') {
                       $stockledger->is_scrab='1';
                    }
                    $stockledger->status='In';
                    $this->ReturnSlips->StockLedgers->save($stockledger);

                    }

                }
                foreach ($returnSlip->return_slip_rows as  $return_slip_row) 
                {
                    $stockledger = $this->ReturnSlips->StockLedgers->newEntity();
                    $stockledger->return_slip_id=$return_slip_row->return_slip_id;
                    $stockledger->return_slip_row_id=$return_slip_row->id;
                    $stockledger->transaction_date=$returnSlip->transaction_date;
                    $stockledger->row_material_id=$return_slip_row->row_material_id;
                    $stockledger->quantity=$return_slip_row->quantity;
                    $stockledger->description=$return_slip_row->description;
                    $stockledger->department_id=$emp_dept_id;
                    $stockledger->employee_id=$returnSlip->employee_id;
                    $stockledger->created_by=$user_id;
                     if($return_slip_row->return_scrab=='Scrape') {
                       $stockledger->is_scrab='1';
                    }
                    $stockledger->status='Out';
                    $this->ReturnSlips->StockLedgers->save($stockledger);
                }
                $this->Flash->success(__('The return slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The return slip could not be saved. Please, try again.'));
        }

            $returnaction=['Return'=>'Return','Scrape'=>'Scrape'];
            $employees = $this->ReturnSlips->Employees->find('list')->where(['Employees.id <>'=>$user_id]);
        $this->set(compact('returnSlip', 'employees','returnaction','rowMaterial'));
    }
    public function returnSearchEmp()
    {
          $user_id = $this->Auth->User('id');
          $department_id = $this->Auth->User('department_id');
          if ($this->request->getQuery()) 
            {
                //pr($this->request->query('employee_id'));exit;
                $employee_id=$this->request->getQuery('employee_id');
                return $this->redirect(['action' => 'add?employee_id='.$employee_id]);
            }
        
          $employees = $this->ReturnSlips->Employees->find('list')->where(['Employees.id <>'=>$user_id]);
          $this->set(compact('employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Return Slip id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
        //$employee_id=$this->request->getQuery('employee-id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $returnSlip = $this->ReturnSlips->get($id, [
            'contain' => ['Employees']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $returnSlip = $this->ReturnSlips->patchEntity($returnSlip, $this->request->getData());
            if ($this->ReturnSlips->save($returnSlip)) {
                $this->Flash->success(__('The return slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The return slip could not be saved. Please, try again.'));
        }
        $employees = $this->ReturnSlips->Employees->find('list', ['limit' => 200]);
        $this->set(compact('returnSlip', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Return Slip id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $id = $this->EncryptingDecrypting->decryptData($id);
        $returnSlip = $this->ReturnSlips->get($id);
        if ($this->ReturnSlips->delete($returnSlip)) {
            $this->Flash->success(__('The return slip has been deleted.'));
        } else {
            $this->Flash->error(__('The return slip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
     public function scrabApproval()
    {
        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
        $scrabs=$this->ReturnSlips->StockLedgers->find()
        ->where(['StockLedgers.is_scrab'=>'1','StockLedgers.status'=>'Out'])
        ->contain(['RowMaterials','Employees','Departments']);
        $disposed_on=date('Y-m-d H:i:s');
        $user_id = $this->Auth->User('id');
        if ($this->request->is('post')) 
            {
                $scrab_id=$this->request->getData('scrab_id');
                if(!empty($scrab_id))
                 {
                    $query = $this->ReturnSlips->StockLedgers->query();
                    $result = $query->update()
                    ->set(['disposed_status' => '1','disposed_by'=>$user_id,'disposed_on'=>$disposed_on])
                    ->where(['id' =>$scrab_id ])
                    ->execute();
                    $this->Flash->success(__('This Material has been disposed.'));
                     return $this->redirect(['action' => 'scrabApproval']);
                 }
            }
        //pr($scrabs->toArray());exit;
        $this->set(compact('scrabs'));
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
    public function scrabMaterialReport($value='')
    {
        $scrab_data = $this->ReturnSlips->StockLedgers->newEntity();
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
             $scrabs=$this->ReturnSlips->StockLedgers->find()
            ->where([$where,'StockLedgers.is_scrab'=>'1','StockLedgers.disposed_status'=>'0',])
            ->contain(['RowMaterials'=>'Units','Employees'=>'Departments','Disposers']);
        }
       
        //pr($where);exit;
        $employees = $this->ReturnSlips->StockLEdgers->Employees->find('list');
        $departments = $this->ReturnSlips->StockLEdgers->Departments->find('list');
        $this->set(compact('scrabs','employees','departments','scrab_data'));
    }
    public function scrabExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        $scrabs=$this->ReturnSlips->StockLedgers->find()
        ->where(['StockLedgers.is_scrab'=>'1','StockLedgers.disposed_status'=>'0',])
        ->contain(['RowMaterials'=>'Units','Employees'=>'Departments','Disposers']);
        
        $this->set(compact('scrabs'));
    }
    public function disposedExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        // $bookIssueReturns = $this->BookIssueReturns->find()->where($this->request->getData('BookIssueReturns'))->contain(['Books', 'Students', 'SessionYears', 'Employees']);
        $disposedDatas=$this->ReturnSlips->StockLedgers->find()
        ->where([$this->request->getData('ReturnSlips'),'StockLedgers.is_scrab'=>'1','StockLedgers.disposed_status'=>'1',])
        ->contain(['RowMaterials'=>'Units','Employees'=>'Departments','Disposers']);
        
        $this->set(compact('disposedDatas'));
    }
    //for new return purpose //
    public function returnMaterial($value='')
    {
        $this->paginate = [
            'contain' => ['Employees','ReturnSlipRows'=>'RowMaterials']
        ];

        $return_data = $this->ReturnSlips->newEntity();
        $where = [];
        if($this->request->is(['post']))
        {
           // pr($this->request->getData('data'));exit;
            foreach ($this->request->getData('data') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'transaction_date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['ReturnSlips.'.$key] = $v;
                }
            }
        $this->set(compact('where'));
      
        }

        $returnSlips = $this->paginate($this->ReturnSlips->find()->where([$where,'ReturnSlips.is_deleted'=>'0']));
        $employees = $this->ReturnSlips->Employees->find('list');
        $this->set(compact('returnSlips','employees','return_data'));
    }
  
    public function report($value='')
    {
        $return_data = $this->ReturnSlips->newEntity();
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
                        $where['ReturnSlips.'.$key] = $v;
                    }
                  }
                }
        $this->set(compact('where'));
        $this->paginate = [
            'contain' => ['Employees','ReturnSlipRows'=>'RowMaterials']
        ];
        $returnSlips = $this->paginate($this->ReturnSlips->find()->where([$where,'ReturnSlips.is_deleted'=>'0']));
        if(!empty($returnSlips->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }
        $employees = $this->ReturnSlips->Employees->find('list');
        $this->set(compact('returnSlips','employees','return_data','data_exist'));
    }
    public function stockRegisterReport($value='')
    {
        $stock_register = $this->ReturnSlips->StockLedgers->newEntity();
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
            //pr($where);exit;
            $this->set(compact('where'));
            $StockDatas=$this->ReturnSlips->StockLedgers->find()
            ->where([$where,'StockLedgers.is_scrab'=>'0','StockLedgers.disposed_status'=>'0','StockLedgers.department_id'=>$this->Auth->User('department_id')])
            ->contain(['Departments','RowMaterials'=>['Units']])->toArray();
            //pr($StockDatas->toArray());exit;

            if(!empty($StockDatas))
            {
              $data_exist='data_exist';
            }
            else{
            $data_exist='No Record Found';
            }
            
        }
        
        $rowMaterials = $this->ReturnSlips->StockLEdgers->RowMaterials->find('list');
        $this->set(compact('StockDatas','stock_register','rowMaterials','data_exist'));
    }
     public function mainstockRegisterExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        $user_id=$this->Auth->User('id');
        $department_id=$this->Auth->User('department_id');
       // pr($this->request->getData('StockLedgers'));exit;

        $StockDatas = $this->ReturnSlips->StockLedgers->find()
        ->where([$this->request->getData('StockLedgers'),'StockLedgers.is_scrab'=>'0','
            StockLedgers.disposed_status'=>'0',
            'StockLedgers.department_id'=>$department_id])
        ->contain(['Departments','RowMaterials'=>['Units'],'Employees'=>['Departments']]);

        $this->set(compact('StockDatas'));
    }
    
}
