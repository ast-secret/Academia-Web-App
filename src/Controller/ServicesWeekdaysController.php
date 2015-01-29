<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Servicesweekdays Controller
 *
 * @property \App\Model\Table\ServicesweekdaysTable $Servicesweekdays
 */
class ServicesweekdaysController extends AppController
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
        $this->set('servicesweekdays', $this->paginate($this->Servicesweekdays));
        $this->set('_serialize', ['servicesweekdays']);
    }

    /**
     * View method
     *
     * @param string|null $id Servicesweekday id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $servicesweekday = $this->Servicesweekdays->get($id, [
            'contain' => ['Services', 'Weekdays']
        ]);
        $this->set('servicesweekday', $servicesweekday);
        $this->set('_serialize', ['servicesweekday']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $servicesweekday = $this->Servicesweekdays->newEntity();
        if ($this->request->is('post')) {
            $servicesweekday = $this->Servicesweekdays->patchEntity($servicesweekday, $this->request->data);
            if ($this->Servicesweekdays->save($servicesweekday)) {
                $this->Flash->success('The servicesweekday has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The servicesweekday could not be saved. Please, try again.');
            }
        }
        $services = $this->Servicesweekdays->Services->find('list', ['limit' => 200]);
        $weekdays = $this->Servicesweekdays->Weekdays->find('list', ['limit' => 200]);
        $this->set(compact('servicesweekday', 'services', 'weekdays'));
        $this->set('_serialize', ['servicesweekday']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Servicesweekday id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servicesweekday = $this->Servicesweekdays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicesweekday = $this->Servicesweekdays->patchEntity($servicesweekday, $this->request->data);
            if ($this->Servicesweekdays->save($servicesweekday)) {
                $this->Flash->success('The servicesweekday has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The servicesweekday could not be saved. Please, try again.');
            }
        }
        $services = $this->Servicesweekdays->Services->find('list', ['limit' => 200]);
        $weekdays = $this->Servicesweekdays->Weekdays->find('list', ['limit' => 200]);
        $this->set(compact('servicesweekday', 'services', 'weekdays'));
        $this->set('_serialize', ['servicesweekday']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Servicesweekday id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicesweekday = $this->Servicesweekdays->get($id);
        if ($this->Servicesweekdays->delete($servicesweekday)) {
            $this->Flash->success('The servicesweekday has been deleted.');
        } else {
            $this->Flash->error('The servicesweekday could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
