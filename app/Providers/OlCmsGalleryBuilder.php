<?php

namespace OrlandoLibardi\GalleryCms\app\Providers;

use BadMethodCallException;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\UrlGenerator;

use Log;
use OrlandoLibardi\GalleryCms\app\Gallery;
use OrlandoLibardi\GalleryCms\app\GalleryItem;
use OrlandoLibardi\GalleryCms\app\GalleryTemplate;



class OlCmsGallery
{
    protected $defaults;
    protected $accepted = [];
    protected $params;
    protected $host;
    /**
     * The URL generator instance.
     *
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    protected $url;

    /**
     * Create a new form builder instance.
     *
     * @param  \Illuminate\Contracts\Routing\UrlGenerator $url
     */
    public function __construct()
    {
        $this->url = url()->current();
        $this->host = request()->getSchemeAndHttpHost();
    }

    public function show($alias=false)
    {
             

    }

    public function setError($error)
    {
        $msg = 'ERROR OlCmsMenu: ' . $error;
        Log::info( $msg );
        return "<!-- {$msg} -->";
    }
    
    
    public function getTemplate($template)
    {
        $location = str_replace(resource_path('views\/'), "",  config('pages.page_path') . "/gallery/" . $template);
        $location = str_replace("\/", "/", $location);
        $location = str_replace("/", ".", $location);
        $location = str_replace("..", ".", $location);
        $location = str_replace(".blade.php", "", $location);
        return $location;
    }
    

    

}