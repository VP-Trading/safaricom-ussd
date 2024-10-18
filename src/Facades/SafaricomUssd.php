<?php

namespace Vptrading\SafaricomUssd\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Vptrading\SafaricomUssd\SafaricomUssd push(string $amount, string $phone,string $requestId, ?string $desc = "Buy Good", ?array $referenceData = [])
 * @method static \Vptrading\SafaricomUssd\SafaricomUssd deconstruct(string $callbackData)
 * @method static \Vptrading\SafaricomUssd\SafaricomUssd getAccessToken(string $consumerKey, string $consumerSecret)
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
