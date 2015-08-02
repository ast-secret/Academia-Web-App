<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;
use Datetime;

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
        'exercises' => true,
        'overdue' => true,
        'end_date_in_words'
    ];

    protected function _getOverdue()
    {
        return ((new Datetime) > $this->_properties['end_date']);
    }
    protected function _getEndDateInWords()
    {
        $date = new Time($this->_properties['end_date']);
        return $date->timeAgoInWords([
            'accuracy' => 'month',
            'end' => '+1 year'
        ]);
    }
}

