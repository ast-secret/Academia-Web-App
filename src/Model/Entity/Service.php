<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\Collection\Collection;

/**
 * Service Entity.
 */
class Service extends Entity
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

    protected function _getTimesString()
    {
        $timesCollection = new Collection($this->_properties['times']);
        $timesCollection = $timesCollection->groupBy('weekday')->toArray();

        $timesString = [];
        foreach ($timesCollection as $weekday => $times) {
            $string = '';
            foreach ($times as $time) {
                $string .= $time->start_hour->format('H:i') . ';';
            }
            $timesString[$weekday] = $string;
        }
        return $timesString;
    }
}
