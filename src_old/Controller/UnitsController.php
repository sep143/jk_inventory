<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Units Controller
 *
 * @property \App\Model\Table\UnitsTable $Units
 *
 * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnitsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
       public function index($id=null)
    {
        if(!$id){
            $unit = $this->Units->newEntity();
                }
          else{
                $id = $this->EncryptingDecrypting->decryptData($id);
                $unit = $this->Units->get($id, [
                    'contain' => []
                 ]);
            
             }
            if ($this->request->is(['patch', 'post', 'put']))
            {
                $unit = $this->Units->patchEntity($unit, $this->request->getData());
                $error='';
                try 
                {

                    if ($this->Units->save($unit)) 
                    {
                        $this->Flash->success(__('The unit has been saved.'));
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
                    $error_data='The unit could not be saved. Please, try again.';
                }
                //pr($employee);exit;
                $this->Flash->error(__($error_data));
            }
            $units = $this->paginate($this->Units);
            $status=['1'=>'Deactive','0'=>'Active'];
            $this->set(compact('units','unit','id','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => ['RowMaterials']
        ]);

        $this->set('unit', $unit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $unit = $this->Units->newEntity();
        if ($this->request->is('post')) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $this->set(compact('unit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $this->set(compact('unit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $unit = $this->Units->get($id);
        if ($this->Units->delete($unit)) {
            $this->Flash->success(__('The unit has been deleted.'));
        } else {
            $this->Flash->error(__('The unit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
