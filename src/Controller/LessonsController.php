<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lessons Controller
 *
 * @property \App\Model\Table\LessonsTable $Lessons */
class LessonsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Services', 'Rooms']
        ];
        $this->set('lessons', $this->paginate($this->Lessons));
        $this->set('_serialize', ['lessons']);
    }

    /**
     * View method
     *
     * @param string|null $id Lesson id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lesson = $this->Lessons->get($id, [
            'contain' => ['Services', 'Rooms']
        ]);
        $this->set('lesson', $lesson);
        $this->set('_serialize', ['lesson']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lesson = $this->Lessons->newEntity();
        if ($this->request->is('post')) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->data);
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success('The lesson has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The lesson could not be saved. Please, try again.');
            }
        }
        $services = $this->Lessons->Services->find('list', ['limit' => 200]);
        $rooms = $this->Lessons->Rooms->find('list', ['limit' => 200]);
        $this->set(compact('lesson', 'services', 'rooms'));
        $this->set('_serialize', ['lesson']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lesson = $this->Lessons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->data);
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success('The lesson has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The lesson could not be saved. Please, try again.');
            }
        }
        $services = $this->Lessons->Services->find('list', ['limit' => 200]);
        $rooms = $this->Lessons->Rooms->find('list', ['limit' => 200]);
        $this->set(compact('lesson', 'services', 'rooms'));
        $this->set('_serialize', ['lesson']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lesson = $this->Lessons->get($id);
        if ($this->Lessons->delete($lesson)) {
            $this->Flash->success('The lesson has been deleted.');
        } else {
            $this->Flash->error('The lesson could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
