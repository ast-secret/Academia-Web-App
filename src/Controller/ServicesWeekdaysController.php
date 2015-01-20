<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServicesWeekdays Controller
 *
 * @property \App\Model\Table\ServicesWeekdaysTable $ServicesWeekdays */
class ServicesWeekdaysController extends AppController
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
        $this->set('servicesWeekdays', $this->paginate($this->ServicesWeekdays));
        $this->set('_serialize', ['servicesWeekdays']);
    }

    /**
     * View method
     *
     * @param string|null $id Services Weekday id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $servicesWeekday = $this->ServicesWeekdays->get($id, [
            'contain' => ['Services', 'Weekdays']
        ]);
        $this->set('servicesWeekday', $servicesWeekday);
        $this->set('_serialize', ['servicesWeekday']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $servicesWeekday = $this->ServicesWeekdays->newEntity();
        if ($this->request->is('post')) {
            $servicesWeekday = $this->ServicesWeekdays->patchEntity($servicesWeekday, $this->request->data);
            if ($this->ServicesWeekdays->save($servicesWeekday)) {
                $this->Flash->success('The services weekday has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The services weekday could not be saved. Please, try again.');
            }
        }
        $services = $this->ServicesWeekdays->Services->find('list', ['limit' => 200]);
        $weekdays = $this->ServicesWeekdays->Weekdays->find('list', ['limit' => 200]);
        $this->set(compact('servicesWeekday', 'services', 'weekdays'));
        $this->set('_serialize', ['servicesWeekday']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Services Weekday id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servicesWeekday = $this->ServicesWeekdays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicesWeekday = $this->ServicesWeekdays->patchEntity($servicesWeekday, $this->request->data);
            if ($this->ServicesWeekdays->save($servicesWeekday)) {
                $this->Flash->success('The services weekday has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The services weekday could not be saved. Please, try again.');
            }
        }
        $services = $this->ServicesWeekdays->Services->find('list', ['limit' => 200]);
        $weekdays = $this->ServicesWeekdays->Weekdays->find('list', ['limit' => 200]);
        $this->set(compact('servicesWeekday', 'services', 'weekdays'));
        $this->set('_serialize', ['servicesWeekday']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Services Weekday id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicesWeekday = $this->ServicesWeekdays->get($id);
        if ($this->ServicesWeekdays->delete($servicesWeekday)) {
            $this->Flash->success('The services weekday has been deleted.');
        } else {
            $this->Flash->error('The services weekday could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
