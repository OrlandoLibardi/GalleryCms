<?php

namespace OrlandoLibardi\GalleryCms\app\Providers;

use Illuminate\Support\Facades\Facade;

class GalleryCmsFacada extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'GalleryCms';
    }
}