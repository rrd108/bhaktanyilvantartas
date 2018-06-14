<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Services Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Bhaktas
 * @property \Cake\ORM\Association\BelongsTo $Osztalies
 *
 * @method \App\Model\Entity\Service get($primaryKey, $options = [])
 * @method \App\Model\Entity\Service newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Service[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Service|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Service patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Service[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Service findOrCreate($search, callable $callback = null, $options = [])
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
        parent::initialize($config);

        $this->setTable('services');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bhaktas', [
            'foreignKey' => 'bhakta_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('bhakta_id', 'create');

        $validator
            ->requirePresence('department_id', 'create');

        $validator
            ->requirePresence('szolgalat_kezdete', 'create')
            ->date('szolgalat_kezdete')
            ->notEmpty('szolgalat_kezdete');

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
        $rules->add($rules->existsIn(['bhakta_id'], 'Bhaktas'));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }

    public function findCurrent(Query $query, array $options)
    {
        $date = $options['date'] ?: date('Y-m-d');
        $bhaktasLastServiceStarts = $this->find()
            ->select(
                [
                    'bhid' => 'Services.bhakta_id',
                    'last_service_start' => $query->func()->max('Services.szolgalat_kezdete')
                ]
            )->where(['Services.szolgalat_kezdete <= ' => $date])
            ->group(['Services.bhakta_id']);

        $bhaktasServiceIdsForLastServiceStarts = $this->find()
            ->select(
                [
                    'Services.bhakta_id',
                    'min_service_id' => $query->func()->min('Services.id')
                ]
            )
            ->innerJoin(
                ['t2' => $bhaktasLastServiceStarts],
                [
                    'Services.bhakta_id = t2.bhid', //can not use array format because of the alias "t2"
                    'Services.szolgalat_kezdete = t2.last_service_start'
                ]
            )
            ->group('Services.bhakta_id');

        $currentServices = $query
            ->innerJoin(
                ['t3' => $bhaktasServiceIdsForLastServiceStarts],
                ['Services.id = t3.min_service_id']
            );

        return $currentServices;
    }

    public function findLastBeginedServiceByBhakta(Query $query, array $options)
    {
        $bhakta_id = $options['bhakta_id'];
        $bhaktasLastServiceStarts = $this->find()
            ->select(
                [
                    'service_id' => $query->func()->max('Services.id'),
                    'last_service_start' => $query->func()->max('Services.szolgalat_kezdete')
                ]
            )->group(['Services.bhakta_id']);
        return $bhaktasLastServiceStarts;
    }
}
