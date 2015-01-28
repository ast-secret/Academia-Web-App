<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExercisesGroup Entity.
 */
class ExercisesGroup extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'card_id' => true,
        'card' => true,
        'exercises' => true,
    ];
}
