<?php 

namespace OrlandoLibardi\GalleryCms\app\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;



use OrlandoLibardi\GalleryCms\app\Gallery;
use OrlandoLibardi\GalleryCms\app\GalleryItem;
use OrlandoLibardi\GalleryCms\app\GalleryTemplate;

use OrlandoLibardi\GalleryCms\app\Obervers\GalleryObserver;
use OrlandoLibardi\GalleryCms\app\Obervers\GalleryItemObserver;



class OlCmsMenuServiceProvider extends ServiceProvider{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Rotas para controllador Gallery
         */
        Route::namespace('OrlandoLibardi\GalleryCms\app\Http\Controllers')
               ->middleware(['web', 'auth'])
               ->prefix('admin')
               ->group(__DIR__. '/../../routes/web.php');
        /**
         * Publicar os arquivos 
         */
        $this->publishes( [
            __DIR__.'/../../database/migrations/' => database_path('migrations/'),
            __DIR__.'/../../database/seeds/' => database_path('seeds/'),
            __DIR__.'/../../resources/views/admin/' => resource_path('views/admin/'),
            __DIR__.'/../../resources/views/website/' => resource_path('views/website/'),             
        ],'config');  
        /**
         * Observer Gallery
         */
        Gallery::observe(GalleryObserver::class);
         /**
         * Observer Gallery Items
         */
        GalleryItem::observe(GalleryItemObserver::class);
    }
    
}