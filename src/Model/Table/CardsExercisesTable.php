<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CardsExercises Model
 */
class CardsExercisesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('cards_exercises');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Exercises', [
            'foreignKey' => 'exercise_id'
        ]);
        $this->belongsTo('Cards', [
            'foreignKey' => 'card_id'
        ]);
        $this->belongsTo('Machines', [
            'foreignKey' => 'machine_id'
        ]);
        $this->belongsTo('ExercisesGroups', [
            'foreignKey' => 'exercises_group_id'
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
            ->add('exercise_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('exercise_id', 'create')
            ->notEmpty('exercise_id')
            ->add('card_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('card_id', 'create')
            ->notEmpty('card_id')
            ->requirePresence('repetition', 'create')
            ->notEmpty('repetition')
            ->add('machine_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('machine_id', 'create')
            ->notEmpty('machine_id')
            ->add('exercises_group_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('exercises_group_id', 'create')
            ->notEmpty('exercises_group_id');

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
        $rules->add($rules->existsIn(['exercise_id'], 'Exercises'));
        $rules->add($rules->existsIn(['card_id'], 'Cards'));
        $rules->add($rules->existsIn(['machine_id'], 'Machines'));
        $rules->add($rules->existsIn(['exercises_group_id'], 'ExercisesGroups'));
        return $rules;
    }
}
