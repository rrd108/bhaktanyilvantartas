<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Asrams Model
 *
 * @property \Cake\ORM\Association\HasMany $Bhaktas
 *
 * @method \App\Model\Entity\Asram get($primaryKey, $options = [])
 * @method \App\Model\Entity\Asram newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Asram[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Asram|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asram patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Asram[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Asram findOrCreate($search, callable $callback = null, $options = [])
 */
class AsramsTable extends Table
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

        $this->setTable('asrams');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Bhaktas', [
            'foreignKey' => 'asram_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
