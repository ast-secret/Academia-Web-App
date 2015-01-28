<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cards Model
 */
class CardsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('cards');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always'
                ]
            ]
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id'
        ]);
        $this->hasMany('ExercisesGroups', [
            'foreignKey' => 'card_id'
        ]);
    }

    /**
     * Garante que o card tenha ao menos um exercício adicionado
     * Como o exercício necessariamente deve estar dentro de um grupo,
     * Então ele deve garantir também que ao menos tenha um grupo adicionado
     * @return [type] [description]
     */
    public function validateExercise($data)
    {
        if (isset($data['exercises_groups'])) {
            $groups = $data['exercises_groups'];
            foreach ($groups as $group) {
                if (empty($group['exercises'])){
                    return false;
                }
            }
        } else {
            return false;
        }
        return true;
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
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id')
            ->add('start_date', 'valid', ['rule' => 'date'])
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date')
            ->add('end_date', 'valid', ['rule' => 'date'])
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date')
            ->requirePresence('goal', 'create')
            ->notEmpty('goal')
            ->add('customer_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('customer_id', 'create')
            ->notEmpty('customer_id')
            ->allowEmpty('obs')
            ->add('current', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('current');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        return $rules;
    }
}
