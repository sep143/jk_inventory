<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Security');
        $EncryptingDecrypting=$this->loadComponent('EncryptingDecrypting');
        FrozenTime::setToStringFormat('dd-MMM-yyyy hh:mm a');  // For any immutable DateTime
        FrozenDate::setToStringFormat('dd-MMM-yyyy'); 
        $this->loadComponent('Auth',[
            'authenticate'=>[
                'Form'=> [
                    'fields'=>[
                        'username'=>'username',
                        'password'=>'password'
                    ],
                    'userModel' => 'Employees'
                ]
            ],
            'loginAction' => [
                'controller' => 'Employees',
                'action' => 'login',
                'plugin' => null
            ],
            'logoutRedirect'=>[
                'controller'=>'Employees',
                'action'=>'login'
            ],
        'unauthorizedRedirect'=> $this->referer(),
        ]);
        $name=$this->Auth->User('name');
        $role_id=$this->Auth->User('role_id');
        $this->set(compact('EncryptingDecrypting','name','role_id'));

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $user_id=$this->Auth->User('id');
        $role_id=$this->Auth->User('role_id');
        /////////////// UserRights /////////////
        if(!empty($role_id))
        {
            $controller=$this->request->getParam('controller');
            $action=$this->request->getParam('action');
            $this->loadModel('UserRights');
            $userRights = $this->UserRights;
            
            $userRights = $userRights->find()->where(['OR'=>['employee_id'=>$user_id,'role_id'=>$role_id]]);
            $menu_ids=[];
            $userRightsIds=[];
            foreach ($userRights as $userRight) {
                $menu_ids[]=explode(',',$userRight->menu_ids);
            }
            foreach ($menu_ids as $key => $value) {

                foreach ($value as $key1 => $value1) {
                    $userRightsIds[]=$value1;
                }
            }
            $this->set(compact('userRightsIds'));
            ///////////////////////////////////
            /////////////// Menus /////////////
            $this->loadModel('Menus');
            $menuFind = $this->Menus->find()->where(['controller'=>$controller,'action'=>$action])->first();

            if(!empty($userRightsIds))
            {
                $menus =  $this->Menus->find('threaded')->where(['id IN'=>$userRightsIds,'is_hidden'=>'N']);
            }
            else
            {
                $menus=[];
            }
           
            $this->set(compact('menus','menuFind'));
        }
        
        /////////////////// End Menus/////////////
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->action]);
        }
    }
    public function json($data){
        $data = json_encode($data);
        $response = $this->response->withType('application/json')->withStringBody($data);
        return $response;
    }
    public function text($data){
        $response = $this->response->withType('application/text')->withStringBody($data);
        return $response;
    }
}

