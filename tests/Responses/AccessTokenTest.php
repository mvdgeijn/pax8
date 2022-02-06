<?php

namespace Requests;

use Mvdgeijn\Pax8\Requests\CompanyRequest;
use Mvdgeijn\Pax8\Requests\ContactRequest;
use Mvdgeijn\Pax8\Responses\AccessToken;
use Tests\TestCase;

class AccessTokenTest extends TestCase
{

    public function testAccessToken()
    {

        $body =<<< EOT
{
    "access_token": "dummy-access-token",
    "expires_in": 86400,
    "token_type": "Bearer"
}
EOT;
        $accessToken = accessToken::createFromBody( $body );

        $this->assertTrue(strcmp($accessToken->accessToken, "dummy-access-token" ) == 0 );

        $this->assertFalse( $accessToken->isExpired() );

        /* Check if a CompanyRequest object is returned */
        $request = $accessToken->companyRequest();
        $this->assertIsObject( $request );
        $this->assertTrue( strcmp( get_class( $request ), CompanyRequest::class ) == 0 );
        $this->assertTrue( strcmp( $request->getAccessToken()->accessToken, $accessToken->accessToken ) == 0 );

        /* Check if a ContactRequest object is returned */
        $request = $accessToken->contactRequest();
        $this->assertIsObject( $request );
        $this->assertTrue( strcmp( get_class( $request ), ContactRequest::class ) == 0 );
        $this->assertTrue( strcmp( $request->getAccessToken()->accessToken, $accessToken->accessToken ) == 0 );

        /* Check if isExpired returns correct value */
        $accessToken->expiryTimestamp = time() - 10;
        $this->assertTrue( $accessToken->isExpired() );

        /* Check if isExpired returns correct value */
        $accessToken->expiryTimestamp = time() + 10;
        $this->assertFalse( $accessToken->isExpired() );
    }
}
