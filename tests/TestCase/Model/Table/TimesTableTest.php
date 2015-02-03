<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimesTable Test Case
 */
class TimesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Times' => 'app.times',
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
        'ServicesTimes' => 'app.services_times'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Times') ? [] : ['className' => 'App\Model\Table\TimesTable'];        $this->Times = TableRegistry::get('Times', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Times);

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
