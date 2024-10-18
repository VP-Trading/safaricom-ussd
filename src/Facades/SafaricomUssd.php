<?php

namespace Vptrading\SafaricomUssd\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array push(string $amount, string $phone,string $requestId, ?string $desc = "Buy Good", ?array $referenceData = [])
 * @method static array deconstruct(string $callbackData)
 * @method static \Illuminate\Http\Client\Response getAccessToken(string $consumerKey, string $consumerSecret)
 */

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
