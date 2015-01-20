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
        'exercise_id' => true,
        'card_id' => true,
        'repetition' => true,
        'machine_id' => true,
        'exercises_group_id' => true,
        'exercise' => true,
        'card' => true,
        'machine' => true,
        'exercises_group' => true,
    ];
}
