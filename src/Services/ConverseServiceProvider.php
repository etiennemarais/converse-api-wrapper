<?php namespace ConverseApi;

use ConverseApi\Services\Content\ContentController;
use Illuminate\Support\ServiceProvider;

class ConverseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        include __DIR__ . '/routes.php';

        $this->loadViewsFrom(storage_path() . '/app/Converse', 'Converse');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ConverseApi\Services\Content\ContentController', function ($app) {
            return new ContentController();
        });
    }
}