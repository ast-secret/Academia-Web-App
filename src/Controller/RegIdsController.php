<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RegIds Controller
 *
 * @property \App\Model\Table\RegIdsTable $RegIds
 */
class RegIdsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Gyms', 'Customers']
        ];
        $this->set('regIds', $this->paginate($this->RegIds));
        $this->set('_serialize', ['regIds']);
    }

    /**
     * View method
     *
     * @param string|null $id Reg Id id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $regId = $this->RegIds->get($id, [
            'contain' => ['Gyms', 'Customers']
        ]);
        $this->set('regId', $regId);
        $this->set('_serialize', ['regId']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $regId = $this->RegIds->newEntity();
        if ($this->request->is('post')) {
            $regId = $this->RegIds->patchEntity($regId, $this->request->data);
            if ($this->RegIds->save($regId)) {
                $this->Flash->success(__('The reg id has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The reg id could not be saved. Please, try again.'));
            }
        }
        $gyms = $this->RegIds->Gyms->find('list', ['limit' => 200]);
        $customers = $this->RegIds->Customers->find('list', ['limit' => 200]);
        $this->set(compact('regId', 'gyms', 'customers'));
        $this->set('_serialize', ['regId']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Reg Id id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $regId = $this->RegIds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $regId = $this->RegIds->patchEntity($regId, $this->request->data);
            if ($this->RegIds->save($regId)) {
                $this->Flash->success(__('The reg id has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The reg id could not be saved. Please, try again.'));
            }
        }
        $gyms = $this->RegIds->Gyms->find('list', ['limit' => 200]);
        $customers = $this->RegIds->Customers->find('list', ['limit' => 200]);
        $this->set(compact('regId', 'gyms', 'customers'));
        $this->set('_serialize', ['regId']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reg Id id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $regId = $this->RegIds->get($id);
        if ($this->RegIds->delete($regId)) {
            $this->Flash->success(__('The reg id has been deleted.'));
        } else {
            $this->Flash->error(__('The reg id could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
