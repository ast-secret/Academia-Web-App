<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ServicesWeekday Entity.
 */
class ServicesWeekday extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'service_id' => true,
        'weekday_id' => true,
        'service' => true,
        'weekday' => true,
    ];
}
