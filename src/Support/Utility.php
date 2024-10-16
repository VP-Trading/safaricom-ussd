<?php

namespace Vptrading\SafaricomUssd\Support;

class Utility
{
    public function hash(string $shortCode, string $passkey, string $timestamp): string
    {
        $hash = hash('sha256', "$shortCode$passkey$timestamp");

        $base64Encode = base64_encode($hash);

        return $base64Encode;
    }

    public function cleanPhone(string $phone): string
    {
        $cleanPhone = '251' . substr($phone, -9);

        return $cleanPhone;
    }
}
