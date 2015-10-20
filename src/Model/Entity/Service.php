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
        $timesString = [];
        if (isset($this->_properties['times'])) {
            foreach ($this->_properties['times'] as $value) {
                if (is_object($value['start_hour'])) {
                    $timesString[] = $value['start_hour']->format('H:i');
                }
            }
        }
        $timesString = join($timesString, ';');
        return $timesString;
    }
}
