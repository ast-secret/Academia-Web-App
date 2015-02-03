<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ServicesTimesFixture
 *
 */
class ServicesTimesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'service_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'weekday_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'start_hour' => ['type' => 'time', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'duration' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'em minutos', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_services_has_weekdays_weekdays1_idx' => ['type' => 'index', 'columns' => ['weekday_id'], 'length' => []],
            'fk_services_has_weekdays_services1_idx' => ['type' => 'index', 'columns' => ['service_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_services_has_weekdays_services1' => ['type' => 'foreign', 'columns' => ['service_id'], 'references' => ['services', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_services_has_weekdays_weekdays1' => ['type' => 'foreign', 'columns' => ['weekday_id'], 'references' => ['weekdays', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'service_id' => 1,
            'weekday_id' => 1,
            'created' => 'Lorem ipsum dolor sit amet',
            'start_hour' => '14:47:58',
            'duration' => 1
        ],
    ];
}
