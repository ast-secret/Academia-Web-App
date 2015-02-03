<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServicesTimesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServicesTimesTable Test Case
 */
class ServicesTimesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'ServicesTimes' => 'app.services_times',
        'Services' => 'app.services',
        'Gyms' => 'app.gyms',
        'Machines' => 'app.machines',
        'Phones' => 'app.phones',
        'Rooms' => 'app.rooms',
        'Lessons' => 'app.lessons',
        'Users' => 'app.users',
        'Roles' => 'app.roles',
        'Cards' => 'app.cards',
        'Customers' => 'app.customers',
        'Suggestions' => 'app.suggestions',
        'ExercisesGroups' => 'app.exercises_groups',
        'Exercises' => 'app.exercises',
        'Releases' => 'app.releases',
        'Weekdays' => 'app.weekdays',
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
        $config = TableRegistry::exists('ServicesTimes') ? [] : ['className' => 'App\Model\Table\ServicesTimesTable'];        $this->ServicesTimes = TableRegistry::get('ServicesTimes', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ServicesTimes);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
