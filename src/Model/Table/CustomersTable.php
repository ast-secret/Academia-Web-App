<?php
namespace App\Model\Table;

use App\Model\Entity\Customer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Gyms
 * @property \Cake\ORM\Association\BelongsTo $PushRegs
 * @property \Cake\ORM\Association\HasMany $Cards
 * @property \Cake\ORM\Association\HasMany $Suggestions
 */
class CustomersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('customers');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Gyms', [
            'foreignKey' => 'gym_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Cards', [
            'foreignKey' => 'customer_id'
        ]);
        $this->hasMany('Suggestions', [
            'foreignKey' => 'customer_id'
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

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('registration', 'create')
            ->notEmpty('registration')
            ->add('registration', [
                'unique' => [
                    'rule' => ['validateUnique', ['scope' => 'gym_id']],
                    'message' => 'Já existe um usuário com esta matrícula cadastrado no sistema.',
                    'provider' => 'table'
                ]
            ]);            

        $minLength = 6;
        $maxLength = 24;
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password')
            ->add('password', 'maxLength', [
                'rule' => ['maxLength', $maxLength],
                'message' => 'A senha deve conter no máximo '.$maxLength.' caracteres'
            ])
            ->add('password', 'minLength', [
                'rule' => ['minLength', $minLength],
                'message' => 'A senha deve conter no mínimo '.$minLength.' caracteres'
            ])
            ->add('password', 'custom', [
                'rule' => function($value, $context) {
                    return $value == $context['data']['confirm_password'];
                },
                'message' => 'Você não confirmou a sua senha corretamente'
            ]);

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', [
                'unique' => [
                    'rule' => ['validateUnique', ['scope' => 'gym_id']],
                    'message' => 'O email informado já está sendo usado por outro usuário',
                    'provider' => 'table'
                ]
            ]);

        $validator
            ->add('birthdate', 'valid', ['rule' => 'date'])
            ->allowEmpty('end_date');
        
        $validator
            ->add('gender', 'valid', [
                'rule' => function($value, $context){
                    return (in_array($value, [1, 2]));
                },
                'message' => 'Sexo inválido.'
            ])
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

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
