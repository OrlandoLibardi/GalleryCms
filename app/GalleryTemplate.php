<?php

namespace OrlandoLibardi\GalleryCms\app;

use Illuminate\Database\Eloquent\Model;
use Log;

class GalleryTemplate extends Model
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'template' ];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
}