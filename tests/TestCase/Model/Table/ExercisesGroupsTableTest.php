<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExercisesGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExercisesGroupsTable Test Case
 */
class ExercisesGroupsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exercises_groups',
        'app.cards',
        'app.users',
        'app.gyms',
        'app.machines',
        'app.phones',
        'app.rooms',
        'app.lessons',
        'app.services',
        'app.times',
        'app.suggestions',
        'app.customers',
        'app.roles',
        'app.releases',
        'app.exercises'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExercisesGroups') ? [] : ['className' => 'App\Model\Table\ExercisesGroupsTable'];
        $this->ExercisesGroups = TableRegistry::get('ExercisesGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExercisesGroups);

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
