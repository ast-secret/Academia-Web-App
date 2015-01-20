<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CardsExercisesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CardsExercisesTable Test Case
 */
class CardsExercisesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'CardsExercises' => 'app.cards_exercises',
        'Exercises' => 'app.exercises',
        'Cards' => 'app.cards',
        'Users' => 'app.users',
        'Customers' => 'app.customers',
        'Machines' => 'app.machines',
        'ExercisesGroups' => 'app.exercises_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CardsExercises') ? [] : ['className' => 'App\Model\Table\CardsExercisesTable'];        $this->CardsExercises = TableRegistry::get('CardsExercises', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CardsExercises);

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
