<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'gym_id' => true,
        'role_id' => true,
        'name' => true,
        'username' => true,
        'password' => true,
        'gym' => true,
        'role' => true,
        'cards' => true,
        'releases' => true,
    ];
}
