<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ServicesTime Entity.
 */
class ServicesTime extends Entity
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
