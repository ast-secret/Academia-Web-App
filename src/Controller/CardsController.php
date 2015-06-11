<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\ExercisesGroup;

use Cake\Network\Exceptions\NotfoundException;

use Cake\I18n\Time;
/**
 * Cards Controller
 *
 * @property \App\Model\Table\CardsTable $Cards */
class CardsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index($customer_id = null)
    {
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
                'obs',
                'goal',
                'end_date',
                'Users.name'
            ],
            'contain' => ['Users', 'ExercisesGroups' => ['Exercises']],
            'conditions' => $conditions

        ];
        $this->set('cards', $this->paginate($this->Cards));
        $this->set(compact('customer', 'tab'));
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
    public function add($customer_id = null)
    {
        $breadcrumb = [
            'active' => 'Adicionar Ficha',
            'parents' => [
                ['label' => 'Fichas', 'url' => ['action' => 'index']]
            ]
        ];

        $card = $this->Cards->newEntity();

        if ($this->request->is('post')) {

            $this->request->data['start_date'] = Time::now();
            $this->request->data['customer_id'] = $customer_id;
            $this->request->data['user_id'] = 1;

            if (!$this->Cards->validateExercise($this->request->data)) {
                $this->Flash->error('Você deve adicionar ao menos um exercício a ficha.');

            } else {
                $card = $this->Cards->patchEntity($card, $this->request->data, ['associated' => ['ExercisesGroups.Exercises']]);

                if ($this->Cards->save($card)) {
                    $this->Flash->success('A ficha foi salva com sucesso!.');
                    return $this->redirect(['action' => 'customer', $customer_id]);
                } else {
                    $this->set('errorsList', $this->errorsToList($card->errors()));
                }
            }
        }
        $customers = $this->Cards->Customers->find('list', ['limit' => 200]);
        $this->set(compact('card', 'customers', 'breadcrumb'));
        $this->set('_serialize', ['card']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Card id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $card = $this->Cards->get($id, [
            'contain' => ['Exercises']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $card = $this->Cards->patchEntity($card, $this->request->data);
            if ($this->Cards->save($card)) {
                $this->Flash->success('The card has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The card could not be saved. Please, try again.');
            }
        }
        $users = $this->Cards->Users->find('list', ['limit' => 200]);
        $customers = $this->Cards->Customers->find('list', ['limit' => 200]);
        $exercises = $this->Cards->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('card', 'users', 'customers', 'exercises'));
        $this->set('_serialize', ['card']);
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
        $this->request->allowMethod(['post', 'delete']);
        $card = $this->Cards->get($id);
        if ($this->Cards->delete($card)) {
            $this->Flash->success('The card has been deleted.');
        } else {
            $this->Flash->error('The card could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
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
