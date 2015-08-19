<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExercisesSuggestion Entity.
 */
class ExercisesSuggestion extends Entity
{

    protected $_virtual = ['label', 'value'];

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     * Note that '*' is set to true, which allows all unspecified fields to be
     * mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _getValue()
    {
        return $this->_properties['name'];
    }
    protected function _getLabel()
    {
        return $this->_properties['name'];
    }
}
