<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CardsExercisesFixture
 *
 */
class CardsExercisesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'exercise_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'card_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'repetition' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'machine_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'exercises_group_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_exercise_has_card_card1_idx' => ['type' => 'index', 'columns' => ['card_id'], 'length' => []],
            'fk_exercise_has_card_exercise1_idx' => ['type' => 'index', 'columns' => ['exercise_id'], 'length' => []],
            'fk_cards_exercises_machines1_idx' => ['type' => 'index', 'columns' => ['machine_id'], 'length' => []],
            'fk_cards_exercises_exercises_groups1_idx' => ['type' => 'index', 'columns' => ['exercises_group_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_cards_exercises_exercises_groups1' => ['type' => 'foreign', 'columns' => ['exercises_group_id'], 'references' => ['exercises_groups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_cards_exercises_machines1' => ['type' => 'foreign', 'columns' => ['machine_id'], 'references' => ['machines', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_exercise_has_card_card1' => ['type' => 'foreign', 'columns' => ['card_id'], 'references' => ['cards', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_exercise_has_card_exercise1' => ['type' => 'foreign', 'columns' => ['exercise_id'], 'references' => ['exercises', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'exercise_id' => 1,
            'card_id' => 1,
            'repetition' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-01-26 17:28:43',
            'modified' => '2015-01-26 17:28:43',
            'machine_id' => 1,
            'exercises_group_id' => 1
        ],
    ];
}
