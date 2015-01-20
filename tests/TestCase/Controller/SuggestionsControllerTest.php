<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SuggestionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SuggestionsController Test Case
 */
class SuggestionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Suggestions' => 'app.suggestions',
        'Customers' => 'app.customers',
        'Cards' => 'app.cards',
        'Users' => 'app.users',
        'Gyms' => 'app.gyms',
        'Machines' => 'app.machines',
        'CardsExercises' => 'app.cards_exercises',
        'Exercises' => 'app.exercises',
        'ExercisesGroups' => 'app.exercises_groups',
        'Phones' => 'app.phones',
        'Rooms' => 'app.rooms',
        'Lessons' => 'app.lessons',
        'Services' => 'app.services',
        'Weekdays' => 'app.weekdays',
        'ServicesWeekdays' => 'app.services_weekdays',
        'Roles' => 'app.roles',
        'Releases' => 'app.releases'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
