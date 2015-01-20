<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Machine Entity.
 */
class Machine extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'gym_id' => true,
        'name' => true,
        'gym' => true,
        'cards_exercises' => true,
    ];
}
