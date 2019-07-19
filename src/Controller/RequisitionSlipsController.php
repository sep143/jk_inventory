<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * RequisitionSlips Controller
 *
 * @property \App\Model\Table\RequisitionSlipsTable $RequisitionSlips
 *
 * @method \App\Model\Entity\RequisitionSlip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequisitionSlipsController extends AppController
{
   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit','adminEdit']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
     
    public function file()
    {
        $user_id = $this->Auth->User('id');
        $new=$this->RequisitionSlips->RequisitionSlipRows->newEntity();

        $url=$this->request->here();
            $url=parse_url($url,PHP_URL_QUERY);
            $status=$this->request->query('status'); 
        if(!empty($status)){ 
            $this->viewBuilder()->layout('excel_layout');	
        }

            $row_id = $this->request->query('row_material_id');
            $from=$this->request->query('from');
            $to=$this->request->query('to');

            $where=[];$where1=[];
            if(!empty($from)){
                 $where['RequisitionSlips.transaction_date >='] = date('Y-m-d', strtotime($from));

            }
            if(!empty($to)){
                 $where['RequisitionSlips.transaction_date <='] = date('Y-m-d', strtotime($to));

            }

            if(!empty($row_id)){
                 $where1['RequisitionSlipRows.row_material_id'] = $row_id;

            }
           
        if(!empty($where) || !empty($where1)){    

        $requisitionSlip=$this->RequisitionSlips->RequisitionSlipRows->find()->where($where1)
        ->contain(['RequisitionSlips','RowMaterials']);
        foreach($requisitionSlip as $req)
        {
            $row_material_id=$req->row_material_id;
            $department_id=$this->Auth->User('department_id');
            $query=$this->RequisitionSlips->RequisitionSlipRows->RowMaterials->find();
            
             $row_material_list = $query
                     ->contain(['Units','StockLedgers'=>function($query)use($department_id,$row_material_id){
                      $totalInCase = $query->newExpr()
                         ->addCase(
                            $query->newExpr()->add(['status' => 'In','department_id'=>$department_id,'row_material_id'=>$row_material_id]),
                            $query->newExpr()->add(['quantity']),
                            'integer'
                          );
                          $totalOutCase = $query->newExpr()
                          ->addCase(
                             $query->newExpr()->add(['status' => 'Out','department_id'=>$department_id,'row_material_id'=>$row_material_id]),
                            $query->newExpr()->add(['quantity']),
                            'integer'
                          );
                          return $query->select([
                        'total_in' => $query->func()->sum($totalInCase),
                        'total_out' => $query->func()->sum($totalOutCase),'id','row_material_id'
                      ])
                      //->group('row_material_id')
                      ->enableAutoFields(true); 
                }]);
                
                    $returns=$this->RequisitionSlips->RequisitionSlipRows->RowMaterials->ReturnSlipRows->find()->where(['row_material_id'=>$row_material_id])->contain(['ReturnSlips']);
                           
       
        }
    }
        //  
        $rowMaterials=$this->RequisitionSlips->RequisitionSlipRows->RowMaterials->find('list');
        $companies=$this->RequisitionSlips->Companies->get(1,['contain'=> ['States']]);
        $this->set(compact('requisitionSlip','row_material_list','returns','rowMaterials','new','url','status','companies'));
    }


    
    public function index($value='')
    {
         
        $requisition_data = $this->RequisitionSlips->newEntity();
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
                        $where['RequisitionSlips.'.$key] = $v;
                    }
                  }
                }
            $this->set(compact('where'));
             $this->paginate = [
            'contain' => ['RequisitionSlipRows'=>'RowMaterials','Creaters','Approvers']];

            $requisitionSlips= $this->paginate($this->RequisitionSlips->find()
            ->where([$where,'RequisitionSlips.is_deleted'=>'0','RequisitionSlips.created_by'=>$this->Auth->User('id')]));
            if(!empty($requisitionSlips->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }       
        
        }//$requisitionSlips = $this->paginate($this->RequisitionSlips->find()->where(['RequisitionSlips.is_deleted'=>'0']));
        //pr($requisitionSlips->toarray());exit;
        //$empfff = $this->RequisitionSlips->Creaters->find('list')->where(['Creaters.is_deleted'=>'0']);
        $companies=$this->RequisitionSlips->Companies->get(1,['contain'=> ['States']]);
        $this->set(compact('requisitionSlips','empfff','requisition_data','data_exist','companies'));
    }
    
    /**
     * View method
     *
     * @param string|null $id Requisition Slip id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requisitionSlip = $this->RequisitionSlips->get($id, [
            'contain' => []
        ]);

        $this->set('requisitionSlip', $requisitionSlip);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {		
		$user_id = $this->Auth->User('id');
        $requisitionSlip = $this->RequisitionSlips->newEntity();
        if ($this->request->is('post')) {
            $requisitionSlip = $this->RequisitionSlips->patchEntity($requisitionSlip, $this->request->getData());
            
            $requisitionSlip->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $query=$this->RequisitionSlips->find();
            $invoice_first=$query->select(['max_value'=>$query->func()->max('voucher_no')])->toArray();
            $requisitionSlip->voucher_no=$invoice_first[0]->max_value+1;
            $requisitionSlip->status = 'Pending';
            $requisitionSlip->created_by = $user_id;
            //pr($requisitionSlip);exit;
            if ($this->RequisitionSlips->save($requisitionSlip)) {
                $this->Flash->success(__('The requisition slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requisition slip could not be saved. Please, try again.'));
        }
       $rowMaterials= $this->RequisitionSlips->RequisitionSlipRows->RowMaterials->find('list',[
            'keyField' => 'id',
            'valueField' => 'name',
       ]);
	   
	   $RowMaterialCategory= $this->RequisitionSlips->RequisitionSlipRows->RowMaterials->RowMaterialCategories->find('list',[
            'keyField' => 'id',
            'valueField' => 'name',
       ]);
	   
	  // pr($RowMaterialCategory->toArray());exit;
       $rowMaterials->select(['id'=>'RowMaterials.id',
            'name'=>$rowMaterials->func()->concat(['
                RowMaterials.name' => 'identifier',
                ' (',
                'Units.name'=> 'identifier',
                ')'
            ])
        ])
       ->contain(['Units']);
        $this->set(compact('requisitionSlip','rowMaterials','RowMaterialCategory'));
    }
	
	/*
	* category select then meterial get category wise
	*/
	public function meterialShow($cat_id=null){
		 $this->viewBuilder()->setLayout('');
		$findDatas =  $this->RequisitionSlips->RequisitionSlipRows->RowMaterials->find('list')->where(['row_material_category_id'=>$cat_id]);
		$this->set(compact('findDatas'));
	}

    /**
     * Edit method
     *
     * @param string|null $id Requisition Slip id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $requisitionSlip = $this->RequisitionSlips->get($id, [
            'contain' => ['RequisitionSlipRows']
        ]);
       // pr($requisitionSlip);exit;
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $requisitionSlip = $this->RequisitionSlips->patchEntity($requisitionSlip, $this->request->getData());
           // pr($this->request->getData());exit;
            $requisitionSlip->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $requisitionSlip->status = 'Pending';
            $requisitionSlip->edited_by = $user_id;
           // pr($requisitionSlip);exit;
            if ($this->RequisitionSlips->save($requisitionSlip)) {
                $this->Flash->success(__('The requisition slip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requisition slip could not be saved. Please, try again.'));
        }
         $rowMaterials= $this->RequisitionSlips->RequisitionSlipRows->RowMaterials->find('list',[
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
       ->contain(['Units']);
       //pr($requisitionSlip);exit;
        $status=['1'=>'Deactive','0'=>'Active'];
        $this->set(compact('requisitionSlip','rowMaterials','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Requisition Slip id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requisitionSlip = $this->RequisitionSlips->get($id);
        if ($this->RequisitionSlips->delete($requisitionSlip)) {
            $this->Flash->success(__('The requisition slip has been deleted.'));
        } else {
            $this->Flash->error(__('The requisition slip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function reqListApproval()
    {
        $user_id = $this->Auth->User('id');
        if ($this->request->is('post')) 
            {
                $accept_request_id=$this->request->getData('accept_request_id');
                $reject_request_id=$this->request->getData('reject_request_id');
                $approve_comment=$this->request->getData('approve_comment');
                $reject_comment=$this->request->getData('reject_comment');
                /*pr($approve_comment);
                pr($reject_comment);exit;*/
                $approved_on=date('Y-m-d H:i:s');
                /*if(!empty($hold_request_id))
                 {
                    $query = $this->RequisitionSlips->query();
                    $result = $query->update()
                    ->set(['status' => 'Hold','edited_by'=>$user_id])
                    ->where(['id' =>$hold_request_id ])
                    ->execute();
                    $this->Flash->success(__('The hostel out pass has been updated.'));
                     return $this->redirect(['action' => 'index']);
                 }*/

                if(!empty($accept_request_id))
                 {
                    $query = $this->RequisitionSlips->find()->where(['RequisitionSlips.is_deleted'=>'0']);
                    $result = $query->update()
                    ->set(['status' => 'Approved','approved_by'=>$user_id,'approved_on'=>$approved_on,'admin_comment'=>$approve_comment])
                    ->where(['id' =>$accept_request_id ])
                    ->execute();
                    $this->Flash->success(__('The requisition slip has been approved.'));
                     return $this->redirect(['action' => 'reqListApproval']);
                 }
                  if(!empty($reject_request_id))
                 {
                     $query = $this->RequisitionSlips->find()->where(['RequisitionSlips.is_deleted'=>'0']);
                    $result = $query->update()
                    ->set(['status' => 'Rejected','approved_by'=>$user_id,'approved_on'=>$approved_on,'admin_comment'=>$reject_comment])
                    ->where(['id' =>$reject_request_id ])
                    ->execute();
                    $this->Flash->error(__('The requisition slip has been rejected.'));
                     return $this->redirect(['action' => 'reqListApproval']);
                 }
            }

         $this->paginate = [
            'contain' => ['RequisitionSlipRows'=>'RowMaterials','Creaters']];
        $requisitionSlips = $this->paginate($this->RequisitionSlips->find()->where(['RequisitionSlips.status'=>'Pending','RequisitionSlips.is_deleted'=>'0'])->order(['RequisitionSlips.id'=>'DESC']));


       // pr($requisitionSlips->toarray());exit;
        $this->set(compact('requisitionSlips'));
    }
    public function adminEdit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $requisitionSlip = $this->RequisitionSlips->get($id, [
            'contain' => ['RequisitionSlipRows']
        ]);
       // pr($requisitionSlip);exit;
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $requisitionSlip = $this->RequisitionSlips->patchEntity($requisitionSlip, $this->request->getData());
           // pr($this->request->getData());exit;
            $requisitionSlip->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $requisitionSlip->status = 'Pending';
            $requisitionSlip->edited_by = $user_id;
           // pr($requisitionSlip);exit;
            if ($this->RequisitionSlips->save($requisitionSlip)) {
                $this->Flash->success(__('The requisition slip has been saved.'));

                return $this->redirect(['action' => 'reqListApproval']);
            }
            $this->Flash->error(__('The requisition slip could not be saved. Please, try again.'));
        }
         $rowMaterials= $this->RequisitionSlips->RequisitionSlipRows->RowMaterials->find('list',[
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
       ->contain(['Units']);
       //pr($requisitionSlip);exit;
        $status=['1'=>'Deactive','0'=>'Active'];
        $this->set(compact('requisitionSlip','rowMaterials','status'));
    }

    public function report($value='')
    {
         
        $requisition_data = $this->RequisitionSlips->newEntity();
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
                        $where['RequisitionSlips.'.$key] = $v;
                    }
                  }
                }
            $this->set(compact('where'));
            $requisitionSlips=$this->RequisitionSlips->find()
            ->where([$where,'RequisitionSlips.is_deleted'=>'0'])
            ->contain(['RequisitionSlipRows'=>'RowMaterials','Creaters','Approvers']);   
            if(!empty($requisitionSlips->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }       
        
        }
       // pr($requisitionSlips->toArray());exit;
        $empfff = $this->RequisitionSlips->Creaters->find('list')->where(['Creaters.is_deleted'=>'0','Creaters.role_id'=>'4']);
        $companies=$this->RequisitionSlips->Companies->get(1,['contain'=> ['States']]);
        $this->set(compact('requisitionSlips','empfff','requisition_data','data_exist','companies'));
    }
     public function reqslipList()
    {
        $this->paginate = [
            'contain' => ['RequisitionSlipRows'=>'RowMaterials','Creaters']];
        $requisitionSlips = $this->paginate($this->RequisitionSlips->find()->where(['RequisitionSlips.status'=>'Approved','RequisitionSlips.is_deleted'=>'0'])->order(['RequisitionSlips.id'=>'DESC']));

       // pr($requisitionSlips->toarray());exit;
        $this->set(compact('requisitionSlips'));

    }

}
