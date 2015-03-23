<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Suggestion Entity.
 */
class Suggestion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'text' => true,
        'customer_id' => true,
        'customer' => true,
        'is_star' => true,
        'is_read' => true
    ];
}
