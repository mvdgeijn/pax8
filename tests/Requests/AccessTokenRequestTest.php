<?php

namespace Requests;

use Mvdgeijn\Pax8\Requests\AccessTokenRequest;
use Tests\TestCase;

class AccessTokenRequestTest extends TestCase
{

    public function testGetAccessToken()
    {
        $accessTokenRequest = new AccessTokenRequest();

        $pax8 = $accessTokenRequest->getAccessToken();

        $this->assertNotNull( $pax8 );

        $this->assertIsObject( $pax8 );

        $this->assertNotEmpty( $pax8->accessToken );

        $this->assertTrue( $pax8->expiryTimestamp > time() );
    }

    public function test__construct()
    {
        $accessTokenRequest = new AccessTokenRequest();

        /* Test if an actual accessTokenRequest is returned */
        $this->assertNotNull($accessTokenRequest );
    }
}
