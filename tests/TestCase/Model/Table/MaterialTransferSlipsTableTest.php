<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaterialTransferSlipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaterialTransferSlipsTable Test Case
 */
class MaterialTransferSlipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MaterialTransferSlipsTable
     */
    public $MaterialTransferSlips;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.material_transfer_slips',
        'app.employees',
        'app.material_transfer_slip_rows',
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
        $config = TableRegistry::getTableLocator()->exists('MaterialTransferSlips') ? [] : ['className' => MaterialTransferSlipsTable::class];
        $this->MaterialTransferSlips = TableRegistry::getTableLocator()->get('MaterialTransferSlips', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaterialTransferSlips);

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
