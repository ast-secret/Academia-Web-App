<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cards Controller
 *
 * @property \App\Model\Table\CardsTable $Cards */
class CardsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Customers']
        ];
        $this->set('cards', $this->paginate($this->Cards));
        $this->set('_serialize', ['cards']);
    }

    /**
     * View method
     *
     * @param string|null $id Card id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $card = $this->Cards->get($id, [
            'contain' => ['Users', 'Customers', 'Exercises']
        ]);
        $this->set('card', $card);
        $this->set('_serialize', ['card']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $card = $this->Cards->newEntity();
        if ($this->request->is('post')) {
            $card = $this->Cards->patchEntity($card, $this->request->data);
            if ($this->Cards->save($card)) {
                $this->Flash->success('The card has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The card could not be saved. Please, try again.');
            }
        }
        $users = $this->Cards->Users->find('list', ['limit' => 200]);
        $customers = $this->Cards->Customers->find('list', ['limit' => 200]);
        $exercises = $this->Cards->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('card', 'users', 'customers', 'exercises'));
        $this->set('_serialize', ['card']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Card id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $card = $this->Cards->get($id, [
            'contain' => ['Exercises']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $card = $this->Cards->patchEntity($card, $this->request->data);
            if ($this->Cards->save($card)) {
                $this->Flash->success('The card has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The card could not be saved. Please, try again.');
            }
        }
        $users = $this->Cards->Users->find('list', ['limit' => 200]);
        $customers = $this->Cards->Customers->find('list', ['limit' => 200]);
        $exercises = $this->Cards->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('card', 'users', 'customers', 'exercises'));
        $this->set('_serialize', ['card']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Card id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $card = $this->Cards->get($id);
        if ($this->Cards->delete($card)) {
            $this->Flash->success('The card has been deleted.');
        } else {
            $this->Flash->error('The card could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
