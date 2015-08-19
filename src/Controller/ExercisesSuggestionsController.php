<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExercisesSuggestions Controller
 *
 * @property \App\Model\Table\ExercisesSuggestionsTable $ExercisesSuggestions
 */
class ExercisesSuggestionsController extends AppController
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
        $term = $this->request->query('term');
        $suggestions = $this->ExercisesSuggestions->find('all', [
            'fields' => [
                'ExercisesSuggestions.name'
            ],
            'conditions' => [
                'ExercisesSuggestions.name LIKE' => '%'.$term.'%'
            ],
            'limit' => 20
        ]);

        echo json_encode($suggestions);
        $this->autoRender = false;
    }

    /**
     * View method
     *
     * @param string|null $id Exercises Suggestion id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercisesSuggestion = $this->ExercisesSuggestions->get($id, [
            'contain' => []
        ]);
        $this->set('exercisesSuggestion', $exercisesSuggestion);
        $this->set('_serialize', ['exercisesSuggestion']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exercisesSuggestion = $this->ExercisesSuggestions->newEntity();
        if ($this->request->is('post')) {
            $exercisesSuggestion = $this->ExercisesSuggestions->patchEntity($exercisesSuggestion, $this->request->data);
            if ($this->ExercisesSuggestions->save($exercisesSuggestion)) {
                $this->Flash->success(__('The exercises suggestion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercises suggestion could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('exercisesSuggestion'));
        $this->set('_serialize', ['exercisesSuggestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercises Suggestion id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exercisesSuggestion = $this->ExercisesSuggestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exercisesSuggestion = $this->ExercisesSuggestions->patchEntity($exercisesSuggestion, $this->request->data);
            if ($this->ExercisesSuggestions->save($exercisesSuggestion)) {
                $this->Flash->success(__('The exercises suggestion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercises suggestion could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('exercisesSuggestion'));
        $this->set('_serialize', ['exercisesSuggestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercises Suggestion id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exercisesSuggestion = $this->ExercisesSuggestions->get($id);
        if ($this->ExercisesSuggestions->delete($exercisesSuggestion)) {
            $this->Flash->success(__('The exercises suggestion has been deleted.'));
        } else {
            $this->Flash->error(__('The exercises suggestion could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
