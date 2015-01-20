<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Services Model
 */
class ServicesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('services');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Gyms', [
            'foreignKey' => 'gym_id'
        ]);
        $this->hasMany('Lessons', [
            'foreignKey' => 'service_id'
        ]);
        $this->belongsToMany('Weekdays', [
            'foreignKey' => 'service_id',
            'targetForeignKey' => 'weekday_id',
            'joinTable' => 'services_weekdays'
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
            ->add('gym_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('gym_id', 'create')
            ->notEmpty('gym_id')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->add('begin_service', 'valid', ['rule' => 'time'])
            ->requirePresence('begin_service', 'create')
            ->notEmpty('begin_service')
            ->add('end_service', 'valid', ['rule' => 'time'])
            ->requirePresence('end_service', 'create')
            ->notEmpty('end_service');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['gym_id'], 'Gyms'));
        return $rules;
    }
}
