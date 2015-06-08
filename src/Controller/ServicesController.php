<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services */
class ServicesController extends AppController
{

    public $helpers = ['Weekdays'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = [];
        /**
         * Filtra a busca da caixa de busca
         * @var string
         */
        $q = $this->request->query('q');
        if ($q) {
            $conditions[] = ['Services.name LIKE' => "%{$q}%"];
        }
        $this->paginate = [
            'conditions' => $conditions,
            'contain' => [
                'Times' => [
                    'strategy' => 'select',
                    'queryBuilder' => function($q){
                        return $q->order(['weekday' => 'DESC', 'start_hour' => 'ASC']);
                    }
                ]
            ],
            'order' => ['Times.weekday_id' => 'DESC']
        ];
        $this->set('services', $this->paginate($this->Services));
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
                        'action' => 'index',
                    ]
                ]
            ],
            'active' => 'Adicionar Aula'
        ];

        $service = $this->Services->newEntity(null, ['associated' => ['Times']]);

        if ($this->request->is('post')) {

            $this->request->data['gym_id'] = 1;

            $service = $this->Services->patchEntity($service, $this->request->data, ['associated' => ['Times']]);

            if ($this->Services->save($service)) {
                $this->Flash->success('A aula foi salva com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('A aula não pode ser salva, por favor tente novamente.');    
            }
        }
        $gyms = $this->Services->Gyms->find('list', ['limit' => 200]);
        $weekdays = $this->Services->Times->weekdays->find('list', ['limit' => 200]);

        $this->set(compact('service', 'gyms', 'weekdays', 'breadcrumb'));
        // $this->set('_serialize', ['service']);
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

        $breadcrumb = [
            'parents' => [
                [
                    'label' => 'Aulas',
                    'url' => [
                        'action' => 'index',
                    ]
                ]
            ],
            'active' => 'Editar Aula'
        ];

        $service = $this->Services->get($id, [
            'contain' => ['Times']
        ]);

        if ($service->times) {
            foreach ($service->times as $key => $value) {
                $service->times[$key]->start_hour = $value->start_hour->format('H:m');
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $service = $this->Services->patchEntity($service, $this->request->data, ['associated' => ['Times']]);

            if ($this->Services->save($service)) {

                if ($this->request->data['timesDelete']) {
                    $ids = explode(';', $this->request->data['timesDelete']);
                    foreach ($ids as $id) {
                        if (is_numeric($id)) {
                            $timeDelete = $this->Services->Times->get($id);
                            $this->Services->Times->delete($timeDelete);
                        }
                    }
                }
                
                $this->Flash->success('A aula foi editada com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('A aula não pode ser salva, por favor tente novamente.');
            }
        }

        $gyms = $this->Services->Gyms->find('list', ['limit' => 200]);
        $weekdays = $this->Services->Times->Weekdays->find('list', ['limit' => 200]);

        $this->set(compact('service', 'gyms', 'breadcrumb', 'weekdays'));
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
