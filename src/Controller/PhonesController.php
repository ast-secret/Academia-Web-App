<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Phones Controller
 *
 * @property \App\Model\Table\PhonesTable $Phones */
class PhonesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Gyms']
        ];
        $this->set('phones', $this->paginate($this->Phones));
        $this->set('_serialize', ['phones']);
    }

    /**
     * View method
     *
     * @param string|null $id Phone id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $phone = $this->Phones->get($id, [
            'contain' => ['Gyms']
        ]);
        $this->set('phone', $phone);
        $this->set('_serialize', ['phone']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $phone = $this->Phones->newEntity();
        if ($this->request->is('post')) {
            $phone = $this->Phones->patchEntity($phone, $this->request->data);
            if ($this->Phones->save($phone)) {
                $this->Flash->success('The phone has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The phone could not be saved. Please, try again.');
            }
        }
        $gyms = $this->Phones->Gyms->find('list', ['limit' => 200]);
        $this->set(compact('phone', 'gyms'));
        $this->set('_serialize', ['phone']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Phone id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $phone = $this->Phones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->Phones->patchEntity($phone, $this->request->data);
            if ($this->Phones->save($phone)) {
                $this->Flash->success('The phone has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The phone could not be saved. Please, try again.');
            }
        }
        $gyms = $this->Phones->Gyms->find('list', ['limit' => 200]);
        $this->set(compact('phone', 'gyms'));
        $this->set('_serialize', ['phone']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Phone id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $phone = $this->Phones->get($id);
        if ($this->Phones->delete($phone)) {
            $this->Flash->success('The phone has been deleted.');
        } else {
            $this->Flash->error('The phone could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
