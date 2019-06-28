<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PickUp Model
 *
 * @method \App\Model\Entity\PickUp get($primaryKey, $options = [])
 * @method \App\Model\Entity\PickUp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PickUp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PickUp|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PickUp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PickUp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PickUp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PickUp findOrCreate($search, callable $callback = null, $options = [])
 */
class PickUpTable extends Table
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

        $this->setTable('pick_up');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 25)
            ->requirePresence('type', 'create')
            ->allowEmptyString('type', false);

        $validator
            ->scalar('id_pickup')
            ->maxLength('id_pickup', 25)
            ->requirePresence('id_pickup', 'create')
            ->allowEmptyString('id_pickup', false);

        return $validator;
    }
}
