<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Gyms Controller
 *
 * @property \App\Model\Table\GymsTable $Gyms */
class GymsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('gyms', $this->paginate($this->Gyms));
        $this->set('_serialize', ['gyms']);
    }

    /**
     * View method
     *
     * @param string|null $id Gym id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gym = $this->Gyms->get($id, [
            'contain' => ['Machines', 'Phones', 'Rooms', 'Services', 'Users']
        ]);
        $this->set('gym', $gym);
        $this->set('_serialize', ['gym']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gym = $this->Gyms->newEntity();
        if ($this->request->is('post')) {
            $gym = $this->Gyms->patchEntity($gym, $this->request->data);
            if ($this->Gyms->save($gym)) {
                $this->Flash->success('The gym has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The gym could not be saved. Please, try again.');
            }
        }
        $this->set(compact('gym'));
        $this->set('_serialize', ['gym']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Gym id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gym = $this->Gyms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gym = $this->Gyms->patchEntity($gym, $this->request->data);
            if ($this->Gyms->save($gym)) {
                $this->Flash->success('The gym has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The gym could not be saved. Please, try again.');
            }
        }
        $this->set(compact('gym'));
        $this->set('_serialize', ['gym']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Gym id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gym = $this->Gyms->get($id);
        if ($this->Gyms->delete($gym)) {
            $this->Flash->success('The gym has been deleted.');
        } else {
            $this->Flash->error('The gym could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
