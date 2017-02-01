<?php namespace Arcanedev\Taxonomies\Tests\Models;

use Arcanedev\Taxonomies\Models\Category;
use Arcanedev\Taxonomies\Tests\TestCase;

/**
 * Class     CategoryTest
 *
 * @package  Arcanedev\Taxonomies\Tests\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CategoryTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->migrate();
        $this->seedCategories();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_get_tree()
    {
        $tree = Category::tree();

        $this->assertCount(2, $tree);
    }

    public function it_can_get_root()
    {
        $root = Category::root();

        $this->assertInstanceOf(Category::class, $root);
        $this->assertNull($root->parent_id);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    private function seedCategories()
    {
        $date = \Carbon\Carbon::now();
        $data = array_map(function ($category) use ($date) {
            return $category + ['created_at' => $date, 'updated_at' => $date];
        }, include __DIR__.'/../fixtures/data/categories.php');

        \Arcanedev\Taxonomies\Models\Category::insert($data);
    }
}
