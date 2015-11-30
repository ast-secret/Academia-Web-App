<?php
namespace App\Model\Table;

use App\Model\Entity\RegId;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegIds Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Gyms
 * @property \Cake\ORM\Association\BelongsTo $Customers
 */
class RegIdsTable extends Table
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

        $this->table('reg_ids');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Gyms', [
            'foreignKey' => 'gym_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id'
        ]);
    }

    public function getAllByGymId($gymId)
    {
        $regIds = $this->find('all', [
            'conditions' => [
                'RegIds.gym_id' => $gymId
            ]
        ]);
        return $regIds;
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
            ->requirePresence('device_uuid', 'create')
            ->notEmpty('device_uuid');

        $validator
            ->requirePresence('device_regid', 'create')
            ->notEmpty('device_regid');

        $validator
            ->requirePresence('platform', 'create')
            ->notEmpty('platform');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        return $rules;
    }
}
