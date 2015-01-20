<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ServicesWeekdays Model
 */
class ServicesWeekdaysTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('services_weekdays');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Services', [
            'foreignKey' => 'service_id'
        ]);
        $this->belongsTo('Weekdays', [
            'foreignKey' => 'weekday_id'
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
            ->add('service_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('service_id', 'create')
            ->notEmpty('service_id')
            ->add('weekday_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('weekday_id', 'create')
            ->notEmpty('weekday_id');

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
        $rules->add($rules->existsIn(['weekday_id'], 'Weekdays'));
        return $rules;
    }
}
