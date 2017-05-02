<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Communityroles Model
 *
 * @property \Cake\ORM\Association\HasMany $Bhaktas
 *
 * @method \App\Model\Entity\Communityrole get($primaryKey, $options = [])
 * @method \App\Model\Entity\Communityrole newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Communityrole[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Communityrole|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Communityrole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Communityrole[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Communityrole findOrCreate($search, callable $callback = null, $options = [])
 */
class CommunityrolesTable extends Table
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

        $this->setTable('communityroles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Bhaktas', [
            'foreignKey' => 'communityrole_id'
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
