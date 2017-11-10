<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunityrolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunityrolesTable Test Case
 */
class CommunityrolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunityrolesTable
     */
    public $Communityroles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.communityroles',
        'app.bhaktas',
        'app.gurus',
        'app.tbs',
        'app.legalstatuses',
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
        $config = TableRegistry::exists('Communityroles') ? [] : ['className' => 'App\Model\Table\CommunityrolesTable'];
        $this->Communityroles = TableRegistry::get('Communityroles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Communityroles);

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
