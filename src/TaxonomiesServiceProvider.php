<?php namespace Arcanedev\Taxonomies;

use Arcanedev\Support\PackageServiceProvider as ServiceProvider;

/**
 * Class     TaxonomiesServiceProvider
 *
 * @package  Arcanedev\Taxonomies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TaxonomiesServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Vendor name.
     *
     * @var string
     */
    protected $vendor  = 'arcanedev';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'taxonomies';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer   = false;

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();

        $this->app->register(\Baum\Providers\BaumServiceProvider::class);
    }

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            $this->getConfigFile() => config_path("$this->package.php")
        ], 'config');

        $this->publishes([
            $this->getBasePath() . '/database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            //
        ];
    }
}
