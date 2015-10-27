<?php
namespace App\Model\Table;

use App\Model\Entity\Exercise;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exercises Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cards
 */
class ExercisesTable extends Table
{


    public $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('exercises');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Cards', [
            'foreignKey' => 'card_id',
            'joinType' => 'INNER'
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
            ->allowEmpty('id', 'create');
            
        // $validator
        //     ->allowEmpty('repetition');
            
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            
        $validator
            ->add('exercise_column', 'valid', ['rule' => 'numeric'])
            ->requirePresence('exercise_column', 'create')
            ->notEmpty('exercise_column');

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
        $rules->add($rules->existsIn(['card_id'], 'Cards'));
        return $rules;
    }
}
