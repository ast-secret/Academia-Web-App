<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Exercises Controller
 *
 * @property \App\Model\Table\ExercisesTable $Exercises */
class ExercisesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('exercises', $this->paginate($this->Exercises));
        $this->set('_serialize', ['exercises']);
    }

    /**
     * View method
     *
     * @param string|null $id Exercise id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercise = $this->Exercises->get($id, [
            'contain' => ['Cards']
        ]);
        $this->set('exercise', $exercise);
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exercise = $this->Exercises->newEntity();
        if ($this->request->is('post')) {
            $exercise = $this->Exercises->patchEntity($exercise, $this->request->data);
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success('The exercise has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The exercise could not be saved. Please, try again.');
            }
        }
        $cards = $this->Exercises->Cards->find('list', ['limit' => 200]);
        $this->set(compact('exercise', 'cards'));
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercise id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exercise = $this->Exercises->get($id, [
            'contain' => ['Cards']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exercise = $this->Exercises->patchEntity($exercise, $this->request->data);
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success('The exercise has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The exercise could not be saved. Please, try again.');
            }
        }
        $cards = $this->Exercises->Cards->find('list', ['limit' => 200]);
        $this->set(compact('exercise', 'cards'));
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercise id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exercise = $this->Exercises->get($id);
        if ($this->Exercises->delete($exercise)) {
            $this->Flash->success('The exercise has been deleted.');
        } else {
            $this->Flash->error('The exercise could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
