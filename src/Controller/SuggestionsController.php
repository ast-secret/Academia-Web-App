<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Suggestions Controller
 *
 * @property \App\Model\Table\SuggestionsTable $Suggestions */
class SuggestionsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $breadcrumb = [
            'active' => 'Sugestões'
        ];

        $tab = !$this->request->query('tab') ? 1 : (int)$this->request->query('tab');

        $conditions = [];
        switch ($tab) {
            case 1:
                $conditions[] = ['Suggestions.is_read' => 0];
                break;
            case 2:
                $conditions[] = [
                    'Suggestions.is_star' => 1
                ];
                break;
            case 3:
                $conditions[] = ['Suggestions.is_read' => 1];
                break;
        }

        $q = $this->request->query('q');
        if ($q) {
            $conditions[] = ['Customers.name LIKE' => "%{$q}%"];
        }

        $from = $this->request->query('from');
        if ($from) {
            $conditions[] = ['Suggestions.created >=' => $from];
        }
        $to = $this->request->query('to');
        if ($to) {
            $conditions[] = ['Suggestions.created <=' => $to];
        }

        $this->paginate = [
            'contain' => ['Customers'],
            'conditions' => [
                $conditions
            ]
        ];

        $this->set(compact('breadcrumb', 'tab'));
        $this->set('suggestions', $this->paginate($this->Suggestions));
    }
    /**
     * View method
     *
     * @param string|null $id Suggestion id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $breadcrumb = [
            'parents' => [
                [
                    'label' => 'Sugestões',
                    'url' => [
                        'action' => 'index'
                    ]
                ]
            ],
            'active' => 'Sugestão'
        ];

        $suggestion = $this->Suggestions->get($id, [
            'contain' => ['Customers']
        ]);
        $this->set(compact('breadcrumb'));
        $this->set('suggestion', $suggestion);
        $this->set('_serialize', ['suggestion']);
    }

    public function toggleIsStar()
    {
        $this->layout = 'ajax';
        if (!$this->request->is('ajax')) {
            throw new MethodNotAllowedException();
        }

        $suggestion = $this->Suggestions->get($this->request->data('id'));
        $suggestion = $this->Suggestions->patchEntity($suggestion, ['is_star' => $this->request->data('add')]);

        if ($this->Suggestions->save($suggestion)) {
            echo json_encode(['ok']);
        } else {
            echo json_encode($suggestion->errors());
        }
    }

    public function toggleIsRead()
    {
        $this->layout = 'ajax';
        if (!$this->request->is('ajax')) {
            throw new MethodNotAllowedException();
        }

        $suggestion = $this->Suggestions->get($this->request->data['id']);
        $suggestion = $this->Suggestions->patchEntity($suggestion, ['is_read' => $this->request->data['add']]);

        if ($this->Suggestions->save($suggestion)) {
            echo json_encode(['ok']);
        } else {
            echo json_encode($suggestion->errors());
        }
    }
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $suggestion = $this->Suggestions->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['customer_id'] = 1;
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success('The suggestion has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The suggestion could not be saved. Please, try again.');
            }
        }
        //$customers = $this->Suggestions->Customers->find('list', ['limit' => 200]);
        $customers = $this->Suggestions->Customers->find('list', array('conditions' => array('Customers.id' => '1')));        
        $this->set(compact('suggestion', 'customers'));
        $this->set('_serialize', ['suggestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Suggestion id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $suggestion = $this->Suggestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success('The suggestion has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The suggestion could not be saved. Please, try again.');
            }
        }
        $customers = $this->Suggestions->Customers->find('list', ['limit' => 200]);
        $this->set(compact('suggestion', 'customers'));
        $this->set('_serialize', ['suggestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Suggestion id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $suggestion = $this->Suggestions->get($id);
        if ($this->Suggestions->delete($suggestion)) {
            $this->Flash->success('The suggestion has been deleted.');
        } else {
            $this->Flash->error('The suggestion could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
