<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Event\Event;
use Cake\Validation\Validation;

use Cake\Network\Exception\NotFoundException;

use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['add','passwordGenerator']);
    }

    public function myPasswordSettings()
    {
        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['post', 'patch', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success('A sua senha foi alterada com sucesso.');
                $this->redirect(['controller' => 'Users', 'action' => 'myPasswordSettings']);
            } else {
                $this->Flash->error('Ocorreu um erro ao alterar a sua senha. Por favor, tente novamente.');
            }
        }
        $this->set(compact('user'));
    }

    public function mySettings()
    {
        $tab = 1;

        $gym_id = $this->Auth->user('gym_id');
        $user = $this->Users->get($this->Auth->user('id', ['fields' => [
            'User.id',
            'User.name',
            'User.username',
            'User.password'
        ]]));

        $currentPassword = $user->password;
        unset($user->password);

        if (!$user) {
            throw new NotFoundException();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['gym_id'] = $gym_id; //Bom tb para o scope do unique username

            $user = $this->Users->patchEntity($user, $this->request->data);

            // Evita que ele passe uma senha nova pelo array e altere
            $user->accessible('password', false);
            if ($this->Users->save($user)) {
                $this->Auth->session->write($this->Auth->sessionKey . '.name', $user->name);
                $this->Auth->session->write($this->Auth->sessionKey . '.username', $user->username);
                $this->Flash->success('As alterações foram salvas com sucesso.');
            } else {
                $this->Flash->error('As informações não poderam ser salvas. Por favor, tente novamente.');
            }
        }

        $this->set(compact('user', 'tab'));
    }

    public function passwordGenerator($password)
    {
        echo (new DefaultPasswordHasher)->hash($password);
        exit();
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function login()
    {
        $this->layout = 'login';

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(
                    __('Username or password is incorrect'),
                    'default',
                    [],
                    'auth'
                );
            }
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = [];

        switch ($this->request->query('tab')) {
            case null:
                $tab = 'ativos';
                break;
            case 'ativos':
            case 'inativos':
                $tab = $this->request->query('tab');
                break;
            default:
                throw new NotFoundException();
                break;
        }

        if ($tab == 'ativos') {
            $conditions[] = ['Users.is_active' => 1];
        } elseif ($tab == 'inativos') {
            $conditions[] = ['Users.is_active' => 0];
        }

        $conditions[] = [
            'Users.gym_id' => $this->Auth->user('gym_id'),
            'Users.deleted' => 0
        ];

        $this->paginate = [
            'fields' => [
                'id',
                'name',
                'username',
                'is_active',
                'Roles.name'
            ],
            'contain' => ['Roles'],
            'conditions' => $conditions
        ];
        $this->set(compact('tab'));
        $this->set('users', $this->paginate($this->Users));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Gyms', 'Roles', 'Cards', 'Releases']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            
            $this->request->data['gym_id'] = $this->Auth->user('gym_id');            

            $user = $this->Users->patchEntity($user, $this->request->data);
            // Evitar que ele edite algum usuario
            $user->accessible('id', false);
            $user->is_active = 1;

            if ($this->Users->save($user)) {
                $this->Flash->success('O usuário foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {                    
                $this->Flash->error('O usuário não pode ser salvo, tente novamente.');
            }
        }

        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gym_id = $this->Auth->user('gym_id');
        $user = $this->Users->get($id, ['conditions' => ['Users.gym_id' => $gym_id]]);
        if (!$user) {
            throw new NotFoundException();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['gym_id'] = $gym_id;

            $user = $this->Users->patchEntity($user, $this->request->data);
            // Evita que ele passe uma senha nova pelo array e altere
            $user->accessible('name', false);
            $user->accessible('username', false);
            $user->accessible('password', false);
            if ($this->Users->save($user)) {
                $this->Flash->success('O usuário foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O usuário não pode ser salvo. Por favor, tente novamente.');
            }
        }
        
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);

        $this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $gym_id = $this->Auth->user('gym_id');

        $user = $this->Users->get($id, ['conditions' => [
            'Users.gym_id' => $gym_id,
            'Users.is_active' => 0
        ]]);
        if (!$user) {
            throw new NotFoundException();
        }

        $user->accessible('deleted', true);
        $user->deleted = true;

        if ($this->Users->save($user)) {
            $this->Flash->success('O usuário foi deletado com sucesso.');
        } else {
            $this->Flash->error('O usuário não pode ser deletado. Por favor, tente novamente.');
        }
        return $this->redirect($this->referer());
    }

    public function change_password(){     

        // Só faz essa parada se o cara postar o form
        if ($this->request->is('post')) {
            // Ve se a senha nova bate com a confirmação
            if ($this->request->data['new-password'] == '') {
                $this->Flash->error('Você não informou a sua nova senha.');
                // return  $this->redirect(['action' => 'change_password']);
            } elseif($this->request->data['new-password'] != $this->request->data['confirm-password']) {
                $this->Flash->error('Você não confirmou a sua nova senha corretamente.');
                // return  $this->redirect(['action' => 'change_password']);
            } else {
                // Agora pega a senha atual do cara
                $user_data = $this->Users
                        ->find()
                        ->where(['id' => 2])
                        ->first();
                 /*debug($user_data);
                 exit();*/
                if ($this->request->data['current-password'] != $user_data->password) {
                    $this->Flash->error('A sua senha atual está incorreta');
                    // return  $this->redirect(['action' => 'change_password']);
                } else {
                    // Se liga como que salva, primeira vc cria um entidade vazia!!
                    // Fiz isso pra nao confundir valores do slect com entidade
                    
                    //$user = $this->Users->newEntity();
                    
                    // Aqui vc pega a entidade e seta os valores, agora eh a entidade preenchida
                    $user = $this->Users->patchEntity($user_data, 
                        [
                        'password' => $this->request->data['new-password']                        
                        ]);
                    /*debug($user);
                    exit();*/
                    if ($this->Users->save($user)) {
                        $this->Flash->success('A sua senha foi atualizada corretamente!');
                    } else {
                        $this->Flash->error('Ocorreu um erro ao salvar a sua nova senha!');
                    }
                }
            }
        }                    
            
    }   

    public function change_mail(){
        
        $user = $this->Users->get(1);
        $this->set('mail', $user->username);        
        
        if($this->request->is('post')){

            //Verificar se já existe um email igual
            $users = $this->Users
                        ->find()
                        ->select(['username'])
                        ->where(['username' => $this->request->data['mail']])
                        ->first();                      

            if($users->username == $this->request->data['mail']){
                //Se existir um email igual ele exibi esse flash
                $this->Flash->error("Email já existe");
                return  $this->redirect(['action' => 'change_mail']);
            }else{
                //Salvar o Email Temporario e Adicionar o Token e Tempo para expirar
                $user = $this->Users->patchEntity($user,
                        [
                            'mail_temp' => $this->request->data['mail'],
                            'token_mail' => 12345,
                            'token_time_exp' => date("Y-m-d H:i:s")
                        ]);
                    if($this->Users->save($user)){                           
                        $this->Flash->success('Email salvo com sucesso, verifique seu email.');
                        return  $this->redirect(['action' => 'change_mail']);                        
                    }else{
                        $this->Flash->error('Ocorreu um erro, tente novamente');
                    }
            }            
        }   
                        
    }


    public function confirm_mail(){
                       
        $mail = $this->request->query['mail'];
        $token = $this->request->query['token'];

        $users = $this->Users
                        ->find()
                        ->where([
                                'mail_temp' => $mail,
                                'token_mail' => $token
                            ])
                        ->first();        

        if($users){
            if($users->token_time_exp->wasWithinLast(3)){
                $user = $this->Users->patchEntity($users,
                            [
                                'username' => $mail, 
                                'mail_temp' => "",
                                'token_mail' => "" ,     
                                'token_time_exp' => ""                     
                            ]);            
                if($this->Users->save($user)){
                    $this->Flash->success('Email alterado com sucesso.');
                }else{
                    $this->Flash->error('Ocorreu um erro, tente novamente');
                }
            }else{
                $this->Flash->error('Sua Chave já expirou, tente gerar outra');
                return  $this->redirect(['action' => 'change_mail']);
            }                
        }else{
            $this->Flash->error("Não foi possível alterar seu email, tente novamente");
        }
    }

}
    