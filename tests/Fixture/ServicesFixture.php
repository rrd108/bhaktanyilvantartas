<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ServicesFixture
 *
 */
class ServicesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'bhakta_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'department_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'szolgalat' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'szolgalat_kezdete' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'szolgalat_vege' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'szolg_megjegyzes' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'fk_bhaktas_ids' => ['type' => 'index', 'columns' => ['bhakta_id'], 'length' => []],
            'fk_departments_ids' => ['type' => 'index', 'columns' => ['department_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_bhaktas_ids' => ['type' => 'foreign', 'columns' => ['bhakta_id'], 'references' => ['bhaktas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_departments_ids' => ['type' => 'foreign', 'columns' => ['department_id'], 'references' => ['departments', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_hungarian_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'bhakta_id' => 1,
                'department_id' => 1,
                'szolgalat' => 'Lorem ipsum dolor sit amet',
                'szolgalat_kezdete' => '2018-06-14',
                'szolgalat_vege' => '2018-07-14',
                'szolg_megjegyzes' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'id' => 2,
                'bhakta_id' => 2,
                'department_id' => 2,
                'szolgalat' => 'Lorem ipsum dolor sit amet',
                'szolgalat_kezdete' => '2018-06-01',
                'szolgalat_vege' => null,
                'szolg_megjegyzes' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
