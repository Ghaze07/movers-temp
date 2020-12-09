<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CUTTLYFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cuttly_service';
    }
}
