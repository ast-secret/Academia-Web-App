<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Weekdays Controller
 *
 * @property \App\Model\Table\WeekdaysTable $Weekdays */
class WeekdaysController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('weekdays', $this->paginate($this->Weekdays));
        $this->set('_serialize', ['weekdays']);
    }

    /**
     * View method
     *
     * @param string|null $id Weekday id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weekday = $this->Weekdays->get($id, [
            'contain' => ['Services']
        ]);
        $this->set('weekday', $weekday);
        $this->set('_serialize', ['weekday']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weekday = $this->Weekdays->newEntity();
        if ($this->request->is('post')) {
            $weekday = $this->Weekdays->patchEntity($weekday, $this->request->data);
            if ($this->Weekdays->save($weekday)) {
                $this->Flash->success('The weekday has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The weekday could not be saved. Please, try again.');
            }
        }
        $services = $this->Weekdays->Services->find('list', ['limit' => 200]);
        $this->set(compact('weekday', 'services'));
        $this->set('_serialize', ['weekday']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Weekday id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weekday = $this->Weekdays->get($id, [
            'contain' => ['Services']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weekday = $this->Weekdays->patchEntity($weekday, $this->request->data);
            if ($this->Weekdays->save($weekday)) {
                $this->Flash->success('The weekday has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The weekday could not be saved. Please, try again.');
            }
        }
        $services = $this->Weekdays->Services->find('list', ['limit' => 200]);
        $this->set(compact('weekday', 'services'));
        $this->set('_serialize', ['weekday']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Weekday id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weekday = $this->Weekdays->get($id);
        if ($this->Weekdays->delete($weekday)) {
            $this->Flash->success('The weekday has been deleted.');
        } else {
            $this->Flash->error('The weekday could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
