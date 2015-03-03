<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

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
        $breadcrumb = [
            'active' => 'Usuários'
        ];

        $this->paginate = [
            'contain' => ['Times'],
            'order' => ['Times.weekday_id' => 'DESC']
        ];
        $this->paginate = [
            'contain' => ['Gyms', 'Roles']
        ];
        $this->set(compact('breadcrumb'));
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
        
        // Variavel Teste de Sessão 
        
        $usuarioSession = $this->request->data['id'] = 3;   
        //Select para confirmar se o confirm_password é referente ao do usuario logado
        $userPass = $this->Users
                        ->find()
                        ->where(['password'=>$this->request->data['confirm_password'],'id' => $usuarioSession])
                        ->first();            


        if ($this->request->is(['patch', 'post', 'put'])) {
            //Apenas Alterar a Senha, isso exige a senha do Usuario logado
            if($user->password!=$this->request->data['password']){
                //Verifica se ele quer trocar a senha, se sim confirma  a senha do logado
                if($userPass && $this->request->data['confirm_password']!=''){
                    $user = $this->Users->patchEntity($user, $this->request->data);        
                    if ($this->Users->save($user)) {
                        $this->Flash->success('O usuário foi salvo com sucesso.');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('O usuário não pode ser salvo, tente novamente.');
                    }
                }else{
                    $this->Flash->error('Sua senha está incorreta, tente novamente.');
                }
            }else{
                $user = $this->Users->patchEntity($user, $this->request->data);        
                    if ($this->Users->save($user)) {
                        $this->Flash->success('O usuário foi salvo com sucesso.');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('O usuário não pode ser salvo, tente novamente.');
                    }
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
    