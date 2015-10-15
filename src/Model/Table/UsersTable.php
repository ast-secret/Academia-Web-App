<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Gyms
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\HasMany $Cards
 * @property \Cake\ORM\Association\HasMany $Releases
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
            'foreignKey' => 'gym_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Cards', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Releases', [
            'foreignKey' => 'user_id'
        ]);
    }

    public function afterRules($event, $entity)
    {
        /*
         * Só faz isso na tela que atualiza a senha
         */
        if (isset($entity->new_password)) {
            $entity->password = $entity->new_password;
            $entity->accessible('password', true);
        }
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
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'custom', [
                'rule' => function($value, $context) {
                    $user = $this->find('all', [
                        'conditions' => [
                            'Users.username' => $context['data']['username'],
                            'Users.deleted' => 0,
                        ]
                    ]);

                    return $user->isEmpty();
                },
                'message' => 'O email informado já está sendo usado por outro usuário',
            ])
            ->add('username', 'email', ['rule' => 'email']);
            
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
                    return $value == $context['data']['confirm_password_add'];
                },
                'message' => 'Você não confirmou a sua senha corretamente'
            ]);

        $validator
            ->add('current_password', 'custom', [
                'rule' => function($value, $context) {
                    $user = $this->get($context['data']['id']);
                    return (new DefaultPasswordHasher)->check($value, $user->password);
                },
                'message' => 'Você não informou a sua senha atual corretamente',
            ]);
        
        $validator
            ->notEmpty('new_password')
            ->add('new_password', 'custom', [
                'rule' => function($value, $context) {
                    return $value == $context['data']['confirm_new_password'];
                },
                'message' => 'Você não confirmou a sua nova senha corretamente',
            ])
            ->add('new_password', 'maxLength', [
                'rule' => ['maxLength', $maxLength],
                'message' => 'A senha deve conter no máximo '.$maxLength.' caracteres'
            ])
            ->add('new_password', 'minLength', [
                'rule' => ['minLength', $minLength],
                'message' => 'A senha deve conter no mínimo '.$minLength.' caracteres'
            ]);

        $validator
            ->requirePresence('role_id', 'create')
            ->notEmpty('role_id');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->add('deleted', 'valid', ['rule' => 'boolean'])
            ->notEmpty('deleted');
            
        $validator
            ->allowEmpty('mail_temp');
            
        $validator
            ->allowEmpty('token_mail');
            
        $validator
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
}
