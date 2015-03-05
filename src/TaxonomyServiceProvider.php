<?php

namespace Namest\Taxonomy;

use Illuminate\Support\ServiceProvider;
use Namest\Sluggable\SluggableServiceProvider;
use Namest\Taxonomy\Console\Commands\MakeTaxonomy;

/**
 * Class TaxonomyServiceProvider
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Taxonomy
 *
 */
class TaxonomyServiceProvider extends ServiceProvider
{
    /**
     * Boot up resources
     */
    public function boot()
    {
        // Publish a config file
//        $this->publishes([
//            __DIR__ . '/../config/taxonomy.php' => config_path('taxonomy.php')
//        ], 'config');

        // Publish your migrations
        $this->publishes([
            __DIR__ . '/../database/migrations/' => base_path('/database/migrations')
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(new SluggableServiceProvider($this->app));

        $this->commands(MakeTaxonomy::class);
    }
}
