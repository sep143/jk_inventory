<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaterialTransferSlipRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaterialTransferSlipRowsTable Test Case
 */
class MaterialTransferSlipRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MaterialTransferSlipRowsTable
     */
    public $MaterialTransferSlipRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.material_transfer_slip_rows',
        'app.material_transfer_slips',
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
        $config = TableRegistry::getTableLocator()->exists('MaterialTransferSlipRows') ? [] : ['className' => MaterialTransferSlipRowsTable::class];
        $this->MaterialTransferSlipRows = TableRegistry::getTableLocator()->get('MaterialTransferSlipRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaterialTransferSlipRows);

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
