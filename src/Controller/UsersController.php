<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Gyms', 'Roles']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
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
            $this->request->data['gym_id'] = 1;            
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('O usuário foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                debug($user->errors());
                $this->Flash->error('O usuário não pode ser salvo, tente novamente.');
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);        
            if ($this->Users->save($user)) {
                $this->Flash->success('O usuário foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O usuário não pode ser salvo, tente novamente.');
            }
        }
        $gyms = $this->Users->Gyms->find('list', ['limit' => 200]);
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'gyms', 'roles'));
        $this->set('_serialize', ['user']);
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
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
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
                $this->Flash->error("Email já existe");
                return  $this->redirect(['action' => 'change_mail']);
            }else{
                //Salvar o Email Temporario e Adicionar o Token
                $user = $this->Users->patchEntity($user,
                        [
                            'mail_temp' => $this->request->data['mail'],
                            'token' => 12345
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
                                'token' => $token
                            ])
                        ->first(); 

        if($users){
            $user = $this->Users->patchEntity($users,
                        [
                            'username' => $mail, 
                            'mail_temp' => "",
                            'token' => ""                           
                        ]);            
            if($this->Users->save($user)){
                $this->Flash->success('Email alterado com sucesso.');
            }else{
                $this->Flash->error('Ocorreu um erro, tente novamente');
            }
        }else{
            $this->Flash->error("Não foi possível alterar seu email, tente novamente");
        }
    }

}
    