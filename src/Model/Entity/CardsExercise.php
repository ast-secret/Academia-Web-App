<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CardsExercise Entity.
 */
class CardsExercise extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'repetition' => true,
        'name' => true,
        'exercises_group_id' => true,
        'card' => true,
        'exercises'
    ];
}
