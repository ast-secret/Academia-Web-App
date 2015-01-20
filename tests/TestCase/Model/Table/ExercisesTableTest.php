<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExercisesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExercisesTable Test Case
 */
class ExercisesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Exercises' => 'app.exercises',
        'Cards' => 'app.cards',
        'Users' => 'app.users',
        'Customers' => 'app.customers',
        'Suggestions' => 'app.suggestions',
        'CardsExercises' => 'app.cards_exercises',
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
        $config = TableRegistry::exists('Exercises') ? [] : ['className' => 'App\Model\Table\ExercisesTable'];        $this->Exercises = TableRegistry::get('Exercises', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Exercises);

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
