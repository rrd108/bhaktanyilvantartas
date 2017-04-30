<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Gurus Model
 *
 * @method \App\Model\Entity\Gurus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gurus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Gurus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gurus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gurus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gurus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gurus findOrCreate($search, callable $callback = null, $options = [])
 */
class GurusTable extends Table
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

        $this->setTable('gurus');
        $this->setDisplayField('nev_full');
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('nev_rovid', 'create')
            ->notEmpty('nev_rovid');

        $validator
            ->requirePresence('nev_full', 'create')
            ->notEmpty('nev_full');

        return $validator;
    }
}
