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
        'ExercisesGroups' => 'app.exercises_groups',
        'CardsExercises' => 'app.cards_exercises',
        'Exercises' => 'app.exercises',
        'Cards' => 'app.cards',
        'Users' => 'app.users',
        'Customers' => 'app.customers',
        'Suggestions' => 'app.suggestions',
        'Machines' => 'app.machines'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExercisesGroups') ? [] : ['className' => 'App\Model\Table\ExercisesGroupsTable'];        $this->ExercisesGroups = TableRegistry::get('ExercisesGroups', $config);    }

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
}
