<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GurusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GurusTable Test Case
 */
class GurusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GurusTable
     */
    public $Gurus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.gurus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Gurus') ? [] : ['className' => 'App\Model\Table\GurusTable'];
        $this->Gurus = TableRegistry::get('Gurus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Gurus);

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
