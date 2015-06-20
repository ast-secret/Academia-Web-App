<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\ExercisesGroup;

use Cake\Network\Exceptions\NotFoundException;

use Cake\I18n\Time;
/**
 * Cards Controller
 *
 * @property \App\Model\Table\CardsTable $Cards */
class CardsController extends AppController
{

    public function printCard()
    {
        $this->layout = 'print';

        $cardId = $this->request->param('card_id');
        $card = $this->Cards->get($cardId, ['contain' => [
            'Customers',
            'Users',
            'ExercisesGroups' => ['Exercises']
        ]]);

        $this->set(compact('card'));
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $customer_id = $this->request->param('customer_id');

        $conditions = [];
        $gym_id = $this->Auth->user('gym_id');

        $tab = (int)$this->request->query('tab');

        switch ($tab) {
            case 0:
                $conditions[] = ['Cards.end_date >=' => Time::now()];
                break;
            case 1:
                $conditions[] = ['Cards.end_date <' => Time::now()];
                break;
        }

        $customer = $this->Cards->Customers->get($customer_id);

        if ($gym_id != $customer->gym_id) {
            throw new NotfoundException();
        }

        $conditions[] = ['Cards.customer_id' => $customer->id];
        $this->paginate = [
            'fields' => [
                'id',
                'goal',
                'obs',
                'end_date',
                'user_id'
            ],
            'contain' => [
                'Users' => [
                    'fields' => [
                        'name'
                    ]
                ],
                'ExercisesGroups' => [
                    'fields' => ['id', 'name', 'card_id'],
                    'Exercises' => ['fields' => ['name', 'repetition', 'exercises_group_id']],
                ], 
            ],
            'conditions' => $conditions
        ];
        $this->set('cards', $this->paginate($this->Cards));
        $this->set(compact('customer', 'tab', 'customer_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Card id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $card = $this->Cards->get($id, [
            'contain' => ['Users', 'Customers', 'ExercisesGroups' => ['Exercises']]
        ]);
        $this->set('card', $card);
        $this->set('_serialize', ['card']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer_id = $this->request->param('customer_id');
        $customer = $this->Cards->Customers->get($customer_id);

        if ($customer->gym_id != $this->Auth->user('gym_id')) {
            throw new NotFoundException();
        }

        $card = $this->Cards->newEntity();

        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['customer_id'] = $customer_id;

            $card = $this->Cards->patchEntity($card, $this->request->data);
            if ($this->Cards->save($card)) {
                $this->Flash->success('A ficha foi salva com sucesso.');
                return $this->redirect(['action' => 'index', 'customer_id' => $customer_id]);
            } else {
                $this->Flash->success('A ficha não pode ser salva. Por favor, tente novamente.');
            }
        }
        $this->set(compact('card', 'customer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Card id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $card_id = $this->request->param('card_id');

        $card = $this->Cards->get($card_id, ['contain' => ['Customers']]);

        if ($card->customer->gym_id != $this->Auth->user('gym_id')) {
            throw new NotFoundException();
        }

        if ($this->request->is(['put', 'patch', 'post'])) {

            $this->request->data['user_id'] = $this->Auth->user('id');

            $card = $this->Cards->patchEntity($card, $this->request->data);

            $card->accessible('customer_id', false);
            $card->accessible('user_id', false);
            if ($this->Cards->save($card)) {
                $this->Flash->success('A ficha foi salva com sucesso.');
                return $this->redirect(['action' => 'index', 'customer_id' => $customer_id]);
            } else {
                $this->Flash->success('A ficha não pode ser salva. Por favor, tente novamente.');
            }
        }

        $customer = $card->customer;
        $this->set(compact('card', 'customer', 'customer_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Card id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $id = $this->request->param('card_id');

        $this->request->allowMethod(['post', 'delete']);
        $card = $this->Cards->get($id, ['contain' => 'Customers']);

        if ($card->customer->gym_id != $this->Auth->user('gym_id')) {
            throw new NotFoundException();
        }

        if ($this->Cards->delete($card)) {
            $this->Flash->success('A ficha foi deletada.');
        } else {
            $this->Flash->error('A ficha não pode ser deletada. Por favor, tente novamente.');
        }
        return $this->redirect(['action' => 'index', 'customer_id' => $card->customer->id]);
    }

    public function addExercises()
    {
        $card_id = $this->request->param('card_id');
        $card = $this->Cards->get($card_id, ['contain' => [
            'Customers',
            'ExercisesGroups' => ['Exercises']
            ]
        ]);

        if ($this->request->is(['put', 'patch', 'post'])) {
            //unset($this->request->data['exercises_groups']);
            $card = $this->Cards->patchEntity($card, $this->request->data, ['associated' => ['ExercisesGroups.Exercises']]);
            //$card->exercises_groups = $this->Cards->ExercisesGroups->newEntities([['name' => 'Tey', 'exercises' => [['name' => 'supinariaaa']]]]);

            if ($this->Cards->save($card)) {
                $this->Flash->success('Os exercícios foram salvos com sucesso.');
                return $this->redirect(['action' => 'index', 'customer_id' => $card->customer->id]);
            } else {
                $this->Flash->error('Os exercícios não foram salvos. Por favor, tente novamente.');
            }
        }

        $customer = $card->customer;
        $this->set(compact('customer', 'card'));
    }

    /**
     * Exibe a ficha atual e o historico de fichas de um cliente
     * @param  int|null $id    Id o cliente
     * @return void
     */
    public function customer($customer_id = null)
    {
        $cards = $this->Cards
            ->find()
            ->contain(['Users', 'Customers', 'ExercisesGroups'=> ['Exercises']])
            ->order(['Cards.current' => 'desc'])
            ->where(['Cards.customer_id' => $customer_id]);
        $this->set(compact('cards', 'customer_id'));
    }
}
