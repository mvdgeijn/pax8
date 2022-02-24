<?php

namespace Requests;

use Mvdgeijn\Pax8\Facades\Pax8;
use Mvdgeijn\Pax8\Requests\CompanyRequest;
use Mvdgeijn\Pax8\Requests\ContactRequest;
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
        $pax8 = Pax8::createFromBody( $body );
        $this->assertTrue(strcmp($pax8->accessToken, "dummy-access-token" ) == 0 );
        $this->assertFalse( $pax8->isExpired() );

        /* Check if a CompanyRequest object is returned */
        $request = $pax8->companyRequest();
        $this->assertIsObject( $request );
        $this->assertTrue( strcmp( get_class( $request ), CompanyRequest::class ) == 0 );
        $this->assertTrue( strcmp( $request->getPax8()->accessToken, $pax8->accessToken ) == 0 );

        /* Check if a ContactRequest object is returned */
        $request = $pax8->contactRequest();
        $this->assertIsObject( $request );
        $this->assertTrue( strcmp( get_class( $request ), ContactRequest::class ) == 0 );
        $this->assertTrue( strcmp( $request->getPax8()->accessToken, $pax8->accessToken ) == 0 );

        /* Check if isExpired returns correct value */
        $pax8->expiryTimestamp = time() - 10;
        $this->assertTrue( $pax8->isExpired() );

        /* Check if isExpired returns correct value */
        $pax8->expiryTimestamp = time() + 10;
        $this->assertFalse( $pax8->isExpired() );

        $pax8->renew();
        $this->assertFalse( $pax8->accessToken == "dummy-access-token" );
        $this->assertFalse( $pax8->isExpired() );
    }
}
