<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GoodReceiveNotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GoodReceiveNotesTable Test Case
 */
class GoodReceiveNotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GoodReceiveNotesTable
     */
    public $GoodReceiveNotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.good_receive_notes',
        'app.purchase_orders',
        'app.good_receive_note_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GoodReceiveNotes') ? [] : ['className' => GoodReceiveNotesTable::class];
        $this->GoodReceiveNotes = TableRegistry::getTableLocator()->get('GoodReceiveNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GoodReceiveNotes);

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
