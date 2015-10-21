<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Network\Exception\NotFoundException;

/**
 * Releases Controller
 *
 * @property \App\Model\Table\ReleasesTable $Releases */
class ReleasesController extends AppController
{

    public $helpers = ['TextBootstrap'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = [];

        $tab = (!(int)$this->request->query('tab')) ? 1 : (int)$this->request->query('tab');
        switch ($tab) {
            case 1:
                $conditions[] = ['Releases.is_active' => 1];
                break;
            case 2:
                $conditions[] = ['Releases.is_active' => 0];
                break;
            case 4:
                $conditions[] = ['Releases.destaque' => 1];
                break;
        }

        $q = $this->request->query('q');
        if ($q) {
            $conditions[] = ['Releases.text LIKE' => "%{$q}%"];
        }

        $from = $this->request->query('from');
        if ($from) {
            $conditions[] = ['Releases.created >=' => $from];
        }

        $to = $this->request->query('to');
        if ($to) {
            $conditions[] = ['Releases.created <=' => $to];
        }
        $conditions[] = ['Users.gym_id' => $this->Auth->user('gym_id')];

        $this->paginate = [
            'fields' => [
                'id',
                'title',
                'text',
                'created',
                'is_active',
                'user_id',
                'destaque',
                'dt_inicio_destaque',
                'dt_fim_destaque',
                'Users.name'
            ],
            'contain' => ['Users'],
            'order' => ['Releases.created' => 'DESC'],
            'conditions' => $conditions
        ];

        $this->set('releases', $this->paginate($this->Releases));
        /**
         * Passa este id para mostrar o botao de editar no template apenas para
         * os releases do usuario logado.
         */
        $this->set('me_id', $this->Auth->user('id'));

        $this->set(compact('tab'));
    }
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->template('form');
        $release = $this->Releases->newEntity();
        
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $release = $this->Releases->patchEntity($release, $this->request->data);

            if ($this->Releases->save($release)) {            
                $this->Flash->success('O Comunicado foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O Comunicado não pode ser salvo, tente novamente.');
            }
        }        

        $this->set(compact('release'));
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
        $this->viewBuilder()->template('form');
        
        $user_id = $this->Auth->user('id');

        $release = $this->Releases->get($id, [
            'conditions' => ['Releases.user_id' => $user_id]
        ]);

        if (!$release) {
            throw new NotFoundException();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $release = $this->Releases->patchEntity($release, $this->request->data);
            $release->user_id = $user_id;

            if ($this->Releases->save($release)) {
                $this->Flash->success('O Comunicado foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O Comunicado não pode ser salvo, tente novamente.');
            }
        }
        $this->set(compact('release'));
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
        
        $release = $this->Releases->get($id, [
            'contain' => ['Users'],
            'conditions' => ['Users.gym_id' => $this->Auth->user('gym_id')]
        ]);

        if (!$release) {
            throw new NotFoundException();
        }

        if ($this->Releases->delete($release)) {
            $this->Flash->success('O comunicado foi deletado.');
        } else {
            $this->Flash->error('O comunicado não pode ser deletado. Por favor, tente novamente.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
