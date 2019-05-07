<?php

namespace OrlandoLibardi\GalleryCms\app\Obervers;

use OrlandoLibardi\GalleryCms\app\Gallery;
use Log;

class GalleryObserver{

    public function creating($gallery)
    {
        //Generate unique alias
        $gallery->alias = Gallery::alias(str_slug($gallery->name, '-'), 0);
        $gallery->created_at = \Carbon\Carbon::now();
    }
    
    public function updating($gallery)
    {
        $gallery->updated_at = \Carbon\Carbon::now();
    }


    public function deleting($gallery)
    {
        
    }
}