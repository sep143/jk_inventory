<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RowMaterialsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RowMaterialsController Test Case
 */
class RowMaterialsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
