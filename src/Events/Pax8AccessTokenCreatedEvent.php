<?php

namespace Mvdgeijn\Pax8\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Mvdgeijn\Pax8\Responses\AccessToken;

class Pax8AccessTokenCreatedEvent
{
    use Dispatchable;

    /**
     * The new Pax8 access token
     *
     * @var AccessToken
     */
    public AccessToken $accessToken;

    /**
     * Create a new event instance
     *
     * @param AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
