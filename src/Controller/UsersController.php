<?php
namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;
use App\Controller\AppController;


class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
    }
    public function isAuthorized($user) {
        if(isset($user['role']) and $user['role'] == 2){
            if(in_array($this->request->action,['index', 'logout','view'])){
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    
    public function index()
    {

        if($this->request->is('post')){

            $search = $this->request->getData();
           
            $options = [
                'conditions' => [
                    'OR'=>[
                        ['name LIKE' => "%{$search['search']}%"],
                        ['email LIKE' => "%{$search['search']}%"],
                        
                    ]
                ],
            ];
            $query = $this->Users->find('all',$options);
            $users = $this->Paginate($query);
           
            
        }else{
            $users = $this->paginate($this->Users);
        }
        $this->set(compact('users'));
    }


    public function login(){
        
        if($this->request->is('post')){
            
            $user =  $this->Auth->identify();
           
            if($user){
                if($user['active'] ==1){
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectURL());
                }else{
                    $this->Flash->error(__('User Inactive.'));
                }
            }else{
                $this->Flash->error('Invalid data',['key' => 'auth']);
            }
        }
        if($this->Auth->user()){
            return $this->redirect(['controller' => 'Users','action' => 'index']);
        }
    }

    public function logout(){

        return $this->redirect($this->Auth->logout());

    }

    
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    
    public function add()
    {
       
            $user = $this->Users->newEntity();
            // array roles
            $arrayRoles = array(
                1 => "Admin",
                2 => "User",
            );

            if ($this->request->is('post')) {
                $arraySave = $this->request->getData();
                $arraySave['active'] = 1;
                if(!isset($current_user)){
                    $arraySave['role'] = 2;
                }

                
                $user = $this->Users->patchEntity($user, $arraySave);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Success.'));
                    if(!isset($current_user)){
                        return $this->redirect(['action' => 'login']);
                    }
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }

            $this->set(compact('user','arrayRoles'));
        
    }

   
    public function edit($id = null)
    {
        
            $user = $this->Users->get($id, [
                'contain' => [],
                'fields' => [
                    'id','name','email','role','active'
                ],
            ]);
            $arrayRoles = array(
               
                1 => "Admin",
                2 => "User",
            );
    
            
            if ($this->request->is(['patch', 'post', 'put'])) {
    
                $arraySave = $this->request->getData();
                
                $user = $this->Users->patchEntity($user, $arraySave);
               
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Success.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            $this->set(compact('user','arrayRoles'));
        

        
    }

    
    public function delete($id = null)
    {
        
       
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
