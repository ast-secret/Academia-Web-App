<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers */
class CustomersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $breadcrumb = [
            'active' => 'Clientes'
        ];

        $this->set(compact('breadcrumb'));
        $this->set('customers', $this->paginate($this->Customers));
        $this->set('_serialize', ['customers']);
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Cards', 'Suggestions']
        ]);
        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success('O Aluno foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                //debug($customer->errors());
                $this->Flash->error('O Aluno não pode ser salvo, tente novamente');
            }
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Users');

        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        // Variavel Teste de Sessão         
        $usuarioSession = $this->request->data['id'] = 3;   

        if ($this->request->is(['patch', 'post', 'put'])) {
        //Select para confirmar se o confirm_password é referente ao do usuario logado
        $userPass = $this->Users
                        ->find()
                        ->where(['password'=>$this->request->data['confirm_password'],'id' => $usuarioSession])
                        ->first();            
            //Apenas Alterar a Senha, isso exige a senha do Usuario logado
            if($customer->password!=$this->request->data['password']){
                //Verifica se ele quer trocar a senha, se sim confirma  a senha do logado
                if($userPass && $this->request->data['confirm_password']!=''){
                    $customer = $this->Customers->patchEntity($customer, $this->request->data);        
                    if ($this->Customers->save($customer)) {
                        $this->Flash->success('O Aluno foi salvo com sucesso.');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('O Aluno não pode ser salvo, tente novamente.');
                    }
                }else{
                    $this->Flash->error('Senha do Administrador está incorreta, tente novamente.');
                }
            }else{
                $customer = $this->Customers->patchEntity($customer, $this->request->data);         
                    if ($this->Customers->save($customer)) {
                        $this->Flash->success('O Aluno foi salvo com sucesso.');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('O Aluno não pode ser salvo, tente novamente.');
                    }
            }

        }       
        
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success('The customer has been deleted.');
        } else {
            $this->Flash->error('The customer could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
