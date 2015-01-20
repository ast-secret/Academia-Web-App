<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WeekdaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WeekdaysTable Test Case
 */
class WeekdaysTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Weekdays' => 'app.weekdays',
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
        'Lessons' => 'app.lessons',
        'ServicesWeekdays' => 'app.services_weekdays'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Weekdays') ? [] : ['className' => 'App\Model\Table\WeekdaysTable'];        $this->Weekdays = TableRegistry::get('Weekdays', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Weekdays);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
