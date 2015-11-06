<?php
namespace App\Model\Table;

use App\Model\Entity\Service;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Event\Event;
use App\Model\Table\ArrayObject;

/**
 * Services Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Gyms
 * @property \Cake\ORM\Association\HasMany $Times
 */
class ServicesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('services');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('NormalizeFullName', ['fields' => ['name']]);

        $this->belongsTo('Gyms', [
            'foreignKey' => 'gym_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Times', [
            'foreignKey' => 'service_id',
            'dependent' => true //Deleta os horários quando deleta a aula
        ]);
    }

    public function beforeMarshal(Event $event, $data)
    {
        if (isset($data['times_string'])) {
            $timesArray = explode(';', $data['times_string']);
            foreach ($timesArray as $time) {
                if ($time) {
                    $data['times'][] = [
                        'weekday' => $data['weekday'],
                        'start_hour' => $time
                    ];
                }
            }
        }
    }

    public function beforeSave(Event $event, $entity)
    {
        $this->Times->deleteAll(['service_id' => $entity->id, 'weekday' => $entity->weekday]);
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
            ->notEmpty('name')
            ->add('name', [
                'unique' => [
                    'rule' => ['validateUnique', ['scope' => 'gym_id']],
                    'provider' => 'table',
                    'message' => 'Já existe uma aula com este nome'
                ]
            ]);

        $minLength = 5;
        $maxLength = 800;            
        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->add('description', 'maxLength', [
                'rule' => ['maxLength', $maxLength],
                'message' => 'A descrição deve conter no máximo '.$maxLength.' caracteres.'
            ])
            ->add('description', 'minLength', [
                'rule' => ['minLength', $minLength],
                'message' => 'A descrição deve conter no mínimo '.$minLength.' caracteres.'
            ]);
            
        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');
            
        $validator
            ->add('duration', 'valid', ['rule' => 'numeric'])
            ->requirePresence('duration', 'create')
            ->notEmpty('duration');

        $validator
            ->add('gasto_calorico', 'valid', ['rule' => 'numeric'])
            ->requirePresence('gasto_calorico', 'create')
            ->notEmpty('gasto_calorico');

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
