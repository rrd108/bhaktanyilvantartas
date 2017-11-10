<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'rovidnev' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nev' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'jelszo' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'kozpont' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'emil' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'jog_maskozpont' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'jog_felvitel' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'jog_lekerdez' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'jog_keres' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'jog_adatlap' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'jog_bizalmas' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
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
            'rovidnev' => 'Lorem ipsum dolor sit amet',
            'nev' => 'Lorem ipsum dolor sit amet',
            'jelszo' => 'Lorem ipsum dolor sit amet',
            'kozpont' => 1,
            'emil' => 'Lorem ipsum dolor sit amet',
            'jog_maskozpont' => 1,
            'jog_felvitel' => 1,
            'jog_lekerdez' => 1,
            'jog_keres' => 1,
            'jog_adatlap' => 1,
            'jog_bizalmas' => 1
        ],
    ];
}
