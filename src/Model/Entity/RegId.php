<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegId Entity.
 *
 * @property int $id
 * @property string $device_uuid
 * @property string $device_regid
 * @property string $platform
 * @property \Cake\I18n\Time $created
 * @property int $gym_id
 * @property \App\Model\Entity\Gym $gym
 * @property int $customer_id
 * @property \App\Model\Entity\Customer $customer
 */
class RegId extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
