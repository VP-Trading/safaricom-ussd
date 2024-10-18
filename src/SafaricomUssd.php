<?php

namespace Vptrading\SafaricomUssd;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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

        $auth = $this->getAccessToken(config('safaricom-ussd.consumer_key'), config('safaricom-ussd.consumer_secret'));

        if (!$auth->successful()) {
            throw new Exception($auth->json('resultDesc'), $auth->json('resultCode'));
        }

        $response = Http::withToken($auth['access_token'])
            ->post(config('safaricom-ussd.checkout_url'), $payload);

        if (!$response->json('ResponseCode') !== 0) {
            throw new Exception($response->json('ResponseDescription'), $response->json('ResponseCode'));
        }

        return $response->json();
    }

    public function getAccessToken(string $consumerKey, string $consumerSecret): Response
    {
        $response = Http::withBasicAuth($consumerKey, $consumerSecret)
            ->get(config('safaricom-ussd.auth_url'));

        return $response;
    }

    public function deconstruct(string $callbackData): array
    {
        return json_decode($callbackData, true);
    }
}
