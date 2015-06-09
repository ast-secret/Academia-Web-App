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
        'weekday' => true,
        'service_id' => true,
        'start_hour' => true,
        'service' => true,
        'weekday' => true,
    ];
}
