<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RowMaterialCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RowMaterialCategoriesTable Test Case
 */
class RowMaterialCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RowMaterialCategoriesTable
     */
    public $RowMaterialCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.row_material_categories',
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
        $config = TableRegistry::getTableLocator()->exists('RowMaterialCategories') ? [] : ['className' => RowMaterialCategoriesTable::class];
        $this->RowMaterialCategories = TableRegistry::getTableLocator()->get('RowMaterialCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RowMaterialCategories);

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
