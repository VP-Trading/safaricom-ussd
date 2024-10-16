<?php

return [
    "consumer_key" => env("SAFARICOM_CONSUMER_KEY"),

    "consumer_secret" => env("SAFARICOM_CONSUMER_SECRET"),

    "auth_url" => env("SAFARICOM_AUTH_URL", "https://apisandbox.safaricom.et/v1/token/generate?grant_type=client_credentials"),

    "short_code" => env("SAFARICOM_SHORT_CODE"),

    "passkey" => env("SAFARICOM_PASSKEY"),

    "checkout_url" => env("SAFARICOM_CHECKOUT_URL", "https://apisandbox.safaricom.et/mpesa/stkpush/v3/processrequest"),

    "callback_url" => env("SAFARICOM_CALLBACK_URL")
];
