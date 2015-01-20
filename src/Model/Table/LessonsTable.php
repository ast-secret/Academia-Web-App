<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lessons Model
 */
class LessonsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('lessons');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Services', [
            'foreignKey' => 'service_id'
        ]);
        $this->belongsTo('Rooms', [
            'foreignKey' => 'room_id'
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
            ->add('start_time', 'valid', ['rule' => 'time'])
            ->requirePresence('start_time', 'create')
            ->notEmpty('start_time')
            ->add('end_time', 'valid', ['rule' => 'time'])
            ->requirePresence('end_time', 'create')
            ->notEmpty('end_time')
            ->add('date', 'valid', ['rule' => 'date'])
            ->requirePresence('date', 'create')
            ->notEmpty('date')
            ->add('service_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('service_id', 'create')
            ->notEmpty('service_id')
            ->add('room_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('room_id', 'create')
            ->notEmpty('room_id')
            ->add('availables', 'valid', ['rule' => 'numeric'])
            ->requirePresence('availables', 'create')
            ->notEmpty('availables');

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
        $rules->add($rules->existsIn(['service_id'], 'Services'));
        $rules->add($rules->existsIn(['room_id'], 'Rooms'));
        return $rules;
    }
}
