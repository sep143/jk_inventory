<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrnTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrnTable Test Case
 */
class GrnTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GrnTable
     */
    public $Grn;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.grn',
        'app.purchase_orders',
        'app.grn_row',
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
        $config = TableRegistry::getTableLocator()->exists('Grn') ? [] : ['className' => GrnTable::class];
        $this->Grn = TableRegistry::getTableLocator()->get('Grn', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Grn);

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
