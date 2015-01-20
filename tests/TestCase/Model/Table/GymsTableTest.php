<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GymsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GymsTable Test Case
 */
class GymsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Gyms' => 'app.gyms',
        'Machines' => 'app.machines',
        'Phones' => 'app.phones',
        'Rooms' => 'app.rooms',
        'Services' => 'app.services',
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
        $config = TableRegistry::exists('Gyms') ? [] : ['className' => 'App\Model\Table\GymsTable'];        $this->Gyms = TableRegistry::get('Gyms', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Gyms);

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
