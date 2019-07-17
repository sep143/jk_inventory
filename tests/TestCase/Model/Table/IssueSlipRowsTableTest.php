<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IssueSlipRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IssueSlipRowsTable Test Case
 */
class IssueSlipRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IssueSlipRowsTable
     */
    public $IssueSlipRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.issue_slip_rows',
        'app.issue_slips',
        'app.row_materials',
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
        $config = TableRegistry::getTableLocator()->exists('IssueSlipRows') ? [] : ['className' => IssueSlipRowsTable::class];
        $this->IssueSlipRows = TableRegistry::getTableLocator()->get('IssueSlipRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->IssueSlipRows);

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
