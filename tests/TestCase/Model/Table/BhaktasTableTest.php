<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BhaktasTable;
use Cake\I18n\Date;
use Cake\I18n\Time;
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

    public function testFindEuCardExpired()
    {
        $actual = $this->Bhaktas->find('euCardExpired');
        $expected = [];
        $this->assertEquals($expected, $actual->extract('id')->toArray());

        $actual = $this->Bhaktas->find('euCardExpired', ['maxDate' => Time::now()]);
        $expected = [2];
        $this->assertEquals($expected, $actual->extract('id')->toArray());

        $actual = $this->Bhaktas->find(
            'euCardExpired',
            ['minDate' => Time::now(), 'maxDate' => (new Date())->modify('+5 months')]
        );
        $expected = [1];
        $this->assertEquals($expected, $actual->extract('id')->toArray());
    }
}
