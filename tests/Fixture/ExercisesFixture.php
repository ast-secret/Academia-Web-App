<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExercisesFixture
 *
 */
class ExercisesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'repetition' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'exercises_group_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_cards_exercises_exercises_groups1_idx' => ['type' => 'index', 'columns' => ['exercises_group_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_cards_exercises_exercises_groups1' => ['type' => 'foreign', 'columns' => ['exercises_group_id'], 'references' => ['exercises_groups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'repetition' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-01-24 03:55:35',
            'modified' => '2015-01-24 03:55:35',
            'name' => 'Lorem ipsum dolor sit amet',
<<<<<<< HEAD
            'exercises_group_id' => 1
=======
            'created' => '2015-01-26 17:28:49',
            'modified' => '2015-01-26 17:28:49'
>>>>>>> db391e975ea2e6de5e5488bb493dc5474a6ca65a
        ],
    ];
}
