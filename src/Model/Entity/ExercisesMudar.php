<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExercisesMudar Entity.
 */
class ExercisesMudar extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
    ];
}
