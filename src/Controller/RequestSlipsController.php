<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * RequestSlips Controller
 *
 * @property \App\Model\Table\RequestSlipsTable $RequestSlips
 *
 * @method \App\Model\Entity\RequestSlip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequestSlipsController extends AppController
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
       // pr($this->Auth->User('id'));exit;
        $po_data = $this->RequestSlips->newEntity();
        $where = [];
        $data_exist='';
         if($this->request->is(['get']))
        {
           // pr($this->request->getQuery('data'));exit;
           if(!empty(@$this->request->getQuery('data'))) 
                {
            //pr($this->request->getData('data'));exit;
                foreach ($this->request->getQuery('data') as $key => $v) 
                  {
                    if(!empty($v))
                    {
                        if (strpos($key, 'transaction_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where['RequestSlips.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['RequestSlipRows'=>'RowMaterials','Employees','Creaters']
          ];
          $materialTransfers=$this->paginate($this->RequestSlips->find()
          ->where([$where,'RequestSlips.is_deleted'=>'0','RequestSlips.created_by'=>$this->Auth->User('id')])->order(['RequestSlips.id'=>'DESC']));

          if(!empty($materialTransfers->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }
        //$materialTransferSlips = $this->paginate($this->MaterialTransferSlips);
        $employees = $this->RequestSlips->Employees->find('list');
        $companies=$this->RequestSlips->Companies->get(1,['contain'=> ['States']]);
        $this->set(compact('employees','materialTransfers','po_data','data_exist','companies'));
    }

    /**
     * View method
     *
     * @param string|null $id Request Slip id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestSlip = $this->RequestSlips->get($id, [
            'contain' => ['Employees', 'RequestSlipRows']
        ]);

        $this->set('requestSlip', $requestSlip);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /*$requestSlip = $this->RequestSlips->newEntity();
        if ($this->request->is('post')) {
            $requestSlip = $this->RequestSlips->patchEntity($requestSlip, $this->request->getData());
            if ($this->RequestSlips->save($requestSlip)) {
                $this->Flash->success(__('The request slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request slip could not be saved. Please, try again.'));
        }
        $employees = $this->RequestSlips->Employees->find('list', ['limit' => 200]);
        $this->set(compact('requestSlip', 'employees'));*/

        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
        $requestSlip = $this->RequestSlips->newEntity();

        if ($this->request->is('post')) {
            $requestSlip = $this->RequestSlips->patchEntity($requestSlip, $this->request->getData());
            $requestSlip->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $query=$this->RequestSlips->find();
            $invoice_first=$query->select(['max_value'=>$query->func()->max('voucher_no')])->toArray();
            $requestSlip->voucher_no=$invoice_first[0]->max_value+1;
            $requestSlip->employee_id = $requestSlip->employee_id;
            $requestSlip->created_by = $user_id;
            $emp_id=$requestSlip->employee_id;
            $depts=$this->RequestSlips->Employees->find()->select('department_id')->where(['Employees.id'=>$emp_id])->first();
            $emp_dept_id=$depts->department_id;
            //pr($requestSlip);exit;
            if ($this->RequestSlips->save($requestSlip))
             {

                $this->Flash->success(__('The request slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request slip could not be saved. Please, try again.'));
        }
  

       $query=$this->RequestSlips->RequestSlipRows->RowMaterials->find();
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
        $rowMaterial=[];
        foreach ($row_material_list as $row_materials) {
          $rowMaterial[]=['value' => $row_materials->id,'text' => $row_materials->name.' ('.$row_materials->unit->name.')','current_stock'=>@$row_materials->stock_ledgers[0]->total_in - @$row_materials->stock_ledgers[0]->total_out];
        }
        $RowMaterialCategory= $this->RequestSlips->RequestSlipRows->RowMaterials->RowMaterialCategories->find('list',[
          'keyField' => 'id',
          'valueField' => 'name',
     ]);
        //pr($rowMaterial);exit;
        $employees = $this->RequestSlips->Employees->find('list')->where(['Employees.id <>'=>$user_id, 'Employees.is_deleted '=>0]);
        $this->set(compact('requestSlip', 'employees','rowMaterial','RowMaterialCategory'));

    }

      /*
	* category select then meterial get category wise
	*/
	public function meterialShow($cat_id=null){
    $this->viewBuilder()->setLayout('');
   $findDatas =  $this->RequestSlips->RequestSlipRows->RowMaterials->find('list')->where(['row_material_category_id'=>$cat_id]);
   $this->set(compact('findDatas'));
 }

    /**
     * Edit method
     *
     * @param string|null $id Request Slip id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestSlip = $this->RequestSlips->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestSlip = $this->RequestSlips->patchEntity($requestSlip, $this->request->getData());
            if ($this->RequestSlips->save($requestSlip)) {
                $this->Flash->success(__('The request slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request slip could not be saved. Please, try again.'));
        }
        $employees = $this->RequestSlips->Employees->find('list', ['limit' => 200]);
        $this->set(compact('requestSlip', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Request Slip id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $id = $this->EncryptingDecrypting->decryptData($id);
        $requestSlip = $this->RequestSlips->get($id);
        if ($this->RequestSlips->delete($requestSlip)) {
            $this->Flash->success(__('The request slip has been deleted.'));
        } else {
            $this->Flash->error(__('The request slip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function requestApprovalEmployee()
    {
        //pr($this->Auth->User('id'));exit;
        $po_data = $this->RequestSlips->newEntity();
        $where = [];
        $data_exist='';
         if($this->request->is(['get']))
        {
            //pr($this->request->getQuery('data'));exit;
           if(!empty(@$this->request->getQuery('data'))) 
                {
            //pr($this->request->getData('data'));exit;
                foreach ($this->request->getQuery('data') as $key => $v) 
                  {
                    if(!empty($v))
                    {
                        if (strpos($key, 'transaction_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where['RequestSlips.'.$key] = $v;
                    }
                  }
                }

          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['RequestSlipRows'=>'RowMaterials','Employees','Creaters']
          ];
          //pr($where);exit;
          $materialTransfers=$this->paginate($this->RequestSlips->find()
          ->where([$where,'RequestSlips.is_deleted'=>'0'])->order(['RequestSlips.id'=>'DESC']));

          if(!empty($materialTransfers->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }

         if ($this->request->is('post')) 
            {
                $accept_request_id=$this->request->getData('accept_request_id');
                $reject_request_id=$this->request->getData('reject_request_id');
                $approve_comment=$this->request->getData('approve_comment');
                $reject_comment=$this->request->getData('reject_comment');
                /*pr($approve_comment);
                pr($reject_comment);exit;*/
                $approved_on=date('Y-m-d H:i:s');

                if(!empty($accept_request_id))
                 {
                    $query = $this->RequestSlips->find()->where(['RequestSlips.is_deleted'=>'0']);
                    $result = $query->update()
                    ->set(['emp_approve_flag' => '1','emp_approved_on'=>$approved_on,'emp_comment'=>$approve_comment])
                    ->where(['id' =>$accept_request_id ])
                    ->execute();
                    $this->Flash->success(__('This request slip has been approved.'));
                     return $this->redirect(['action' => 'requestApprovalEmployee']);
                 }
                  if(!empty($reject_request_id))
                 {
                     $query = $this->RequestSlips->find()->where(['RequestSlips.is_deleted'=>'0']);
                    $result = $query->update()
                     ->set(['emp_approve_flag' => '2','emp_approved_on'=>$approved_on,'emp_comment'=>$reject_comment])
                    ->where(['id' =>$reject_request_id ])
                    ->execute();
                    $this->Flash->error(__('This request slip has been rejected.'));
                     return $this->redirect(['action' => 'requestApprovalEmployee']);
                 }
            }


        //$materialTransferSlips = $this->paginate($this->MaterialTransferSlips);
        $employees = $this->RequestSlips->Employees->find('list');
        $status=['1'=>'Approved','2'=>'Rejected','3'=>'Pending'];
        $this->set(compact('employees','materialTransfers','po_data','data_exist','status'));
    }

    public function requestApprovalAdmin()
    {
       // pr($this->Auth->User('id'));exit;
        $po_data = $this->RequestSlips->newEntity();
        $where = [];
        $data_exist='';
         if($this->request->is(['get']))
        {
            //pr($this->request->getQuery('data'));exit;
           if(!empty(@$this->request->getQuery('data'))) 
                {
            //pr($this->request->getData('data'));exit;
                foreach ($this->request->getQuery('data') as $key => $v) 
                  {
                    if(!empty($v))
                    {
                        if (strpos($key, 'transaction_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where['RequestSlips.'.$key] = $v;
                    }
                  }
                }

          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['RequestSlipRows'=>'RowMaterials','Employees','Creaters']
          ];
          //pr($where);exit;
          $materialTransfers=$this->paginate($this->RequestSlips->find()
          ->where([$where,'RequestSlips.is_deleted'=>'0','RequestSlips.emp_approve_flag'=>'1'])->order(['RequestSlips.id'=>'DESC']));

          if(!empty($materialTransfers->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }

         if ($this->request->is('post')) 
            {
                $accept_request_id=$this->request->getData('accept_request_id');
                $reject_request_id=$this->request->getData('reject_request_id');
                $approve_comment=$this->request->getData('approve_comment');
                $reject_comment=$this->request->getData('reject_comment');
                /*pr($approve_comment);
                pr($reject_comment);exit;*/
                $approved_on=date('Y-m-d H:i:s');

                if(!empty($accept_request_id))
                 {


                    $query = $this->RequestSlips->find()->where(['RequestSlips.is_deleted'=>'0']);
                    $result = $query->update()
                    ->set(['admin_approve_flag' => '1','admin_approve_on'=>$approved_on,'admin_comment'=>$approve_comment])
                    ->where(['id' =>$accept_request_id ])
                    ->execute();
                    //pr($requestDatas->toArray());exit;
                    $this->Flash->success(__('This request slip has been approved.'));
                    /*return $this->redirect(['Controller'=>'MaterialTransferSlips''action' => 'add','id'=>$accept_request_id]);*/
                    $this->redirect('/MaterialTransferSlips/add?id='.$accept_request_id);
                 }
                  if(!empty($reject_request_id))
                 {
                     $query = $this->RequestSlips->find()->where(['RequestSlips.is_deleted'=>'0']);
                    $result = $query->update()
                     ->set(['admin_approve_flag' => '2','admin_approve_on'=>$approved_on,'admin_comment'=>$reject_comment])
                    ->where(['id' =>$reject_request_id ])
                    ->execute();
                    $this->Flash->error(__('This request slip has been rejected.'));
                    return $this->redirect(['action' => 'requestApprovalAdmin']);
                 }
            }


        //$materialTransferSlips = $this->paginate($this->MaterialTransferSlips);
        $employees = $this->RequestSlips->Employees->find('list');
        $status=['1'=>'Approved','2'=>'Rejected','3'=>'Pending'];
        $this->set(compact('employees','materialTransfers','po_data','data_exist','status'));
    }

}
