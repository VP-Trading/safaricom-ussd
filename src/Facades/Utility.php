<?php

namespace Vptrading\SafaricomUssd\Facades;

use Illuminate\Support\Facades\Facade;
use Vptrading\SafaricomUssd\Support\Utility as SupportUtility;

class Utility extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SupportUtility::class;
    }
}
