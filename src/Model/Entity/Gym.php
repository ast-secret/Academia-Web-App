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
        '*' => true,
        'id' => false
    ];
    protected function _getLogoPath(){
        return '../files/gyms/' . $this->_properties['folder_name'] . '/logo_login.png';
    }
}
