<?php
namespace App\Model\Table;

use App\Model\Entity\Release;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Releases Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ReleasesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('releases');
        $this->displayField('text');
        $this->primaryKey('id');
        
        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
        $maxLength = 120;
        $validator
            ->requirepresence('title', 'create')
            ->notEmpty('title')
            ->add('text', 'maxLength', [
                'rule' => ['maxLength', $maxLength],
                'message' => 'O título deve conter no máximo '.$maxLength.' caracteres.'
            ]);
        $minLength = 10;
        $maxLength = 800;
        $validator
            ->requirePresence('text', 'create')
            ->notEmpty('text')
            ->add('text', 'maxLength', [
                'rule' => ['maxLength', $maxLength],
                'message' => 'O texto deve conter no máximo '.$maxLength.' caracteres.'
            ])
            ->add('text', 'minLength', [
                'rule' => ['minLength', $minLength],
                'message' => 'O texto deve conter no mínimo '.$minLength.' caracteres.'
            ]);
            
        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->add('destaque', 'valid', ['rule' => 'boolean'])
            ->requirePresence('destaque', 'create')
            ->notEmpty('destaque');

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
        return $rules;
    }
}
