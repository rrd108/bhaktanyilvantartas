<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CentersUsersFixture
 *
 */
class CentersUsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'center_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_users_has_centers_centers1_idx' => ['type' => 'index', 'columns' => ['center_id'], 'length' => []],
            'fk_users_has_centers_users1_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_users_has_centers_centers1' => ['type' => 'foreign', 'columns' => ['center_id'], 'references' => ['centers', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_users_has_centers_users1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
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
                'center_id' => 1,
                'user_id' => '137bac75-6c1c-49e2-9aeb-8acfcbd48520' //is_superuser
            ],
            [
                'id' => 2,
                'center_id' => 2,
                'user_id' => '999aaa77-6c1c-49e2-9aeb-8acfcbd48520'
            ],
        ];
        parent::init();
    }
}
