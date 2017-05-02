<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tbs Model
 *
 * @property \Cake\ORM\Association\HasMany $Bhaktas
 *
 * @method \App\Model\Entity\Tb get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tb newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tb[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tb|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tb patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tb[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tb findOrCreate($search, callable $callback = null, $options = [])
 */
class TbsTable extends Table
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

        $this->setTable('tbs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Bhaktas', [
            'foreignKey' => 'tb_id'
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
