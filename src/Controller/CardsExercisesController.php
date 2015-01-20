<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CardsExercises Controller
 *
 * @property \App\Model\Table\CardsExercisesTable $CardsExercises */
class CardsExercisesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Exercises', 'Cards', 'Machines', 'ExercisesGroups']
        ];
        $this->set('cardsExercises', $this->paginate($this->CardsExercises));
        $this->set('_serialize', ['cardsExercises']);
    }

    /**
     * View method
     *
     * @param string|null $id Cards Exercise id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cardsExercise = $this->CardsExercises->get($id, [
            'contain' => ['Exercises', 'Cards', 'Machines', 'ExercisesGroups']
        ]);
        $this->set('cardsExercise', $cardsExercise);
        $this->set('_serialize', ['cardsExercise']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cardsExercise = $this->CardsExercises->newEntity();
        if ($this->request->is('post')) {
            $cardsExercise = $this->CardsExercises->patchEntity($cardsExercise, $this->request->data);
            if ($this->CardsExercises->save($cardsExercise)) {
                $this->Flash->success('The cards exercise has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cards exercise could not be saved. Please, try again.');
            }
        }
        $exercises = $this->CardsExercises->Exercises->find('list', ['limit' => 200]);
        $cards = $this->CardsExercises->Cards->find('list', ['limit' => 200]);
        $machines = $this->CardsExercises->Machines->find('list', ['limit' => 200]);
        $exercisesGroups = $this->CardsExercises->ExercisesGroups->find('list', ['limit' => 200]);
        $this->set(compact('cardsExercise', 'exercises', 'cards', 'machines', 'exercisesGroups'));
        $this->set('_serialize', ['cardsExercise']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cards Exercise id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cardsExercise = $this->CardsExercises->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cardsExercise = $this->CardsExercises->patchEntity($cardsExercise, $this->request->data);
            if ($this->CardsExercises->save($cardsExercise)) {
                $this->Flash->success('The cards exercise has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cards exercise could not be saved. Please, try again.');
            }
        }
        $exercises = $this->CardsExercises->Exercises->find('list', ['limit' => 200]);
        $cards = $this->CardsExercises->Cards->find('list', ['limit' => 200]);
        $machines = $this->CardsExercises->Machines->find('list', ['limit' => 200]);
        $exercisesGroups = $this->CardsExercises->ExercisesGroups->find('list', ['limit' => 200]);
        $this->set(compact('cardsExercise', 'exercises', 'cards', 'machines', 'exercisesGroups'));
        $this->set('_serialize', ['cardsExercise']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cards Exercise id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cardsExercise = $this->CardsExercises->get($id);
        if ($this->CardsExercises->delete($cardsExercise)) {
            $this->Flash->success('The cards exercise has been deleted.');
        } else {
            $this->Flash->error('The cards exercise could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
