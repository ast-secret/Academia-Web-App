<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Room Entity.
 */
class Room extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'gym_id' => true,
        'description' => true,
        'gym' => true,
        'lessons' => true,
    ];
}
