<?php

namespace OrlandoLibardi\GalleryCms\app\Obervers;

use OrlandoLibardi\GalleryCms\app\GalleryItem;
use Log;

class GalleryItemObserver{

    public function creating($item){      

        if(empty($item->order_at)){
            $item->order_at = GalleryItem::maxOrder($item->gallery_id);
        }

    }
    
    public function updating($item){
        
    }
}