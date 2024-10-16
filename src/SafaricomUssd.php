<?php

namespace Vptrading\SafaricomUssd;

use Illuminate\Support\Facades\Http;
use Vptrading\SafaricomUssd\Facades\Utility;

class SafaricomUssd
{
    public function push(
        string $amount,
        string $phone,
        string $requestId,
        ?string $desc = "Buy Good",
        ?array $referenceData = []
    ) {
        $time = now()->format('YmdHis');
        $hash = Utility::hash(config('safaricom-ussd.short_code'), config('safaricom-ussd.passkey'), $time);

        $payload = [
            "MerchantRequestID" => $requestId,
            "BusinessShortCode" => config('safaricom-ussd.short_code'),
            "Password" => $hash,
            "Timestamp" => $time,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => Utility::cleanPhone($phone),
            "PartyB" => config('safaricom-ussd.short_code'),
            "PhoneNumber" => Utility::cleanPhone($phone),
            "TransactionDesc" => $desc,
            "CallBackURL" => config('safaricom-ussd.callback_url'),
            "AccountReference" => $desc,
        ];

        if (!empty($referenceData)) {
            $payload['ReferenceData'] = $referenceData;
        }

        $auth = Http::withBasicAuth(config('safaricom-ussd.consumer_key'), config('safaricom-ussd.consumer_secret'))
            ->get(config('safaricom-ussd.auth_url'));

        $response = Http::withToken($auth->json('access_token'))
            ->post(config('safaricom-ussd.checkout_url'), $payload);

        return $response->json();
    }
}
