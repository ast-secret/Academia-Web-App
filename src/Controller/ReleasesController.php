<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Releases Controller
 *
 * @property \App\Model\Table\ReleasesTable $Releases */
class ReleasesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('releases', $this->paginate($this->Releases));
        $this->set('_serialize', ['releases']);
    }

    /**
     * View method
     *
     * @param string|null $id Release id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $release = $this->Releases->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('release', $release);
        $this->set('_serialize', ['release']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $release = $this->Releases->newEntity();
        if ($this->request->is('post')) {
            $release = $this->Releases->patchEntity($release, $this->request->data);
            if ($this->Releases->save($release)) {
                $this->Flash->success('The release has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The release could not be saved. Please, try again.');
            }
        }
        $users = $this->Releases->Users->find('list', array('conditions' => array('Users.id' => '1')));
        $this->set(compact('release', 'users'));
        $this->set('_serialize', ['release']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Release id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $release = $this->Releases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $release = $this->Releases->patchEntity($release, $this->request->data);
            if ($this->Releases->save($release)) {
                $this->Flash->success('The release has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The release could not be saved. Please, try again.');
            }
        }
        $users = $this->Releases->Users->find('list', ['limit' => 200]);
        $this->set(compact('release', 'users'));
        $this->set('_serialize', ['release']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Release id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $release = $this->Releases->get($id);
        if ($this->Releases->delete($release)) {
            $this->Flash->success('The release has been deleted.');
        } else {
            $this->Flash->error('The release could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
