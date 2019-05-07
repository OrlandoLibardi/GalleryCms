<?php

namespace OrlandoLibardi\GalleryCms\app;

use Illuminate\Database\Eloquent\Model;
use Log;

class GalleryItem extends Model
{
    protected $fillable = [ 'gallery_id', 'title', 'sub_titile',  'img', 'link_href', 'link_target', 'order_at'];
    
}