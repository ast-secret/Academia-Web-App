<?php
namespace App\Model\Table;

use App\Model\Entity\Customer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * Customers Model
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
        $this->hasMany('Cards', [
            'foreignKey' => 'customer_id'
        ]);
        $this->hasMany('Suggestions', [
            'foreignKey' => 'customer_id'
        ]);
    }

     public function beforeMarshal(Event $event, ArrayObject $data)
    {
        $data['name'] = trim($data['name']);
        $data['registration'] = trim($data['registration']);
        $data['password'] = trim($data['password']);
        $data['access_key'] = trim($data['access_key']);
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

            ->requirePresence('name', 'create')
            ->notEmpty('name',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('registration', 'create')
            ->notEmpty('registration',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('password', 'create')
            ->notEmpty('password',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('access_key', 'create')
            ->notEmpty('access_key',"Por Favor, Preecha o campo vazio!")

            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->allowEmpty('status')
             
            ->add('access_key', [
                'unique' => ['rule' => 'validateUnique', 'provider' => 'table','message'=>'Chave de Acesso já está sendo usada.']
            ])

            ->add('registration', [
                'unique' => ['rule' => 'validateUnique', 'provider' => 'table','message'=>'O Número de Registro já está sendo usado.']
            ]);             

        return $validator;
    }

      public function validationEditCustomer(Validator $validator)
    {
        $validator 
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')

            ->requirePresence('name', 'create')
            ->notEmpty('name',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('registration', 'create')
            ->notEmpty('registration',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('password', 'create')
            ->notEmpty('password',"Por Favor, Preecha o campo vazio!")

            ->requirePresence('access_key', 'create')
            ->notEmpty('access_key',"Por Favor, Preecha o campo vazio!")

            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->allowEmpty('status');

        return $validator;      
    }   
}
