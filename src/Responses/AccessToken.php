<?php

namespace Mvdgeijn\Pax8\Responses;

use Mvdgeijn\Pax8\Requests\CompanyRequest;
use Mvdgeijn\Pax8\Requests\ContactRequest;

class AccessToken
{
    public $accessToken;

    public $expiryTimestamp;

    public function isExpired(): bool
    {
        return time() > $this->expiryTimestamp;
    }

    public static function createFromBody( string $body): AccessToken
    {
        $json = json_decode( $body );

        $token = new AccessToken();

        $token->accessToken = $json->access_token;
        $token->expiryTimestamp = time() + $json->expires_in - 600;

        return $token;
    }

    public function companyRequest(): CompanyRequest
    {
        return new CompanyRequest($this);
    }

    public function contactRequest(): ContactRequest
    {
        return new ContactRequest($this);
    }

}
