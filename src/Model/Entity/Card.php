<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Card Entity.
 */
class Card extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'start_date' => true,
        'end_date' => true,
        'goal' => true,
        'customer_id' => true,
        'obs' => true,
        'current' => true,
        'user' => true,
        'customer' => true,
        'exercises' => true,
    ];
}
