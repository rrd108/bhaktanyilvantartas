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
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'username' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'last_name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'token' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'token_expires' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'api_token' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'activation_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'secret' => ['type' => 'string', 'length' => 32, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'secret_verified' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'tos_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'is_superuser' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'role' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'user', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
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
            'id' => '137bac75-6c1c-49e2-9aeb-8acfcbd48520',
            'username' => 'User 1',
            'email' => 'user1@example.com',
            'password' => 'Lorem ipsum dolor sit amet',
            'first_name' => 'User',
            'last_name' => 'One',
            'token' => 'Lorem ipsum dolor sit amet',
            'token_expires' => '2017-11-26 19:03:10',
            'api_token' => 'Lorem ipsum dolor sit amet',
            'activation_date' => '2017-11-26 19:03:10',
            'secret' => 'Lorem ipsum dolor sit amet',
            'secret_verified' => 1,
            'tos_date' => '2017-11-26 19:03:10',
            'active' => 1,
            'is_superuser' => 1,
            'role' => 'admin',
            'created' => '2017-11-26 19:03:10',
            'modified' => '2017-11-26 19:03:10'
        ],
        [
            'id' => '999aaa77-6c1c-49e2-9aeb-8acfcbd48520',
            'username' => 'User 2',
            'email' => 'user2@example.com',
            'password' => 'Lorem ipsum dolor sit amet',
            'first_name' => 'User',
            'last_name' => 'Two',
            'token' => 'Lorem ipsum dolor sit amet',
            'token_expires' => '2017-11-26 19:03:10',
            'api_token' => 'Lorem ipsum dolor sit amet',
            'activation_date' => '2017-11-26 19:03:10',
            'secret' => 'Lorem ipsum dolor sit amet',
            'secret_verified' => 1,
            'tos_date' => '2017-11-26 19:03:10',
            'active' => 1,
            'is_superuser' => 0,
            'role' => 'user',
            'created' => '2017-11-26 19:03:10',
            'modified' => '2017-11-26 19:03:10'
        ],
    ];
}
