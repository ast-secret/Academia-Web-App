<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lesson Entity.
 */
class Lesson extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'start_time' => true,
        'end_time' => true,
        'date' => true,
        'service_id' => true,
        'room_id' => true,
        'availables' => true,
        'service' => true,
        'room' => true,
    ];
}
