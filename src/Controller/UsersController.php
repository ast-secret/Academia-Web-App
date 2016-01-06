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
        parent::beforeFilter($event);
        $this->Auth->allow([
            'passwordGenerator',
            'requestPasswordReset',
            'passwordReset'
        ]);
    }

    public function myPasswordSettings()
    {
        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['post', 'patch', 'put'])) {

            $user->accessible('*', false);
            $user->accessible('new_password', true);

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
        $currentUsername = $this->Auth->user('username');
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

            $this->request->data['gym_id'] = $gym_id; //Validar Unique emails
            $this->request->data['current_username'] = $currentUsername; //Validar unique email

            $user = $this->Users->patchEntity($user, $this->request->data);

            // Evita que ele passe uma senha nova pelo array e altere
            $user->accessible('password', false);
            if ($this->Users->save($user)) {
                $this->Auth->session->write($this->Auth->sessionKey . '.name', $user->name);
                $this->Auth->session->write($this->Auth->sessionKey . '.username', $user->username);
                $this->Flash->success('As alterações foram salvas com sucesso.');
                return $this->redirect(['action' => 'mySettings']);
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
        $this->viewBuilder()->layout('login');

        $this->loadModel('Gyms');

        $gym = $this->Gyms->find('all', [
            'conditions' => [
                'slug' => $this->request->params['gym_slug']
            ]
        ])
        ->first();

        if (!$gym) {
            throw new NotFoundException("Página não encontrada");
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->auth('Combinação login/senha incorreta.');
            }
        }

        $this->set([
            'gym' => $gym
        ]);
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
            'Users.id !=' => $this->Auth->user('id'),
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
            /**
             * Se possuir um usuario com o mesmo email porem deletado ele não irá falar 
             * que o email já existe
             */
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

            $user->accessible('*', false);
            $user->accessible('role_id', true);
            $user->accessible('is_active', true);
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user)) {
                $this->Flash->success('O usuário foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O usuário não pode ser salvo. Por favor, tente novamente.');
            }
        }
        
        $roles = $this->Users->Roles->find('list', ['order' => 'Roles.ordenation', 'limit' => 200]);

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

    public function requestPasswordReset()
    {
        $this->viewBuilder()->layout('login');

        $this->loadModel('Gyms');

        $gym = $this->Gyms->find('all', [
            'conditions' => [
                'slug' => $this->request->params['gym_slug']
            ]
        ])
        ->first();

        if (!$gym) {
            throw new NotFoundException("Página não encontrada");
        }

        if ($this->request->is('post')) {
            $email = $this->request->data('email');
            $token = md5($this->_generateStrongPassword(20, false, 'lud'));
            $token_exp = (new Time('+1 days'))->format('Y-m-d H:i:s');

            $user = $this->Users->find('all', [
                'conditions' => [
                    'Users.username' => $email,
                    'Users.deleted' => 0,
                    'Users.gym_id' => $gym->id
                ]
            ])
            ->first();
            if (!$user) {
                $this->Flash->error('Email não cadastrado.');
            } else {
                $user = $this->Users->patchEntity($user, [
                    'token_password' => $token,
                    'token_password_exp' => $token_exp
                ]);
                if ($this->Users->save($user)) {
                    $this->Flash->success("Informações de redefinição de senha enviadas para o endereço " .h($email) . ".");
                    $this->request->data['email'] = null;
                } else {
                    $this->Flash->error('Ocorreu um erro, por favor, tente novamente.');
                }
            }

        }

        $this->set(compact('gym'));
    }

    public function passwordReset()
    {
        $this->viewBuilder()->layout('login');

        $this->loadModel('Gyms');

        $email = $this->request->params['email'];
        $token = $this->request->params['token'];

        $gym = $this->Gyms->find('all', [
            'conditions' => [
                'slug' => $this->request->params['gym_slug']
            ]
        ])
        ->first();

        if (!$gym) {
            throw new NotFoundException("Página não encontrada");
        }

        $user = $this->Users->newEntity();

        if ($this->request->is(['post', 'put'])) {

            $user = $this->Users->find('all', [
                'fields' => [
                    'Users.id',
                    'Users.token_password',
                    'Users.token_password_exp',
                ],
                'conditions' => [
                    'Users.username' => $email,
                    'Users.deleted' => 0,
                    'Users.gym_id' => $gym->id
                ]
            ])
            ->first();

            if (!$user) {
                $this->Flash->error('Email não cadastrado.');
            } else {
                if ($token != $user->token_password) {
                    $this->Flash->error('O token informado é inválido.');
                } else {

                    if (Time::now() > $user->token_password_exp) {
                        $this->Flash->error('A requisição para redefinição de senha expirou, você deve requisitar novamente.');
                    } else {
                        $user->accessible('*', false);
                        $user->accessible('password', true);
                        $user->accessible('new_password', true);
                        $user->accessible('confirm_new_password', true);
                        $user->accessible('token_password', true);
                        $user->accessible('token_password_exp', true);

                        $this->request->data['token_password'] = null;
                        $this->request->data['token_password_exp'] = null;
                        
                        $user = $this->Users->patchEntity($user, $this->request->data);
                        if ($this->Users->save($user)) {
                            $this->Flash->success("A sua senha foi redefinida corretamente.");
                            return $this->redirect(['action' => 'login']);
                        } else {
                            $this->Flash->error('Ocorreu um erro, por favor, tente novamente.');
                        }
                    }
                }
            }
        }

        $this->set([
            'user' => $user,
            'gym' => $gym
        ]);
    }

    function _generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if(!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }
}
    