<?php namespace Arcanedev\Taxonomies\Tests;

use Arcanedev\Taxonomies\TaxonomiesServiceProvider;

/**
 * Class     TaxonomiesServiceProviderTest
 *
 * @package  Arcanedev\Taxonomies\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TaxonomiesServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var \Arcanedev\Taxonomies\TaxonomiesServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(TaxonomiesServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanedev\Support\PackageServiceProvider::class,
            \Arcanedev\Taxonomies\TaxonomiesServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            //
        ];

        $this->assertEquals($expected, $this->provider->provides());
    }
}
