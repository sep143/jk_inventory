<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RowMaterials Controller
 *
 * @property \App\Model\Table\RowMaterialsTable $RowMaterials
 *
 * @method \App\Model\Entity\RowMaterial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RowMaterialsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id= null)
    {
        $user_id = $this->Auth->User('id');
        $department_id = $this->Auth->User('department_id');
            if(!$id){
                    $rowMaterial = $this->RowMaterials->newEntity();
                }
            else{
                    $id = $this->EncryptingDecrypting->decryptData($id);
                    $rowMaterial = $this->RowMaterials->get($id, [
                    'contain' => []
                    ]);
            
                }
            if ($this->request->is(['patch', 'post', 'put']))
            {
            $rowMaterial = $this->RowMaterials->patchEntity($rowMaterial, $this->request->getData());
            if(!$id)
            {
                $rowMaterial->created_by =$user_id;
            }
            else
            {
                $rowMaterial->edited_by =$user_id;
            }
            $opening_bal=$this->request->getData('opening_bal');
            $transaction_date=date('Y-m-d');
            $error='';
            try 
            {
                if ($rowMat=$this->RowMaterials->save($rowMaterial))
                     {
                        $row_material_id=$rowMat->id;
                       /* pr($rowMaterial);
                        pr($transaction_date);
                        pr($opening_bal);exit;*/
                            $stockledger = $this->RowMaterials->StockLedgers->newEntity();
                            $stockledger->transaction_date=$transaction_date;
                            $stockledger->row_material_id=$row_material_id;
                            $stockledger->opening_balence='yes';
                            $stockledger->quantity=$opening_bal;
                            //$stockledger->department_id=$department_id;
                            $stockledger->created_by=$user_id;
                            $stockledger->status='In';
                            $this->RowMaterials->StockLedgers->save($stockledger);
                       
                        $this->Flash->success(__('The row material has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
            }catch (\Exception $e) {
                   $error = $e->getMessage();
                }
                if (strpos($error, '1062') !== false) 
                {
                    $error_data='Duplicate entry. Please, try again.';
                }
                else
                {
                    $error_data='The row material could not be saved. Please, try again.';
                }
                $this->Flash->error(__($error_data));
        }
        $rowMaterialCategories = $this->RowMaterials->RowMaterialCategories->find('list')->where(['RowMaterialCategories.is_deleted'=>'0']);
        $rowMaterias = $this->RowMaterials->find('list')->where(['RowMaterials.is_deleted'=>'0']);
        $units = $this->RowMaterials->Units->find('list')->where(['Units.is_deleted'=>'0']);
        
        $rm_data = $this->RowMaterials->newEntity();
         $where = [];
         if($this->request->is(['get']))
            {
                //pr($this->request->getData('data'));exit;
                if(!empty(@$this->request->query('data'))) 
                {
                    foreach ($this->request->query('data') as $key => $v)
                        {
                            if(!empty($v))
                            {
                                if (strpos($key, 'transaction_date') !== false)
                                    $v = date('Y-m-d',strtotime($v));
                                $where ['RowMaterials.'.$key] = $v;
                            }
                        
                        }
                    $this->set(compact('where'));
                }
            
            }
        $this->paginate = [
            'contain' => ['RowMaterialCategories', 'Units']
                    ];
        $rowMaterials = $this->paginate($this->RowMaterials->find()->where([$where,'RowMaterials.is_deleted'=>'0']));
        $status=['1'=>'Deactive','0'=>'Active'];
        $reuseables=['No'=>'No','Yes'=>'Yes'];
        $this->set(compact('rowMaterial', 'rowMaterials','rowMaterialCategories', 'units','id','status','reuseables','rowMaterias','rm_data'));
    }

    /**
     * View method
     *
     * @param string|null $id Row Material id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rowMaterial = $this->RowMaterials->get($id, [
            'contain' => ['RowMaterialCategories', 'Units', 'GrnRow', 'IssueSlipRows', 'PurchaseOrderRows', 'RequisitionSlipRows', 'ReturnSlipRows', 'StockLedgers']
        ]);

        $this->set('rowMaterial', $rowMaterial);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rowMaterial = $this->RowMaterials->newEntity();
        if ($this->request->is('post')) {
            $rowMaterial = $this->RowMaterials->patchEntity($rowMaterial, $this->request->getData());
            if ($this->RowMaterials->save($rowMaterial)) {
                $this->Flash->success(__('The row material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The row material could not be saved. Please, try again.'));
        }
        $rowMaterialCategories = $this->RowMaterials->RowMaterialCategories->find('list', ['limit' => 200]);
        $units = $this->RowMaterials->Units->find('list', ['limit' => 200]);
        $this->set(compact('rowMaterial', 'rowMaterialCategories', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Row Material id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rowMaterial = $this->RowMaterials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rowMaterial = $this->RowMaterials->patchEntity($rowMaterial, $this->request->getData());
            if ($this->RowMaterials->save($rowMaterial)) {
                $this->Flash->success(__('The row material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The row material could not be saved. Please, try again.'));
        }
        $rowMaterialCategories = $this->RowMaterials->RowMaterialCategories->find('list', ['limit' => 200]);
        $units = $this->RowMaterials->Units->find('list', ['limit' => 200]);
        $this->set(compact('rowMaterial', 'rowMaterialCategories', 'units'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Row Material id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rowMaterial = $this->RowMaterials->get($id);
        if ($this->RowMaterials->delete($rowMaterial)) {
            $this->Flash->success(__('The row material has been deleted.'));
        } else {
            $this->Flash->error(__('The row material could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
