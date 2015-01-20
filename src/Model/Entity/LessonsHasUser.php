<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LessonsHasUser Entity.
 */
class LessonsHasUser extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'lessons_id' => true,
        'users_id' => true,
        'lesson' => true,
        'user' => true,
    ];
}
