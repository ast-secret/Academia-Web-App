<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LessonsHasUsers Controller
 *
 * @property \App\Model\Table\LessonsHasUsersTable $LessonsHasUsers */
class LessonsHasUsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Lessons', 'Users']
        ];
        $this->set('lessonsHasUsers', $this->paginate($this->LessonsHasUsers));
        $this->set('_serialize', ['lessonsHasUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Lessons Has User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lessonsHasUser = $this->LessonsHasUsers->get($id, [
            'contain' => ['Lessons', 'Users']
        ]);
        $this->set('lessonsHasUser', $lessonsHasUser);
        $this->set('_serialize', ['lessonsHasUser']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lessonsHasUser = $this->LessonsHasUsers->newEntity();
        if ($this->request->is('post')) {
            $lessonsHasUser = $this->LessonsHasUsers->patchEntity($lessonsHasUser, $this->request->data);
            if ($this->LessonsHasUsers->save($lessonsHasUser)) {
                $this->Flash->success('The lessons has user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The lessons has user could not be saved. Please, try again.');
            }
        }
        $lessons = $this->LessonsHasUsers->Lessons->find('list', ['limit' => 200]);
        $users = $this->LessonsHasUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('lessonsHasUser', 'lessons', 'users'));
        $this->set('_serialize', ['lessonsHasUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lessons Has User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lessonsHasUser = $this->LessonsHasUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lessonsHasUser = $this->LessonsHasUsers->patchEntity($lessonsHasUser, $this->request->data);
            if ($this->LessonsHasUsers->save($lessonsHasUser)) {
                $this->Flash->success('The lessons has user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The lessons has user could not be saved. Please, try again.');
            }
        }
        $lessons = $this->LessonsHasUsers->Lessons->find('list', ['limit' => 200]);
        $users = $this->LessonsHasUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('lessonsHasUser', 'lessons', 'users'));
        $this->set('_serialize', ['lessonsHasUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lessons Has User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lessonsHasUser = $this->LessonsHasUsers->get($id);
        if ($this->LessonsHasUsers->delete($lessonsHasUser)) {
            $this->Flash->success('The lessons has user has been deleted.');
        } else {
            $this->Flash->error('The lessons has user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
