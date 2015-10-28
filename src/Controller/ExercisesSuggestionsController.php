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
                'ExercisesSuggestions.is_active' => true,
                'ExercisesSuggestions.name LIKE' => '%'.$term.'%'
            ],
            'limit' => 20
        ]);

        echo json_encode($suggestions);
        $this->autoRender = false;
    }
}
