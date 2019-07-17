<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IssueSlipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IssueSlipsTable Test Case
 */
class IssueSlipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IssueSlipsTable
     */
    public $IssueSlips;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.issue_slips',
        'app.employees',
        'app.issue_slip_rows',
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
        $config = TableRegistry::getTableLocator()->exists('IssueSlips') ? [] : ['className' => IssueSlipsTable::class];
        $this->IssueSlips = TableRegistry::getTableLocator()->get('IssueSlips', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->IssueSlips);

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
