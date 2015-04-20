<?php
namespace App\Controller;

use App\Controller\AppController;

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

        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['Releases.created' => 'DESC'],
            'conditions' => $conditions
        ];

        $breadcrumb = ['active' => 'Comunicados'];
        $this->set(compact('breadcrumb'));

        $this->set('releases', $this->paginate($this->Releases));
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
        $breadcrumb = [
            'active' => 'Criar comunicado',
            'parents' => [
                [
                    'label' => 'Comunicados',
                    'url' => ['action' => 'index']
                ]
            ]
        ];
        $release = $this->Releases->get($id, [
            'contain' => ['Users']
        ]);
        $this->set(compact('release', 'breadcrumb'));
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $release = $this->Releases->newEntity();

        $this->request->data['user_id'] = 1;
        
        if ($this->request->is('post')) {
            $release = $this->Releases->patchEntity($release, $this->request->data);
            if ($this->Releases->save($release)) {            
                $this->Flash->success('O Comunicado foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O Comunicado não pode ser salvo, tente novamente.');
            }
        }        

        $breadcrumb = [
            'active' => 'Criar comunicado',
            'parents' => [
                [
                    'label' => 'Comunicados',
                    'url' => ['action' => 'index']
                ]
            ]
        ];
       
        $this->set(compact('breadcrumb', 'release'));
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
        $breadcrumb = [
            'active' => 'Editar comunicado',
            'parents' => [
                [
                    'label' => 'Comunicados',
                    'url' => ['action' => 'index']
                ]
            ]
        ];

        $release = $this->Releases->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $this->request->data['user_id'] = $this->Auth->user('id');

            $release = $this->Releases->patchEntity($release, $this->request->data);

            if ($this->Releases->save($release)) {
                $this->Flash->success('O Comunicado foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('O Comunicado não pode ser salvo, tente novamente.');
            }
        }
        $this->set(compact('release', 'breadcrumb'));
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
