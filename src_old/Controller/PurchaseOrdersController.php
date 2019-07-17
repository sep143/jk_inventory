<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * PurchaseOrders Controller
 *
 * @property \App\Model\Table\PurchaseOrdersTable $PurchaseOrders
 *
 * @method \App\Model\Entity\PurchaseOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseOrdersController extends AppController
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
       
        $po_data = $this->PurchaseOrders->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['get']))
        {
           if(!empty(@$this->request->query('data'))) 
                {
            //pr($this->request->getData('data'));exit;
                foreach ($this->request->query('data') as $key => $v) 
                  {
                    if(!empty($v))
                    {
                        if (strpos($key, 'transaction_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where['PurchaseOrders.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['Vendors','PurchaseOrderRows'=>'RowMaterials']
          ];

          $purchaseOrders=$this->paginate($this->PurchaseOrders->find()
          ->where([$where,'PurchaseOrders.is_deleted'=>'0']));
        $po_grn_match_data=[];
         $po_grn_datas= $this->PurchaseOrders->GoodReceiveNotes->find()->select('purchase_order_id');
         foreach ($po_grn_datas as $po_grn_data) {
           $po_grn_match_data[]=$po_grn_data->purchase_order_id;
         }
         //pr($po_grn_match_data);exit;
          if(!empty($purchaseOrders->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }
        
        
        $vendors = $this->PurchaseOrders->Vendors->find('list');
        $this->set(compact('purchaseOrders','po_data','vendors','data_exist','po_grn_match_data'));
      
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
      $id = $this->EncryptingDecrypting->decryptData($id);
      $purchaseOrder = $this->PurchaseOrders->get($id, [
            'contain' => ['Vendors','PurchaseOrderRows'=>'RowMaterials']
      ]);

      $this->set('purchaseOrder', $purchaseOrder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $purchaseOrder = $this->PurchaseOrders->newEntity();
        if ($this->request->is('post')) {
            $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $this->request->getData());
            //pr($this->request->getData());exit;
            $reqslipIdForUpdate=$this->request->getData('requisition_slip_id');
            $reqslipsIds = implode(",", $this->request->getData('requisition_slip_id'));
           // pr($reqslipIdForUpdate);exit;
            $purchaseOrder->requisition_slip_id=$reqslipsIds;

            $purchaseOrder->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $purchaseOrder->delivery_date=date('Y-m-d',strtotime($this->request->getData('delivery_date')));
            $query=$this->PurchaseOrders->find();
            $invoice_first=$query->select(['max_value'=>$query->func()->max('voucher_no')])->toArray();
            $purchaseOrder->voucher_no=$invoice_first[0]->max_value+1;
            $purchaseOrder->created_by = $user_id;
           // pr($purchaseOrder);exit;
            if ($this->PurchaseOrders->save($purchaseOrder)) {
               if(!empty($reqslipIdForUpdate))
                 {
                  foreach ($reqslipIdForUpdate as $reqslipId)
                   {
                     $query = $this->PurchaseOrders->RequisitionSlips->find()->where(['RequisitionSlips.is_deleted'=>'0','RequisitionSlips.id'=>$reqslipId]);
                    $result = $query->update()
                    ->set(['po_flag' =>'1'])
                    ->where(['RequisitionSlips.id' =>$reqslipId ])
                    ->execute();
                  }
                   
                 }

                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
        }

        $qData = $this->PurchaseOrders->RequisitionSlips->RequisitionSlipRows->find();

        $reqslipDatas=$this->PurchaseOrders->RequisitionSlips->find()->where(['RequisitionSlips.status'=>'Approved','RequisitionSlips.is_deleted'=>'N','RequisitionSlips.po_flag'=>'0'])
        ->contain(['RequisitionSlipRows'=> function($q) use($qData){
             return $q->select(['RequisitionSlipRows.requisition_slip_id','row_material_id','id','sum' => $qData->func()->sum('quantity')])
              ->contain(['RowMaterials'])
             ->group(['RequisitionSlipRows.row_material_id'])->autoFields(true); 
        }]);

        $rowMaterials= $this->PurchaseOrders->PurchaseOrderRows->RowMaterials->find('list',[
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

        $vendors = $this->PurchaseOrders->Vendors->find('list');
        $this->set(compact('purchaseOrder', 'vendors','rowMaterials','reqslipDatas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $purchaseOrder = $this->PurchaseOrders->get($id, [
            'contain' => ['PurchaseOrderRows'=>'RowMaterials']
        ]);
        //pr($purchaseOrder->toArray());exit;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $this->request->getData());
            //pr($this->request->getData());exit;
             $purchaseOrder->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $purchaseOrder->delivery_date=date('Y-m-d',strtotime($this->request->getData('delivery_date')));
            $reqslipIdForUpdate=explode(',', $purchaseOrder->requisition_slip_id);
            //pr($reqslipIdForUpdate);exit;
            /*$query=$this->PurchaseOrders->find();
            $invoice_first=$query->select(['max_value'=>$query->func()->max('voucher_no')])->toArray();
            $purchaseOrder->voucher_no=$invoice_first[0]->max_value+1;*/
            $purchaseOrder->edited_by = $user_id;
            if ($this->PurchaseOrders->save($purchaseOrder)) 
            {
                 if(!empty($reqslipIdForUpdate))
                  {
                    foreach ($reqslipIdForUpdate as $reqslipId)
                     {
                       $query = $this->PurchaseOrders->RequisitionSlips->find()->where(['RequisitionSlips.is_deleted'=>'0','RequisitionSlips.id'=>$reqslipId]);
                      $result = $query->update()
                      ->set(['po_flag' =>'1'])
                      ->where(['RequisitionSlips.id' =>$reqslipId ])
                      ->execute();
                    }
                  }
                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //pr($purchaseOrder);exit;
            $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
        }
       
        $rowMaterials= $this->PurchaseOrders->PurchaseOrderRows->RowMaterials->find('list',[
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
       //pr($purchaseOrder->toArray());exit;
        $status=['1'=>'Deactive','0'=>'Active'];
        $vendors = $this->PurchaseOrders->Vendors->find('list');
        $this->set(compact('purchaseOrder', 'vendors','rowMaterials','status','reqslipDatas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrder = $this->PurchaseOrders->get($id);
        if ($this->PurchaseOrders->delete($purchaseOrder)) {
            $this->Flash->success(__('The purchase order has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function poList($value='')
    {
        $po_data = $this->PurchaseOrders->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['get']))
        {
            //pr($this->request->getData('data'));exit;
             if(!empty(@$this->request->query('data'))) 
                {
            //pr($this->request->getData('data'));exit;
                foreach ($this->request->query('data') as $key => $v) 
                  {
                    if(!empty($v))
                    {
                        if (strpos($key, 'transaction_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where['PurchaseOrders.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
           $this->paginate = [
            'contain' => ['Vendors','PurchaseOrderRows'=>'RowMaterials']
          ];
          $purchaseOrders=$this->paginate($this->PurchaseOrders->find()
              ->innerJoinWith('PurchaseOrderRows')
              ->where([$where,'PurchaseOrders.is_deleted'=>'0','PurchaseOrderRows.received_qty< quantity'])
             ->group('purchase_order_id'));
          if(!empty($purchaseOrders->toArray()))
            {
              $data_exist='data_exist';
            }
            else{
              $data_exist='No Record Found';
            }
        }     
          
        $vendors = $this->PurchaseOrders->Vendors->find('list');
        $this->set(compact('purchaseOrders','vendors','po_data','data_exist'));
    }
    public function report($value='')
    {
       
        $po_data = $this->PurchaseOrders->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['get']))
        {
           if(!empty(@$this->request->query('data'))) 
                {
            //pr($this->request->getData('data'));exit;
                foreach ($this->request->query('data') as $key => $v) 
                  {
                    if(!empty($v))
                    {
                        if (strpos($key, 'transaction_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where['PurchaseOrders.'.$key] = $v;
                    }
                  }
                }
          $this->set(compact('where'));
          $this->paginate = [
            'contain' => ['Vendors','PurchaseOrderRows'=>'RowMaterials']
          ];

          $purchaseOrders=$this->paginate($this->PurchaseOrders->find()
          ->where([$where,'PurchaseOrders.is_deleted'=>'0']));
          if(!empty($purchaseOrders->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }
        }
        
        
        $vendors = $this->PurchaseOrders->Vendors->find('list');
        $this->set(compact('purchaseOrders','po_data','vendors','data_exist'));
      
    }
}
