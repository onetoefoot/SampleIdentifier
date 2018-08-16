<?php

namespace Onetoefoot\Sampleidentifier;

use Illuminate\Support\ServiceProvider;

class SampleidentifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerMigrations();
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        // $this->publishes([
        //     __DIR__.'/../config/sampleidentifier.php' => config_path('sampleidentifier.php'),
        // ], 'config');
        // $this->mergeConfigFrom(__DIR__.'/../config/sampleidentifier.php', 'sampleidentifier');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $destinationPath = base_path('resources/views/docs');
        $path = __DIR__.'/resources/views';

        $this->loadViewsFrom($path, 'sampleidentifier');

    }

    /**
     * Register migrations
     *
     * @return void
     */
    public function registerMigrations()
    {
        if (! class_exists('CreateSiRecordTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_si_record_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_si_record_table.php'),
            ], 'migrations');
        }
    }
}
