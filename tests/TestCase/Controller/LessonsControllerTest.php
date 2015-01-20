<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LessonsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LessonsController Test Case
 */
class LessonsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Lessons' => 'app.lessons',
        'Services' => 'app.services',
        'Gyms' => 'app.gyms',
        'Machines' => 'app.machines',
        'CardsExercises' => 'app.cards_exercises',
        'Exercises' => 'app.exercises',
        'Cards' => 'app.cards',
        'Users' => 'app.users',
        'Roles' => 'app.roles',
        'Releases' => 'app.releases',
        'Customers' => 'app.customers',
        'Suggestions' => 'app.suggestions',
        'ExercisesGroups' => 'app.exercises_groups',
        'Phones' => 'app.phones',
        'Rooms' => 'app.rooms',
        'Weekdays' => 'app.weekdays',
        'ServicesWeekdays' => 'app.services_weekdays'
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
