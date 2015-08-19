<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Gyms Model
 */
class GymsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('gyms');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Machines', [
            'foreignKey' => 'gym_id'
        ]);
        $this->hasMany('Phones', [
            'foreignKey' => 'gym_id'
        ]);
        $this->hasMany('Rooms', [
            'foreignKey' => 'gym_id'
        ]);
        $this->hasMany('Services', [
            'foreignKey' => 'gym_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'gym_id'
        ]);
        $this->hasMany('Customers', [
            'foreignKey' => 'gym_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->requirePresence('address', 'create')
            ->notEmpty('address')
            ->allowEmpty('cover_img')
            ->requirePresence('logo_img', 'create')
            ->notEmpty('logo_img');

        return $validator;
    }
}
