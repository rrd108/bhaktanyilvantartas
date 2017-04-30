<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BhaktasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BhaktasTable Test Case
 */
class BhaktasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BhaktasTable
     */
    public $Bhaktas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bhaktas',
        'app.gurus',
        'app.hazastars',
        'app.services'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bhaktas') ? [] : ['className' => 'App\Model\Table\BhaktasTable'];
        $this->Bhaktas = TableRegistry::get('Bhaktas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bhaktas);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
