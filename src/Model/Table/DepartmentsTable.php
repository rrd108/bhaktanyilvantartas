<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Departments Model
 *
 * @method \App\Model\Entity\Department get($primaryKey, $options = [])
 * @method \App\Model\Entity\Department newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Department[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Department|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Department patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Department[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Department findOrCreate($search, callable $callback = null, $options = [])
 */
class DepartmentsTable extends Table
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

        $this->setTable('departments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Centers', [
            'foreignKey' => 'center_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Services', [
            'foreignKey' => 'department_id',
            'strategy' => 'subquery'
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

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        return $validator;
    }

    public function findMembers(Query $query, array $options)
    {
        return $query
            ->select(['Departments.id', 'Departments.name',])
            ->contain([
                'Services' => function ($q) use ($options) {
                    return $q->find('current', $options)
                        ->contain(
                            [
                                'Bhaktas' => function ($q) {
                                    return $q->where([
                                        'Bhaktas.active' => 1,
                                        'Bhaktas.communityrole_id IN' => [1, 2]
                                    ]);
                                }
                            ]
                        )->order('Bhaktas.nev_avatott');
                }
            ]);
    }

    /**
     * Find all departments in a center
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     * @return \Cake\ORM\Query
     */
    public function findInCenter(Query $query, array $options)
    {
        return $query->where(['Departments.center_id IN' => $options['centerId']]);
    }
}
