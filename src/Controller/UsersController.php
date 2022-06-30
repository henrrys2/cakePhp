<?php
namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;
use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
    }
    public function isAuthorized($user) {
        if(isset($user['role']) and $user['role'] == 2){
            if(in_array($this->request->action,['index', 'logout'])){
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    
    public function index()
    {
       
        $users = $this->paginate($this->Users);


        $this->set(compact('users'));
    }


    public function login(){
        
        if($this->request->is('post')){
            
            $user =  $this->Auth->identify();
           
            if($user){
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectURL());
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

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
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

                // print_r($arraySave);exit;
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

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
