<?php

namespace Vptrading\SafaricomUssd\Facades;

use Illuminate\Support\Facades\Facade;

class SafaricomUssd extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'safaricom-ussd';
    }
}
