<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GurusFixture
 *
 */
class GurusFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'gurus';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'nev_rovid' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nev_full' => ['type' => 'string', 'length' => 75, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'utf8_hungarian_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'nev_rovid' => 'Lor',
            'nev_full' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
