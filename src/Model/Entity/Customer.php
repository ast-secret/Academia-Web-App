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
        'password' => false,
        'is_active' => true,
        'app_access_token' => false,
        'gym_id' => true,
        'email' => true,
        'cards' => true,
        'suggestions' => true,
    ];
}
