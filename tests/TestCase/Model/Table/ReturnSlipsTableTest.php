<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReturnSlipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReturnSlipsTable Test Case
 */
class ReturnSlipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReturnSlipsTable
     */
    public $ReturnSlips;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.return_slips',
        'app.employees',
        'app.return_slip_rows',
        'app.stock_ledgers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ReturnSlips') ? [] : ['className' => ReturnSlipsTable::class];
        $this->ReturnSlips = TableRegistry::getTableLocator()->get('ReturnSlips', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReturnSlips);

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
