<?php

namespace Requests;

use Mvdgeijn\Pax8\Requests\AccessTokenRequest;
use Tests\TestCase;

class AccessTokenRequestTest extends TestCase
{

    public function testGetAccessToken()
    {
        $accessTokenRequest = new AccessTokenRequest();

        $accessToken = $accessTokenRequest->getAccessToken();

        $this->assertNotNull( $accessToken );

        $this->assertIsObject( $accessToken );

        $this->assertNotEmpty( $accessToken->accessToken );

        $this->assertTrue( $accessToken->expiryTimestamp > time() );
    }

    public function test__construct()
    {
        $accessTokenRequest = new AccessTokenRequest();

        /* Test if an actual accessTokenRequest is returned */
        $this->assertNotNull($accessTokenRequest );
    }
}
