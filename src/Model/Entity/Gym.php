<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gym Entity.
 */
class Gym extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'description' => true,
        'address' => true,
        'cover_img' => true,
        'logo_img' => true,
        'machines' => true,
        'phones' => true,
        'rooms' => true,
        'services' => true,
        'users' => true,
    ];
}
