<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * GoodReceiveNotes Controller
 *
 * @property \App\Model\Table\GoodReceiveNotesTable $GoodReceiveNotes
 *
 * @method \App\Model\Entity\GoodReceiveNote[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GoodReceiveNotesController extends AppController
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
       /* $this->paginate = [
            'contain' => ['PurchaseOrders'=>'Vendors','GoodReceiveNoteRows'=>'RowMaterials']
        ];*/
        
        $po_data = $this->GoodReceiveNotes->newEntity();
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
                        $where['GoodReceiveNotes.'.$key] = $v;
                    }
                  }
                }
            $this->set(compact('where'));
            $this->paginate = [
            'contain' => ['GoodReceiveNoteRows'=>['RowMaterials'=>['Units']],'PurchaseOrders'=>['PurchaseOrderRows','Vendors'],'Creaters','Inspectors']
            ];
            $goodReceiveNotes = $this->paginate($this->GoodReceiveNotes->find()->where([$where,'GoodReceiveNotes.is_deleted'=>'0']));
            //pr($goodReceiveNotes->toArray());exit;
            if(!empty($goodReceiveNotes->toArray()))
            {
              $data_exist='data_exist';
            }
            else{
              $data_exist='No Record Found';
            }
        }

        //pr($goodReceiveNotes);exit;
        $vendors = $this->GoodReceiveNotes->PurchaseOrders->Vendors->find('list');
        $companies=$this->GoodReceiveNotes->Companies->get(1,['contain'=> ['States']]);
        $this->set(compact('goodReceiveNotes','po_data','vendors','data_exist','companies'));
    }

    /**
     * View method
     *
     * @param string|null $id Good Receive Note id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $goodReceiveNote = $this->GoodReceiveNotes->get($id, [
            'contain' => ['PurchaseOrders', 'GoodReceiveNoteRows']
        ]);

        $this->set('goodReceiveNote', $goodReceiveNote);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
       // pr($department_id);exit;
        $po_id = $this->EncryptingDecrypting->decryptData($id);
        //pr($id);exit;   
        $po_rows=$this->GoodReceiveNotes->PurchaseOrders->find()->where(['PurchaseOrders.id'=>$po_id])->contain(['Vendors','PurchaseOrderRows'=>'RowMaterials'])->first();
        /*$po_rows=$this->GoodReceiveNotes->PurchaseOrders->get($id,[
            'contain' => ['Vendors','PurchaseOrderRows'=>'RowMaterials']
        ]);*/
        //pr($po_rows->toarray());exit;
        $goodReceiveNote = $this->GoodReceiveNotes->newEntity();
        if ($this->request->is('post')) {
            $goodReceiveNote = $this->GoodReceiveNotes->patchEntity($goodReceiveNote, $this->request->getData());
            //pr($this->request->getData());exit;
             $goodReceiveNote->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $query=$this->GoodReceiveNotes->find();
            $invoice_first=$query->select(['max_value'=>$query->func()->max('voucher_no')])->toArray();
            $goodReceiveNote->voucher_no=$invoice_first[0]->max_value+1;
            $goodReceiveNote->created_by = $user_id;
            $goodReceiveNote->purchase_order_id = $po_id;

            //pr($this->request->getData());exit;
            if ($this->GoodReceiveNotes->save($goodReceiveNote)) {
                //pr($goodReceiveNote);exit;

                foreach ($goodReceiveNote->good_receive_note_rows as  $good_receive_note_row) 
                {
                    if(!empty($good_receive_note_row->quantity))
                    {
                    $stockledger = $this->GoodReceiveNotes->GoodReceiveNoteRows->StockLedgers->newEntity();
                    $stockledger->good_receive_note_id=$good_receive_note_row->good_receive_note_id;
                    $stockledger->transaction_date=$goodReceiveNote->transaction_date;
                    $stockledger->department_id=$this->Auth->User('department_id');;
                    $stockledger->employee_id=$this->Auth->User('id');
                    $stockledger->good_receive_note_row_id=$good_receive_note_row->id;
                    $stockledger->row_material_id=$good_receive_note_row->row_material_id;
                    $stockledger->quantity=$good_receive_note_row->quantity;
                    $stockledger->created_by=$user_id;
                    $stockledger->status='In';
                    $this->GoodReceiveNotes->GoodReceiveNoteRows->StockLedgers->save($stockledger);
                    $query = $this->GoodReceiveNotes->PurchaseOrders->PurchaseOrderRows->query();
                    $query->update()->set(['received_qty = received_qty+'.$good_receive_note_row->quantity])
                    ->where(['row_material_id' => $good_receive_note_row->row_material_id])->execute();  
                    }
                }

                $this->Flash->success(__('The good receive note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The good receive note could not be saved. Please, try again.'));
        }
        $rowMaterials= $this->GoodReceiveNotes->GoodReceiveNoteRows->RowMaterials->find('list',[
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
        $inspectors = $this->GoodReceiveNotes->Inspectors->find('list');
        $purchaseOrders = $this->GoodReceiveNotes->PurchaseOrders->find('list');
        $this->set(compact('goodReceiveNote', 'purchaseOrders','rowMaterials','po_rows','inspectors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Good Receive Note id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $goodReceiveNote = $this->GoodReceiveNotes->get($id, [
            'contain' => ['GoodReceiveNoteRows'=>['PurchaseOrderRows'=>'RowMaterials'],
            'PurchaseOrders'=>['Vendors']
        ]]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $goodReceiveNote = $this->GoodReceiveNotes->patchEntity($goodReceiveNote, $this->request->getData());

             $grnRows = $this->request->getData('good_receive_note_rows');
            //pr($grnRows);exit;            
            if(!empty($grnRows))
            {
                $curnt_qty = 0;
                $old_po_qty = 0;
                $old_grn_row_qty = 0;
                $new_qty_po =0;
                $po_row_id = 0;
                foreach ($grnRows as $key => $grnValue) {
                  //$rate = $grnValue['rate'];
                  //$amount = $grnValue['amount'];
                  $grn_row_id = $grnValue['grn_row_id'];
                  $old_po_qty = $grnValue['po_received_qty'];
                  $old_grn_row_qty = $grnValue['old_grn_row_qty'];
                $curnt_qty = $old_po_qty - $old_grn_row_qty;
                $new_qty_po = $curnt_qty + $grnValue['quantity'];
                $po_row_id = $grnValue['purchase_order_row_id'];

                    $query = $this->GoodReceiveNotes->PurchaseOrders->PurchaseOrderRows->query();
                    $result = $query->update()
                    ->set(['received_qty' =>$new_qty_po])
                    ->where(['id' =>$po_row_id])
                    ->execute();

                    $query = $this->GoodReceiveNotes->StockLedgers->query();
                    $result = $query->update()
                    ->set(['quantity' =>$grnValue["quantity"]])
                    ->where(['good_receive_note_row_id' =>$grn_row_id])
                    ->execute();
                }
            }
//pr($grnRows);exit;
            $goodReceiveNote->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $goodReceiveNote->edited_by = $user_id;
            $purchase_order_id=$goodReceiveNote->purchase_order_id;
            $grn_id=$goodReceiveNote->id;
            
//pr($goodReceiveNote);exit;
            if ($this->GoodReceiveNotes->save($goodReceiveNote)) 
            {
                $this->GoodReceiveNotes->GoodReceiveNoteRows->StockLedgers->deleteAll(['good_receive_note_id' => $grn_id]);
              foreach ($goodReceiveNote->good_receive_note_rows as  $good_receive_note_row) 
                {
                    if(!empty($good_receive_note_row->quantity))
                    {
                    $stockledger = $this->GoodReceiveNotes->GoodReceiveNoteRows->StockLedgers->newEntity();
                    $stockledger->good_receive_note_id=$good_receive_note_row->good_receive_note_id;
                    $stockledger->transaction_date=$goodReceiveNote->transaction_date;
                    $stockledger->department_id=$this->Auth->User('department_id');;
                    $stockledger->employee_id=$this->Auth->User('id');
                    $stockledger->good_receive_note_row_id=$good_receive_note_row->id;
                    $stockledger->row_material_id=$good_receive_note_row->row_material_id;
                    $stockledger->quantity=$good_receive_note_row->quantity;
                    $stockledger->created_by=$user_id;
                    $stockledger->status='In';
                    $this->GoodReceiveNotes->GoodReceiveNoteRows->StockLedgers->save($stockledger);
                }
              }

                $this->Flash->success(__('The good receive note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The good receive note could not be saved. Please, try again.'));
        }

         $rowMaterials= $this->GoodReceiveNotes->GoodReceiveNoteRows->RowMaterials->find('list',[
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
        $inspectors = $this->GoodReceiveNotes->Inspectors->find('list');
        $purchaseOrders = $this->GoodReceiveNotes->PurchaseOrders->find('list');
        $this->set(compact('goodReceiveNote', 'purchaseOrders','rowMaterials','inspectors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Good Receive Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $id = $this->EncryptingDecrypting->decryptData($id);
        $goodReceiveNote = $this->GoodReceiveNotes->get($id);

        $goodReceiveNoterows = $this->GoodReceiveNotes->GoodReceiveNoteRows->find()
        ->where(['GoodReceiveNoteRows.good_receive_note_id'=>$id]);
        //$x=0;
        foreach ($goodReceiveNoterows as $key => $goodReceiveNoterow) 
        {
          $po_row_id=$goodReceiveNoterow->purchase_order_row_id;
          $quantity=$goodReceiveNoterow->quantity;
          $query=$this->GoodReceiveNotes->GoodReceiveNoteRows->PurchaseOrderRows->query();
          $result = $query->update()
          ->set(['received_qty = received_qty-'.$quantity])
          ->where(['id' =>$po_row_id])
          ->execute();

          //$x++;
        }

        //pr($goodReceiveNoterows->toArray());exit;


        if ($this->GoodReceiveNotes->delete($goodReceiveNote)) {

            $this->Flash->success(__('The good receive note has been deleted.'));
        } else {
            $this->Flash->error(__('The good receive note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report($value='')
    {
       /* $this->paginate = [
            'contain' => ['PurchaseOrders'=>'Vendors','GoodReceiveNoteRows'=>'RowMaterials']
        ];*/
        
        $po_data = $this->GoodReceiveNotes->newEntity();
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
                        $where['GoodReceiveNotes.'.$key] = $v;
                    }
                  }
                }
            $this->set(compact('where'));
            $this->paginate = [
            'contain' => ['GoodReceiveNoteRows'=>['RowMaterials'=>['Units']],'PurchaseOrders'=>['Vendors'],'Creaters']
                ];
            $goodReceiveNotes = $this->paginate($this->GoodReceiveNotes->find()->where([$where,'GoodReceiveNotes.is_deleted'=>'0']));
            //pr($goodReceiveNotes->toArray());exit;
            if(!empty($goodReceiveNotes->toArray()))
            {
              $data_exist='data_exist';
            }
            else{
              $data_exist='No Record Found';
            }
        }

        //pr($goodReceiveNotes);exit;
        $vendors = $this->GoodReceiveNotes->PurchaseOrders->Vendors->find('list');
        $companies=$this->GoodReceiveNotes->Companies->get(1,['contain'=> ['States']]);
        $this->set(compact('goodReceiveNotes','po_data','vendors','data_exist','companies'));
    }
     
    public function reportExport()
    {
        $this->viewBuilder()->setLayout('pdf');
         $goodReceiveNotes = $this->GoodReceiveNotes->find()->where($this->request->getData('GoodReceiveNotes'))->contain(['GoodReceiveNoteRows'=>'RowMaterials','PurchaseOrders'=>['Vendors'],'Creaters','Inspectors']);
        /*$disposedDatas=$this->ReturnSlips->StockLedgers->find()
        ->where([$this->request->getData('ReturnSlips'),'StockLedgers.is_scrab'=>'1','StockLedgers.disposed_status'=>'1',])
        ->contain(['RowMaterials'=>'Units','Employees'=>'Departments','Disposers']);*/
        $companies=$this->GoodReceiveNotes->Companies->get(1,['contain'=> ['States']]);
        $this->set(compact('goodReceiveNotes','companies'));
    }
    
    
}