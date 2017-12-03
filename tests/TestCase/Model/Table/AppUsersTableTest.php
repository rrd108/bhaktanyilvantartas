<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppUsersTable Test Case
 */
class AppUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AppUsersTable
     */
    public $AppUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AppUsers') ? [] : ['className' => AppUsersTable::class];
        $this->AppUsers = TableRegistry::get('AppUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AppUsers);

        parent::tearDown();
    }

    /**
     * Test findSuperUsers method
     *
     * @return void
     */
    public function testFindSuperUsers()
    {
        $actual = $this->AppUsers->find('superUsers');
        $expected = ['User 1'];
        $this->assertEquals($expected, $actual->extract('username')->toArray());
    }
}
