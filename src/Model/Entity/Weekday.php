<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Weekday Entity.
 */
class Weekday extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'weekday' => true,
        'services' => true,
    ];
}
