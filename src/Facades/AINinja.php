<?php

namespace IanRothmann\AINinja\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IanRothmann\AINinja\AINinja
 */
class AINinja extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \IanRothmann\AINinja\AINinja::class;
    }
}
