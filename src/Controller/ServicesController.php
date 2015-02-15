<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services */
class ServicesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Times']
        ];
        $this->set('services', $this->paginate($this->Services));
        $this->set('_serialize', ['services']);
    }

    /**
     * View method
     *
     * @param string|null $id Service id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => ['Gyms', 'Times']
        ]);
        $this->set('service', $service);
        $this->set('_serialize', ['service']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $breadcrumb = [
            'parents' => [
                [
                    'label' => 'Aulas',
                    'url' => [
                        'action' => 'index'
                    ]
                ]
            ],
            'active' => 'Adicionar Aula'
        ];

        $service = $this->Services->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['gym_id'] = 1;

            $service = $this->Services->patchEntity($service, $this->request->data, ['associated' => ['Times']]);

            if ($this->Services->save($service)) {
                $this->Flash->success('A aula foi salva.');
                return $this->redirect(['action' => 'index']);
            } else {
                // debug($service->errors());
                $this->Flash->error('A aula não pode ser salva, por favor tente novamente.');
            }
        }
        $gyms = $this->Services->Gyms->find('list', ['limit' => 200]);
        $weekdays = $this->Services->Times->weekdays->find('list', ['limit' => 200]);

        $this->set(compact('service', 'gyms', 'weekdays', 'breadcrumb'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Service id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->data);
            if ($this->Services->save($service)) {
                $this->Flash->success('The service has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The service could not be saved. Please, try again.');
            }
        }
        $gyms = $this->Services->Gyms->find('list', ['limit' => 200]);
        $this->set(compact('service', 'gyms'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Service id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success('The service has been deleted.');
        } else {
            $this->Flash->error('The service could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
