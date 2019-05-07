<?php

namespace OrlandoLibardi\GalleryCms\app;

use Illuminate\Database\Eloquent\Model;
use Log;

class Gallery extends Model
{
    protected $fillable = [ 'name', 'alias',  'status'];

    /**
     *  Set unique Alias 
     */
    public static function alias($alias, $count=0)
    {
        $nalias = ($count > 0) ? $alias.'-'.$count : $alias;
        $g = Gallery::where('alias', $nalias)->get();        
        if(count($g) > 0)
            return Gallery::alias($alias, $count+1);

        return $nalias;
    }

    public function items()
    {
        return $this->hasMany('OrlandoLibardi\GalleryCms\app\GalleryItem', 'gallery_id', 'id');
    }

    /**
     * Date updated_at Accessor
     */   
    public function getUpdatedAtAttribute($value)
    {
        if($value) return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    /**
     * Date created_at Accessor
     */   
    public function getCreatedAtAttribute($value)
    {
        if($value) return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}