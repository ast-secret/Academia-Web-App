<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Phone Entity.
 */
class Phone extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'gym_id' => true,
        'name' => true,
        'phone' => true,
        'gym' => true,
    ];
}
