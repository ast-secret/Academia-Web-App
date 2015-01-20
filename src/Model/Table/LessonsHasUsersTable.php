<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LessonsHasUsers Model
 */
class LessonsHasUsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('lessons_has_users');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Lessons', [
            'foreignKey' => 'lessons_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id'
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
            ->add('lessons_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('lessons_id', 'create')
            ->notEmpty('lessons_id')
            ->add('users_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('users_id', 'create')
            ->notEmpty('users_id')
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

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
        $rules->add($rules->existsIn(['lessons_id'], 'Lessons'));
        $rules->add($rules->existsIn(['users_id'], 'Users'));
        return $rules;
    }
}
