<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CentersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CentersTable Test Case
 */
class CentersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CentersTable
     */
    public $Centers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.centers',
        'app.users',
        'app.centers_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Centers') ? [] : ['className' => CentersTable::class];
        $this->Centers = TableRegistry::getTableLocator()->get('Centers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Centers);

        parent::tearDown();
    }

    /**
     * Test findAccessible method
     *
     * @return void
     */
    public function testFindAccessible()
    {
        $actual = $this->Centers->find(
            'accessible',
            [
                'id' => '999aaa77-6c1c-49e2-9aeb-8acfcbd48520',
                'is_superuser' => false
            ]
        );
        $expected = [2];
        $this->assertEquals($expected, $actual->extract('id')->toArray());

        $actual = $this->Centers->find(
            'accessible',
            [
                'id' => '137bac75-6c1c-49e2-9aeb-8acfcbd48520',
                'is_superuser' => true
            ]
        );
        $expected = [1,2];
        $this->assertEquals($expected, $actual->extract('id')->toArray());
    }
}
