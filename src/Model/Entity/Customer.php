<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity.
 */
class Customer extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'registration' => true,
        'password' => true,
        'access_key' => true,
        'status' => true,
        'cards' => true,
        'suggestions' => true,
    ];
}
