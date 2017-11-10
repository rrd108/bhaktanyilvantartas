<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LegalstatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LegalstatusesTable Test Case
 */
class LegalstatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LegalstatusesTable
     */
    public $Legalstatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.legalstatuses',
        'app.bhaktas',
        'app.gurus',
        'app.tbs',
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
        $config = TableRegistry::exists('Legalstatuses') ? [] : ['className' => 'App\Model\Table\LegalstatusesTable'];
        $this->Legalstatuses = TableRegistry::get('Legalstatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Legalstatuses);

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
