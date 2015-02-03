<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServicesTimes Controller
 *
 * @property \App\Model\Table\ServicesTimesTable $ServicesTimes */
class ServicesTimesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Services', 'Weekdays']
        ];
        $this->set('servicesTimes', $this->paginate($this->ServicesTimes));
        $this->set('_serialize', ['servicesTimes']);
    }

    /**
     * View method
     *
     * @param string|null $id Services Time id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $servicesTime = $this->ServicesTimes->get($id, [
            'contain' => ['Services', 'Weekdays']
        ]);
        $this->set('servicesTime', $servicesTime);
        $this->set('_serialize', ['servicesTime']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $servicesTime = $this->ServicesTimes->newEntity();
        if ($this->request->is('post')) {
            $servicesTime = $this->ServicesTimes->patchEntity($servicesTime, $this->request->data);
            if ($this->ServicesTimes->save($servicesTime)) {
                $this->Flash->success('The services time has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The services time could not be saved. Please, try again.');
            }
        }
        $services = $this->ServicesTimes->Services->find('list', ['limit' => 200]);
        $weekdays = $this->ServicesTimes->Weekdays->find('list', ['limit' => 200]);
        $this->set(compact('servicesTime', 'services', 'weekdays'));
        $this->set('_serialize', ['servicesTime']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Services Time id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servicesTime = $this->ServicesTimes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicesTime = $this->ServicesTimes->patchEntity($servicesTime, $this->request->data);
            if ($this->ServicesTimes->save($servicesTime)) {
                $this->Flash->success('The services time has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The services time could not be saved. Please, try again.');
            }
        }
        $services = $this->ServicesTimes->Services->find('list', ['limit' => 200]);
        $weekdays = $this->ServicesTimes->Weekdays->find('list', ['limit' => 200]);
        $this->set(compact('servicesTime', 'services', 'weekdays'));
        $this->set('_serialize', ['servicesTime']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Services Time id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicesTime = $this->ServicesTimes->get($id);
        if ($this->ServicesTimes->delete($servicesTime)) {
            $this->Flash->success('The services time has been deleted.');
        } else {
            $this->Flash->error('The services time could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
