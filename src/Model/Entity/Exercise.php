<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exercise Entity.
 */
class Exercise extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'cards' => true,
    ];
}
