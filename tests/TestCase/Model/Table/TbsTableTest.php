<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbsTable Test Case
 */
class TbsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TbsTable
     */
    public $Tbs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tbs',
        'app.bhaktas',
        'app.gurus',
        'app.legalstatuses',
        'app.communityroles',
        'app.services',
        'app.departments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tbs') ? [] : ['className' => 'App\Model\Table\TbsTable'];
        $this->Tbs = TableRegistry::get('Tbs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tbs);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
