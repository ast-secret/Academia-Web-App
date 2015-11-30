<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegIdsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegIdsTable Test Case
 */
class RegIdsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reg_ids',
        'app.gyms',
        'app.machines',
        'app.phones',
        'app.rooms',
        'app.lessons',
        'app.services',
        'app.times',
        'app.users',
        'app.roles',
        'app.cards',
        'app.customers',
        'app.suggestions',
        'app.exercises',
        'app.releases'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RegIds') ? [] : ['className' => 'App\Model\Table\RegIdsTable'];
        $this->RegIds = TableRegistry::get('RegIds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RegIds);

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
