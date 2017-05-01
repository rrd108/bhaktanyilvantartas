<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bhaktas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Gurus
 * @property \Cake\ORM\Association\BelongsTo $Hazastars
 * @property \Cake\ORM\Association\HasMany $Services
 *
 * @method \App\Model\Entity\Bhakta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bhakta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bhakta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bhakta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bhakta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bhakta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bhakta findOrCreate($search, callable $callback = null, $options = [])
 */
class BhaktasTable extends Table
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

        $this->setTable('bhaktas');
        $this->setDisplayField('nev_avatott');
        $this->setPrimaryKey('id');

        $this->belongsTo('Gurus', [
            'foreignKey' => 'guru_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tbs', [
            'foreignKey' => 'tb_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Hazastars', [
            'className' => 'Bhaktas',
            'foreignKey' => 'hazastars_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Services', [
            'foreignKey' => 'bhakta_id'
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

        /*$validator
            ->boolean('neme')
            ->requirePresence('neme', 'create')
            ->notEmpty('neme');

        $validator
            ->requirePresence('nev_szuletesi', 'create')
            ->notEmpty('nev_szuletesi');

        $validator
            ->requirePresence('nev_polgari', 'create')
            ->notEmpty('nev_polgari');

        $validator
            ->requirePresence('nev_avatott', 'create')
            ->notEmpty('nev_avatott');

        $validator
            ->requirePresence('cim_allando', 'create')
            ->notEmpty('cim_allando');

        $validator
            ->requirePresence('cim_ideiglenes', 'create')
            ->notEmpty('cim_ideiglenes');

        $validator
            ->requirePresence('cim_szallas', 'create')
            ->notEmpty('cim_szallas');

        $validator
            ->requirePresence('szig', 'create')
            ->notEmpty('szig');

        $validator
            ->requirePresence('utlevel', 'create')
            ->notEmpty('utlevel');

        $validator
            ->requirePresence('adoazonosito', 'create')
            ->notEmpty('adoazonosito');

        $validator
            ->requirePresence('taj', 'create')
            ->notEmpty('taj');

        $validator
            ->requirePresence('szul_hely', 'create')
            ->notEmpty('szul_hely');

        $validator
            ->date('szul_date')
            ->allowEmpty('szul_date');

        $validator
            ->time('szul_time')
            ->allowEmpty('szul_time');

        $validator
            ->requirePresence('allampolgarsag', 'create')
            ->notEmpty('allampolgarsag');

        $validator
            ->integer('katonasag')
            ->requirePresence('katonasag', 'create')
            ->notEmpty('katonasag');

        $validator
            ->requirePresence('haziorvos_nev', 'create')
            ->notEmpty('haziorvos_nev');

        $validator
            ->requirePresence('haziorvos_cim', 'create')
            ->notEmpty('haziorvos_cim');

        $validator
            ->requirePresence('haziorvos_telefon', 'create')
            ->notEmpty('haziorvos_telefon');

        $validator
            ->requirePresence('datum_elsotalalkozas', 'create')
            ->notEmpty('datum_elsotalalkozas');

        $validator
            ->requirePresence('datum_elfogadas', 'create')
            ->notEmpty('datum_elfogadas');

        $validator
            ->requirePresence('datum_elsoavatas', 'create')
            ->notEmpty('datum_elsoavatas');

        $validator
            ->requirePresence('datum_masodikavatas', 'create')
            ->notEmpty('datum_masodikavatas');

        $validator
            ->integer('asram')
            ->requirePresence('asram', 'create')
            ->notEmpty('asram');

        $validator
            ->requirePresence('tb', 'create')
            ->notEmpty('tb');

        $validator
            ->requirePresence('statusz_jogi', 'create')
            ->notEmpty('statusz_jogi');

        $validator
            ->requirePresence('statusz_tagsag', 'create')
            ->notEmpty('statusz_tagsag');

        $validator
            ->requirePresence('vegzettseg', 'create')
            ->notEmpty('vegzettseg');

        $validator
            ->requirePresence('szakma', 'create')
            ->notEmpty('szakma');

        $validator
            ->requirePresence('vegakarat', 'create')
            ->notEmpty('vegakarat');

        $validator
            ->requirePresence('halalertesitendo', 'create')
            ->notEmpty('halalertesitendo');

        $validator
            ->requirePresence('bhsastri_datum', 'create')
            ->notEmpty('bhsastri_datum');

        $validator
            ->requirePresence('bhsastri_eredmeny', 'create')
            ->notEmpty('bhsastri_eredmeny');

        $validator
            ->requirePresence('nyelv', 'create')
            ->notEmpty('nyelv');

        $validator
            ->requirePresence('csalad_nev_anya', 'create')
            ->notEmpty('csalad_nev_anya');

        $validator
            ->requirePresence('csalad_nev_apa', 'create')
            ->notEmpty('csalad_nev_apa');

        $validator
            ->requirePresence('csalad_hozzaallas', 'create')
            ->notEmpty('csalad_hozzaallas');

        $validator
            ->requirePresence('india', 'create')
            ->notEmpty('india');

        $validator
            ->requirePresence('rs_szerz', 'create')
            ->notEmpty('rs_szerz');

        $validator
            ->boolean('aktiv')
            ->requirePresence('aktiv', 'create')
            ->notEmpty('aktiv');

        $validator
            ->requirePresence('bizalmas_info', 'create')
            ->notEmpty('bizalmas_info');

        $validator
            ->requirePresence('megjegyzes', 'create')
            ->notEmpty('megjegyzes');

        $validator
            ->requirePresence('kep', 'create')
            ->notEmpty('kep');*/

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
        $rules->add($rules->existsIn(['guru_id'], 'Gurus'));
        $rules->add($rules->existsIn(['hazastars_id'], 'Hazastars'));

        return $rules;
    }
}
