<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AsramsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AsramsTable Test Case
 */
class AsramsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AsramsTable
     */
    public $Asrams;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asrams',
        'app.bhaktas',
        'app.gurus',
        'app.tbs',
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
        $config = TableRegistry::exists('Asrams') ? [] : ['className' => 'App\Model\Table\AsramsTable'];
        $this->Asrams = TableRegistry::get('Asrams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Asrams);

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
