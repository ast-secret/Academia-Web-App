<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

use Cake\Auth\DefaultPasswordHasher;
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

    public function beforeSave($event, $entity, $options)
    {
        // unset($entity->user_password_confirm);
        // return $entity;
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

            ->add('gym_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('gym_id', 'create')
            ->notEmpty('gym_id')

            ->add('role_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('role_id', 'create')
            ->notEmpty('role_id', 'Por favor, selecione uma opção!')

            ->requirePresence('name', 'create')
            ->notEmpty('name',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('username', 'create')
            ->add('username', 'valid', ['rule' => 'email', 'message' => 'Por Favor, Insira um email válido!'])
            ->notEmpty('username',"Por Favor, Preecha o campo vazio!")
            ->add('username', [
                // Esta regra serve para validarmos que um username não pode ser repetir na mesma academia
                // mas pode repetir em academias diferentes.
                'isUniqueAboutThisGym' => [
                    'rule' => function($value, $context) {
                        $query = $this->find();
                        
                        $query
                            ->select(['total' => $query->func()->count('*')])
                            ->where(['Users.gym_id' => $context['data']['gym_id']])
                            ->where(['Users.username' => $value])
                            ->where(['Users.username' => $value]);

                        $result = $query->first();

                        if ($result->total > 0) {
                            return false;
                        }
                        return true;
                    },
                    'message' => 'Este email já está em uso por outro usuário!'
                ]
            ])

            ->requirePresence('password', 'create')
            ->notEmpty('password', "Por Favor, Preecha o campo vazio!", 'create')


            ->add('password', [
                'equalsTo' => [
                    'rule' => function($value, $context) {
                        return $value === $context['data']['confirm_password'];
                    },
                    'message' => 'Você não confirmou a sua senha corretamente!'
                ]
            ])

            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active')

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
        $rules->add($rules->existsIn(['gym_id'], 'Gyms'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        return $rules;
    }

    public function checkCurrentPassword($id, $password)
    {
        $user = $this->get($id, ['fields' => 'password']);
        $password = (new DefaultPasswordHasher)->hash($password);

        if ($password == $user->password) {
            return true;
        }
        return false;
    }
}
