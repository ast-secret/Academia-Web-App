<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * Users Model
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Gyms', [
            'foreignKey' => 'gym_id'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id'
        ]);
        $this->hasMany('Cards', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Releases', [
            'foreignKey' => 'user_id'
        ]);
    }

    // public function beforeMarshal(Event $event, ArrayObject $data)
    // {
    //     $data['name'] = trim($data['name']);
    //     $data['username'] = trim($data['username']);
    //     $data['password'] = trim($data['password']);
    //     $data['confirm_password'] = trim($data['confirm_password']);
    // }

    // public function validationEditUser(Validator $validator){
    //     $validator
    //         ->add('id', 'valid', ['rule' => 'numeric'])
    //         ->allowEmpty('id', 'create')

    //         ->add('gym_id', 'valid', ['rule' => 'numeric'])
    //         ->requirePresence('gym_id', 'create')
    //         ->notEmpty('gym_id')

    //         ->add('role_id', 'valid', ['rule' => 'numeric'])
    //         ->requirePresence('role_id', 'create')
    //         ->notEmpty('role_id')

    //         ->requirePresence('name', 'create')
    //         ->notEmpty('name',"Por Favor, Preecha o campo vazio!")

    //         ->requirePresence('confirm_password', 'create')
    //         ->notEmpty('name',"Por Favor, Preecha o campo vazio!")

    //         ->requirePresence('username', 'create')
    //         ->notEmpty('username',"Por Favor, Preecha o campo vazio!")

    //         ->requirePresence('password', 'create')
    //         ->notEmpty('password',"Por Favor, Preecha o campo vazio!")

    //         ->add('username', [
    //             'unique' => ['rule' => 'validateUnique', 'provider' => 'table','message'=>'Login já está sendo usado.']
    //         ])     

    //         ->add('stats', 'valid', ['rule' => 'boolean'])
    //         ->requirePresence('stats', 'create')
    //         ->notEmpty('stats')

    //         ->allowEmpty('mail_temp')
    //         ->allowEmpty('token_mail')

    //       /*  ->add('password', [
    //                 'compare' => [
    //                 'rule' => ['compareWith', 'confirm_password'],
    //                 'message' => 'As Senhas não conferem.'
    //             ]
    //         ])

    //         ->add('confirm_password', [
    //                 'compare' => [
    //                 'rule' => ['compareWith', 'password'],
    //                 'message' => 'As Senhas não conferem.'
    //             ]
    //         ])*/

    //         ->add('token_time_exp', 'valid', ['rule' => 'datetime'])
    //         ->allowEmpty('token_time_exp');

    //     return $validator;
    // }


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

            ->add('role_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('role_id', 'create')
            ->notEmpty('role_id')

            ->requirePresence('name', 'create')
            ->notEmpty('name',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('username', 'create')
            ->notEmpty('username',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('password', 'create')
            ->notEmpty('password',"Por Favor, Preecha o campo vazio!")    

            ->add('password', [
                'equalsTo' => [
                    'rule' => function($value, $context) {
                        return $value === $context['data']['confirm_password'];
                    },
                    'message' => 'Você não confirmou a sua senha corretamente!'
                ]
            ])

            ->add('stats', 'valid', ['rule' => 'boolean'])
            ->requirePresence('stats', 'create')
            ->notEmpty('stats')

            ->allowEmpty('mail_temp')
            ->allowEmpty('token_mail')

            ->add('token_time_exp', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('token_time_exp');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['gym_id'], 'Gyms'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        return $rules;
    }
}
