<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MachinesFixture
 *
 */
class MachinesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'gym_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_equipments_gym_infos1_idx' => ['type' => 'index', 'columns' => ['gym_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'name_UNIQUE' => ['type' => 'unique', 'columns' => ['name'], 'length' => []],
            'fk_equipments_gym_infos1' => ['type' => 'foreign', 'columns' => ['gym_id'], 'references' => ['gyms', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'gym_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
<<<<<<< HEAD
            'created' => '2015-01-24 03:55:37',
            'modified' => '2015-01-24 03:55:37'
=======
            'created' => '2015-01-26 17:29:09',
            'modified' => '2015-01-26 17:29:09'
>>>>>>> db391e975ea2e6de5e5488bb493dc5474a6ca65a
        ],
    ];
}
