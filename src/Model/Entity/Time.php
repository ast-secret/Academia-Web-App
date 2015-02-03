<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Time Entity.
 */
class Time extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'service_id' => true,
        'weekday_id' => true,
        'start_hour' => true,
        'duration' => true,
        'service' => true,
        'weekday' => true,
    ];
}
