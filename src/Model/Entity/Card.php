<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;

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
        'end_date' => true,
        'goal' => true,
        'customer_id' => true,
        'obs' => true,
        'current' => true,
        'user' => true,
        'customer' => true,
        'exercises_groups' => true,
        'overdue' => true
    ];

    public function _getOverdue()
    {
        return ($this->_properties['end_date'] < Time::now());
    }
}
