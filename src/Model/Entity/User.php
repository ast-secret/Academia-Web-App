<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

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
        'name' => true,
        'gym_id' => true,
        'role_id' => true,
        'username' => true,
        'password' => true,
        'is_active' => true,
        'deleted' => false,
        'gym' => true,
        'role' => true,
        'cards' => true,
        'releases' => true,
        'confirm_password_add' => true,
        'current_password' => true,
        'new_password' => true,
        'confirm_new_password' => true
    ];

    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
}
