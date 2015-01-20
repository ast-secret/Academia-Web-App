<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Release Entity.
 */
class Release extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'title' => true,
        'text' => true,
        'user' => true,
    ];
}
