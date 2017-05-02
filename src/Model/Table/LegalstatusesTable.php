<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Legalstatuses Model
 *
 * @property \Cake\ORM\Association\HasMany $Bhaktas
 *
 * @method \App\Model\Entity\Legalstatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Legalstatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Legalstatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Legalstatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Legalstatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Legalstatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Legalstatus findOrCreate($search, callable $callback = null, $options = [])
 */
class LegalstatusesTable extends Table
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

        $this->setTable('legalstatuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Bhaktas', [
            'foreignKey' => 'legalstatus_id'
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
