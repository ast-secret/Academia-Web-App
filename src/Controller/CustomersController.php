<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exceptions\NotFoundException;

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
        $conditions = [];
        $q = $this->request->query('q');
        if ($q) {
            $conditions[] = [
                'or' => [
                    'Customers.name LIKE' => "%{$q}%",
                    'Customers.email LIKE' => "%{$q}%",
                ]
            ];
        }

        $tab = (int) $this->request->query('tab');
        $conditions[] = $this->tabFilter($tab, 'Customers');

        $conditions[] = ['Customers.gym_id' => $this->Auth->user('gym_id')];

        $this->paginate = [
            'fields' => [
                'id',
                'name',
                'email',
                'registration',
                'is_active'
            ],
            'conditions' => $conditions
        ];
        $this->set('customers', $this->paginate($this->Customers));
        $this->set(compact('tab'));
        
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
            
            $this->request->data['gym_id'] = $this->Auth->user('gym_id');

            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success('O Cliente foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O Cliente não pode ser salvo. Pro favor, tente novamente');
            }
        }
        $this->set(compact('customer'));
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
        if (!$id) {
            throw new NotFoundException("Página não encontrada");
        }

        $customer = $this->Customers->get($id, [
            'conditions' => [
                'Customers.gym_id' => $this->Auth->user('gym_id')
            ]
        ]);

        if (!$customer) {
            throw new NotFoundException("Página não encontrada");
        }

        if ($this->request->is(['post', 'put'])) {
            
            $this->request->data['gym_id'] = $this->Auth->user('gym_id');

            $customer->accessible('password', false);

            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success('As alterações foram feitas com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('As alterações não foram salvar. Por favor, tente novamente');
            }
        }

        $this->set(compact('customer'));
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
