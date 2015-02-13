<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */

    public function validationEditUsers(Validator $validator){
       
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')

            ->add('gym_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('gym_id', 'create')
            ->notEmpty('gym_id')

            ->add('role_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('role_id', 'create')

            ->requirePresence('name', 'create')
            ->notEmpty('name','Este campo não pode ser deixado em branco')           

            ->requirePresence('username', 'create')
            ->notEmpty('username','Este campo não pode ser deixado em branco')            


            ->requirePresence('password', 'create')
            ->notEmpty('password','Este campo não pode ser deixado em branco')
            

            ->allowEmpty('mail_temp')
            ->allowEmpty('token_mail')

            ->add('token_time_exp', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('token_time_exp');

             $validator->add('username', [
                'unique' => ['rule' => 'validateUnique', 'provider' => 'table','message'=>'Login já existe, tente novamente com outro email']
            ]);


            return $validator;
    }
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

            ->requirePresence('name', 'create')
            ->notEmpty('name','Este campo não pode ser deixado em branco')
            ->add('name',[
                'minLength' => [
                'rule' => ['minLength', 5],
                'last' => true,
                'message' => 'Tamanho mínimo permitido são de 5 caracteres.'
                ]
            ])

            ->requirePresence('username', 'create')
            ->notEmpty('username','Este campo não pode ser deixado em branco')
            ->add('username',[
                'minLength' => [
                'rule' => ['minLength', 5],
                'last' => true,
                'message' => 'Tamanho mínimo permitido são de 5 caracteres.'
                ]
            ])


            ->requirePresence('password', 'create')
            ->notEmpty('password','Este campo não pode ser deixado em branco')
            ->add('password',[
                'minLength' => [
                'rule' => ['minLength', 5],
                'last' => true,
                'message' => 'Adicione mais caracteres para uma senha mais segura, no mínimo 5'
                ]
            ])

            //->add('stats', 'valid', ['rule' => 'numeric'])            
            ->requirePresence('stats', 'create')
            ->notEmpty('stats')

            ->allowEmpty('mail_temp')
            ->allowEmpty('token_mail')

            ->add('token_time_exp', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('token_time_exp');

            $validator->add('password', [
                'compare' => [
                    'rule' => ['compareWith', 'confirm_password'],
                    'message' => 'As senhas não são iguais'
                ]
            ]);

             $validator->add('confirm_password', [
                'compare' => [
                    'rule' => ['compareWith', 'password'],
                    'message' => 'As senhas não são iguais'
                ]
            ]);
           
            $validator->notEmpty('confirm_password','Este campo não pode ficar vazio, confirme sua senha');

            
            $validator->add('username', [
                'unique' => ['rule' => 'validateUnique', 'provider' => 'table','message'=>'Login já existe, tente novamente com outro email']
            ]);

             
            
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
