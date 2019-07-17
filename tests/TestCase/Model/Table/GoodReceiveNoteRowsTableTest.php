<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GoodReceiveNoteRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GoodReceiveNoteRowsTable Test Case
 */
class GoodReceiveNoteRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GoodReceiveNoteRowsTable
     */
    public $GoodReceiveNoteRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.good_receive_note_rows',
        'app.good_receive_notes',
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
        $config = TableRegistry::getTableLocator()->exists('GoodReceiveNoteRows') ? [] : ['className' => GoodReceiveNoteRowsTable::class];
        $this->GoodReceiveNoteRows = TableRegistry::getTableLocator()->get('GoodReceiveNoteRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GoodReceiveNoteRows);

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
