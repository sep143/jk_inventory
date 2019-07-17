<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RowMaterialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RowMaterialsTable Test Case
 */
class RowMaterialsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RowMaterialsTable
     */
    public $RowMaterials;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.row_materials',
        'app.row_material_categories',
        'app.units',
        'app.grn_row',
        'app.issue_slip_rows',
        'app.purchase_order_rows',
        'app.requisition_slip_rows',
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
        $config = TableRegistry::getTableLocator()->exists('RowMaterials') ? [] : ['className' => RowMaterialsTable::class];
        $this->RowMaterials = TableRegistry::getTableLocator()->get('RowMaterials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RowMaterials);

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
