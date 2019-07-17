<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequisitionSlipRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequisitionSlipRowsTable Test Case
 */
class RequisitionSlipRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequisitionSlipRowsTable
     */
    public $RequisitionSlipRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requisition_slip_rows',
        'app.requistion_slips',
        'app.row_materials'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RequisitionSlipRows') ? [] : ['className' => RequisitionSlipRowsTable::class];
        $this->RequisitionSlipRows = TableRegistry::getTableLocator()->get('RequisitionSlipRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequisitionSlipRows);

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
