<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequisitionSlipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequisitionSlipsTable Test Case
 */
class RequisitionSlipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequisitionSlipsTable
     */
    public $RequisitionSlips;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requisition_slips'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RequisitionSlips') ? [] : ['className' => RequisitionSlipsTable::class];
        $this->RequisitionSlips = TableRegistry::getTableLocator()->get('RequisitionSlips', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequisitionSlips);

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
}
