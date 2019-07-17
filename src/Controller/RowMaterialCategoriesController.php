<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RowMaterialCategories Controller
 *
 * @property \App\Model\Table\RowMaterialCategoriesTable $RowMaterialCategories
 *
 * @method \App\Model\Entity\RowMaterialCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RowMaterialCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id= null)
    {
        if(!$id){
            $rowMaterialCategory = $this->RowMaterialCategories->newEntity();
                }
          else{
                $id = $this->EncryptingDecrypting->decryptData($id);
                $rowMaterialCategory = $this->RowMaterialCategories->get($id, [
                    'contain' => []
                 ]);
            
             }
            if ($this->request->is(['patch', 'post', 'put']))
            {
                $rowMaterialCategory = $this->RowMaterialCategories->patchEntity($rowMaterialCategory, $this->request->getData());
                $error='';
                try 
                {
                    if ($this->RowMaterialCategories->save($rowMaterialCategory))
                     {
                        $this->Flash->success(__('The row material category has been saved.'));
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
                    $error_data='The row material category could not be saved. Please, try again.';
                }
                $this->Flash->error(__($error_data));
            }
        $rowMaterialCategories = $this->paginate($this->RowMaterialCategories->find()->where(['RowMaterialCategories.is_deleted'=>'0']));
        $status=['1'=>'Deactive','0'=>'Active'];
        $this->set(compact('rowMaterialCategories','rowMaterialCategory','id','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Row Material Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rowMaterialCategory = $this->RowMaterialCategories->get($id, [
            'contain' => ['RowMaterials']
        ]);

        $this->set('rowMaterialCategory', $rowMaterialCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rowMaterialCategory = $this->RowMaterialCategories->newEntity();
        if ($this->request->is('post')) {
            $rowMaterialCategory = $this->RowMaterialCategories->patchEntity($rowMaterialCategory, $this->request->getData());
            if ($this->RowMaterialCategories->save($rowMaterialCategory)) {
                $this->Flash->success(__('The row material category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The row material category could not be saved. Please, try again.'));
        }
        $this->set(compact('rowMaterialCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Row Material Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rowMaterialCategory = $this->RowMaterialCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rowMaterialCategory = $this->RowMaterialCategories->patchEntity($rowMaterialCategory, $this->request->getData());
            if ($this->RowMaterialCategories->save($rowMaterialCategory)) {
                $this->Flash->success(__('The row material category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The row material category could not be saved. Please, try again.'));
        }
        $this->set(compact('rowMaterialCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Row Material Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rowMaterialCategory = $this->RowMaterialCategories->get($id);
        if ($this->RowMaterialCategories->delete($rowMaterialCategory)) {
            $this->Flash->success(__('The row material category has been deleted.'));
        } else {
            $this->Flash->error(__('The row material category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
