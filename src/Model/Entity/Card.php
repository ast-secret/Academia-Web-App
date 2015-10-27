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
        '*' => true,
        'id' => false
    ];

    protected function _getOverdue()
    {
        $format = 'Y-m-d H:i:s';
        return ((new Datetime)->format($format) > $this->_properties['end_date']->format($format));
    }
    protected function _getEndDateInWords()
    {
        $date = new Time($this->_properties['end_date']);
        // debug($date);
        return $date->timeAgoInWords([
            'accuracy' => ['day' => 'day'],
            'end' => '+1 year'
        ]);
    }
}

