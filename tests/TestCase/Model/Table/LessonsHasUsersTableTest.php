<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LessonsHasUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LessonsHasUsersTable Test Case
 */
class LessonsHasUsersTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'LessonsHasUsers' => 'app.lessons_has_users',
        'Lessons' => 'app.lessons',
        'Services' => 'app.services',
        'Rooms' => 'app.rooms',
        'Users' => 'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LessonsHasUsers') ? [] : ['className' => 'App\Model\Table\LessonsHasUsersTable'];        $this->LessonsHasUsers = TableRegistry::get('LessonsHasUsers', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LessonsHasUsers);

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
