<?php
namespace App\Model\Table;

use App\Model\Entity\Service;
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
        $this->hasMany('Times', [
            'foreignKey' => 'service_id'
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
            ->add('gym_id', 'valid', ['rule' => 'numeric',])
            ->requirePresence('gym_id', 'create')
            ->notEmpty('gym_id')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->add('stats', 'valid', ['rule' => 'boolean'])
            ->requirePresence('stats', 'create')
            ->notEmpty('stats');

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
        $rules->add($rules->isUnique(['name']));
        $rules->add($rules->existsIn(['gym_id'], 'Gyms'));
        return $rules;
    }
}
