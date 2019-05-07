<?php 

namespace OrlandoLibardi\GalleryCms\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;


class OlCmsGalleryviewServiceProvider extends ServiceProvider
{  

    /**
     * Register the service provider.
     */
    public function register()
    {               
        $this->registerGalleryCmsBuilder();
        $this->app->alias('OlCmsGallery', GalleryCmsBuilder::class);        
    }

    /**
     * Register the GalleryCms builder instance.
     */
    protected function registerGalleryCmsBuilder()
    {
        $this->app->singleton('OlCmsGallery', function ($app) {
            return new GalleryCmsBuilder($app['url'], $app['request']);
        });
    }    

    /**
     * Get the services provided by the provider.
     */
    public function provides()
    {
        return ['OlCmsGallery', GalleryCmsBuilder::class];
    }
}