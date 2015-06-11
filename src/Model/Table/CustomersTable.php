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
            ->notEmpty('registration');
            
        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');
            
        $validator
            ->allowEmpty('app_access_token');
            
        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->allowEmpty('email')
            ->add('email', [
                'unique' => [
                    'rule' => ['validateUnique', ['scope' => 'gym_id']],
                    'message' => 'O email informado já está sendo usado por outro usuário',
                    'provider' => 'table'
                ]
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
        $rules->add($rules->existsIn(['gym_id'], 'Gyms'));
        return $rules;
    }
}
