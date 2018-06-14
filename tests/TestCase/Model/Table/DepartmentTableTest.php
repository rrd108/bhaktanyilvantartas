<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentsTable Test Case
 */
class DepartmentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentsTable
     */
    public $Departments;

    public $fixtures = [
        'app.departments',
        'app.centers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Departments') ? [] : ['className' => DepartmentsTable::class];
        $this->Departments = TableRegistry::getTableLocator()->get('Departments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Departments);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testFindInCenter()
    {
        $actual = $this->Departments->find('inCenter', ['center_id' => 1]);
        $expected = [1 => 'KV / Department - 1 in Center - 1'];
        $this->assertEquals($expected, $actual->toArray());

        $actual = $this->Departments->find('inCenter', ['center_id' => [1,2]]);
        $expected = [
            1 => 'KV / Department - 1 in Center - 1',
            2 => 'BP / Department - 1 in Center - 2'
        ];
        $this->assertEquals($expected, $actual->toArray());
    }
}
