<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExercisesGroups Controller
 *
 * @property \App\Model\Table\ExercisesGroupsTable $ExercisesGroups */
class ExercisesGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('exercisesGroups', $this->paginate($this->ExercisesGroups));
        $this->set('_serialize', ['exercisesGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Exercises Group id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercisesGroup = $this->ExercisesGroups->get($id, [
            'contain' => ['CardsExercises']
        ]);
        $this->set('exercisesGroup', $exercisesGroup);
        $this->set('_serialize', ['exercisesGroup']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exercisesGroup = $this->ExercisesGroups->newEntity();
        if ($this->request->is('post')) {
            $exercisesGroup = $this->ExercisesGroups->patchEntity($exercisesGroup, $this->request->data);
            if ($this->ExercisesGroups->save($exercisesGroup)) {
                $this->Flash->success('The exercises group has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The exercises group could not be saved. Please, try again.');
            }
        }
        $this->set(compact('exercisesGroup'));
        $this->set('_serialize', ['exercisesGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercises Group id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exercisesGroup = $this->ExercisesGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exercisesGroup = $this->ExercisesGroups->patchEntity($exercisesGroup, $this->request->data);
            if ($this->ExercisesGroups->save($exercisesGroup)) {
                $this->Flash->success('The exercises group has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The exercises group could not be saved. Please, try again.');
            }
        }
        $this->set(compact('exercisesGroup'));
        $this->set('_serialize', ['exercisesGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercises Group id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exercisesGroup = $this->ExercisesGroups->get($id);
        if ($this->ExercisesGroups->delete($exercisesGroup)) {
            $this->Flash->success('The exercises group has been deleted.');
        } else {
            $this->Flash->error('The exercises group could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
