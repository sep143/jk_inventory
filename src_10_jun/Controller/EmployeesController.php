<?php
namespace App\Controller;
use Cake\Utility\Hash;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{
     public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login','forgotPassword','passwordotpVerifiy']);
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['login']);
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departments','Roles']
        ];
      
        $empfff = $this->Employees->find('list')->where(['Employees.is_deleted'=>'0']);

        if ($this->request->is(['get'])) {
            
            $employee_id = $this->request->query('employee_id');
            //pr($employee_id);exit;

            if(!empty($employee_id)){
                $conditions['Employees.id']=$employee_id;
            }
            else{
                $conditions['Employees.is_deleted']='0';
            }
            $employees = $this->paginate($this->Employees->find()->where($conditions));
        }
        $this->set(compact('employees','empfff'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Departments', 'IssueSlips', 'ReturnSlips']
        ]);

        $this->set('employee', $employee);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $employee = $this->Employees->newEntity();
          if ($this->request->is(['post']))
         {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            $employee->created_by =$user_id;
            //pr($this->request->getData());exit;
            //$signature = $this->request->getData('signature');
            $error='';
            try 
            {
                if ($this->Employees->save($employee)) 
                {
                    /*$id=$employee->id;
                    if(empty($insurance_doc['error']))
                    {
                         $extt=explode('/',$insurance_doc['type']);
                        $ext=$extt[1];
                        $setNewFileName = time().rand();
                    

                    $fullpath= WWW_ROOT."img".DS."vehicles".DS."photo".DS.$id;
                    $res1 = is_dir($fullpath);
                    if($res1 != 1) {
                        new Folder($fullpath, true, 0777);
                    }
                    move_uploaded_file($insurance_doc['tmp_name'],$fullpath.DS.$setNewFileName .'.'.$ext);
                    $photo = "/img/vehicles/photo/".$id.'/'.$setNewFileName .'.'.$ext;
                    $query2 = $this->Vehicles->query();
                            $query2->update()
                                ->set(['insurance_doc' => $photo])
                                ->where(['id' => $id])
                                ->execute();
                    }*/

                    $this->Flash->success(__('The employee has been saved.'));
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
                $error_data='The employee could not be saved. Please, try again.';
            }
            //pr($employee);exit;
            $this->Flash->error(__($error_data));

        }
        $departments = $this->Employees->Departments->find('list')->where(['Departments.is_deleted'=>'0']);
        $roles = $this->Employees->Roles->find('list')->where(['Roles.is_deleted'=>'0']);
        $this->set(compact('employee', 'departments','roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            //pr($this->request->getData());exit;
            $employee->edited_by =$user_id;
            $error='';
            try 
            {
                if ($this->Employees->save($employee))
                    {
                        $this->Flash->success(__('The employee has been saved.'));
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
                $error_data='The employee could not be saved. Please, try again.';
            }
            pr($employee);exit;
            $this->Flash->error(__($error_data));
        }
            $status=['1'=>'Deactive','0'=>'Active'];
            $departments = $this->Employees->Departments->find('list');
            $roles = $this->Employees->Roles->find('list');
            $this->set(compact('employee', 'departments','status','roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function login()
    {
        $this->viewBuilder()->setLayout('');
        $login = $this->Employees->newEntity();
        
       
          if ($this->request->is('post')) 
           {
                //$redirect = $this->request->query('redirect');
                $user=$this->Auth->identify();
                
                if($user)
                {
                    $users = $this->Employees->get($user['id']);
                    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    $randomStrings = '';
                    $length = 2;
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    for ($i = 0; $i < $length; $i++) {
                        $randomStrings .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $users->pass_key='wt1U5MA'.$randomString.'JFTXGenFoZoiLwQGrLgdb'.$randomStrings;
                    //$SessionYear=$this->Employees->SessionYears->find()->where(['status'=>'Active'])->first();
                    //$users->session_year_id=$SessionYear->id;
                    $this->Flash->success(__('Welcome to JK Inventory.'));
                    $this->Auth->setUser($users);
                    pr($users);exit;
                   return  $this->redirect(['controller'=>'Employees','action'=>'dashboard']);

                    /*if(!empty($redirect))
                        return $this->redirect(['controller'=>@explode('/',$redirect)[1],'action'=>@\explode('/',$redirect)[2]]);
                    else
                        return $this->redirect(['controller'=>'Employees','action'=>'dashboard']);*/
                }
                else {
                    $this->Flash->error(_('Invalid Username & Password'));
                }
                
            }
        

        $this->set(compact('login','title'));   
    }
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
        //return $this->redirect(['controller'=>'Employees','action'=>'login']);      
    
    } 
    public function dashboard()
    {
        
    
    }
    public function changePassword()
    {
        $loginId=$this->Auth->User('id');
        if ($this->request->is('post')) {
            $employees = $this->Employees->find()->where(['id' => $loginId])->first();
            //pr($this->request->getData());exit;
            $verify = (new \Cake\Auth\DefaultPasswordHasher)->check($this->request->data['old_password'], $employees->password);
            if($verify) {
                $result = $this->Employees->patchEntity($employees, ['password' => $this->request->data['password']]);
                if ($this->Employees->save($result)) {
                    $this->Flash->success(__('Your password has been changed successfully.'));
                    return $this->redirect(['action' => 'changePassword']);
                }
            } else {
                $this->Flash->error(__('Current Password does not matched.'));
                return $this->redirect(['action' => 'changePassword']);
            }
        } 
        $this->set(compact('employees'));       
    }
     public function employeeStock()
    {
        $loginId=$this->Auth->User('id');
        $department_id=$this->Auth->User('department_id');
        /*pr($loginId);
        pr($department_id);
        exit;*/
        $query=$this->Employees->StockLedgers->RowMaterials->find();
        
        /*$dataaa=$this->Employees->StockLedgers->find()->select(['row_material_id'])->where(['StockLedgers.employee_id'=>$loginId,'StockLedgers.department_id'=>$department_id,'StockLedgers.status'=>'In']);*/

        //pr($dataaa->toArray());exit;
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
        //$mystocks=$this->Employees->StockLedgers->find()->where(['StockLedgers.employee_id'=>$loginId,'StockLedgers.department_id'=>$department_id,'StockLedgers.status'=>'In'])->contain(['RowMaterials']);
        //pr($mystocks->toArray());exit;
        $this->set(compact('row_material_list')); 
    }
    public function mainStock()
    {
        $loginId=$this->Auth->User('id');
        $department_id=$this->Auth->User('department_id');
        $query=$this->Employees->StockLedgers->RowMaterials->find();
        $row_material_list = $query
        ->contain(['Units','StockLedgers'=>function($query){
          $totalInCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'In','department_id' => '0']),
                $query->newExpr()->add(['quantity']),
                'integer'
              );
              $totalOutCase = $query->newExpr()
              ->addCase(
                $query->newExpr()->add(['status' => 'Out','department_id' => '0']),
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
        //$mystocks=$this->Employees->StockLedgers->find()->where(['StockLedgers.employee_id'=>$loginId,'StockLedgers.department_id'=>$department_id,'StockLedgers.status'=>'In'])->contain(['RowMaterials']);
        //pr($mystocks->toArray());exit;
        $this->set(compact('row_material_list')); 
    }

    public function forgotPassword() 
    {
        $this->viewBuilder()->setLayout('');
        //Configure::write('debug',2);
        if ($this->request->is('post')) 
        {
            $this->loadModel('Employees');
            $d = $this->request->data;
            $user = $this->Employees
            ->find()
            ->where(['email' =>$d['email']])
            ->first();
           // pr($user);exit;
            if (!empty($user)) {
                    $user_id=$user["id"];
                    $mobile_no=$user['mobile_no'];
                    $rendomCode=rand('100000', '999999');
                    $TableResponse = TableRegistry::get("Employees");
                    $query = $TableResponse->query();
                        $result = $query->update()
                            ->set(['forgot_code' => $rendomCode])
                            ->where(['id' => $user_id])
                            ->execute();
                            
                    $sms_sender='JKIT';
                    $sms=str_replace(' ', '+', 'Thank you for the request with Amrit Finance. Your one time password is '.$rendomCode);
                    file_get_contents("http://103.39.134.40/api/mt/SendSMS?user=phppoetsit&password=9829041695&senderid=".$sms_sender."&channel=Trans&DCS=0&flashsms=0&number=".$mobile_no."&text=".$sms."&route=7");
                    $encrypted_data=$this->encode($user_id,'JKIT');
                    $dummy_user_id=$encrypted_data;
                    $this->redirect('/employees/passwordotp_verifiy/'.$dummy_user_id);
                    
                    } else 
                    {
                    $this->Flash->error(__('Incorrect email id, please try with registered email id'));
                    }
            }
        }
        public function passwordotpVerifiy() 
        {
            $this->viewBuilder()->setLayout('');
        
        }
        public function encode($string,$key) {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if (@$j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,@$j,1));
        @$j++;
        @$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
        }
        return @$hash;
    }

    public function decode($string,$key) {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if (@$j == $keyLen) { @$j = 0; }
        $ordKey = ord(substr($key,@$j,1));
        @$j++;
        @$hash .= chr($ordStr - $ordKey);
        }
        return @$hash;
    }
     public function itemConsumptions()
    {
        $loginId=$this->Auth->User('id');
        $department_id=$this->Auth->User('department_id');
        $itemConsumption = $this->Employees->StockLedgers->newEntity();
        if ($this->request->is('post')) 
        { 
            if (isset($this->request->data['transaction_date'])) 
            {
                $itemConsumption = $this->Employees->StockLedgers->patchEntity($itemConsumption, $this->request->getData());
                $itemConsumption->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
                //pr($itemConsumption);exit;
                $itemConsumption->employee_id = $loginId;
                $itemConsumption->department_id = $department_id;
                $itemConsumption->created_by = $loginId;
                $itemConsumption->status = 'Out';
                $itemConsumption->is_used = '1';
                if ($this->Employees->StockLedgers->save($itemConsumption))
                 {
                    $this->Flash->success(__('The item consumption  has been saved.'));
                    return $this->redirect(['action' => 'itemConsumptions']);
                 }
                 else{
                    $this->Flash->error(__('The item consumption could not be saved. Please, try again.'));
                 }
            }
            
            if (isset($this->request->data['used_data_id'])) 
            {
                $used_data_id=$this->request->getData('used_data_id');
                $used_id = $this->EncryptingDecrypting->decryptData($used_data_id);
                //pr($used_id);exit;
                if(!empty($used_id))
                {
                    $this->Employees->StockLedgers->deleteAll(['StockLedgers.id'=>$used_id]);
                    $this->Flash->error(__('This consumption has been deleted.'));
                     return $this->redirect(['action' => 'itemConsumptions']);
                }
            }
        }

        $query=$this->Employees->StockLedgers->RowMaterials->find();
        $row_material_list = $query
       ->contain(['Units','RowMaterialCategories','StockLedgers'=>function($query){
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
        //pr($rowMaterial);exit;
        if (!empty($this->request->query('rm_id'))) 
            {
                $rm_id=$this->request->query('rm_id');
               
                    $usedDatas=$this->Employees->StockLedgers->find()->where(['StockLedgers.row_material_id'=>$rm_id,'StockLedgers.department_id' => $this->Auth->User('department_id'),'StockLedgers.employee_id'=> $this->Auth->User('id'),'StockLedgers.is_used'=>'1'])->contain(['RowMaterials'=>['RowMaterialCategories','Units']]);  
                        
                
            }else{
                 $usedDatas=$this->Employees->StockLedgers->find()->where(['StockLedgers.department_id' => $this->Auth->User('department_id'),'StockLedgers.employee_id'=> $this->Auth->User('id'),'StockLedgers.is_used'=>'1'])->contain(['RowMaterials'=>['RowMaterialCategories','Units']]);
            }
            
            
       // pr($usedDatas->toArray());exit;
        $this->set(compact('row_material_list','itemConsumption','rowMaterial','usedDatas')); 
    }
}
