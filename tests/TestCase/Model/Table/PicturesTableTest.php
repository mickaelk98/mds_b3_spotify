<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PicturesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PicturesTable Test Case
 */
class PicturesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PicturesTable
     */
    protected $Pictures;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Pictures',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pictures') ? [] : ['className' => PicturesTable::class];
        $this->Pictures = $this->getTableLocator()->get('Pictures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Pictures);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PicturesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
