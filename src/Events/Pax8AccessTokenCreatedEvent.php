<?php

namespace Mvdgeijn\Pax8\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Mvdgeijn\Pax8\Pax8;

class Pax8AccessTokenCreatedEvent
{
    use Dispatchable;

    /**
     * The new Pax8 access token
     *
     * @var Pax8
     */
    public Pax8 $pax8;

    /**
     * Create a new event instance
     *
     * @param Pax8 $pax8
     */
    public function __construct(Pax8 $pax8)
    {
        $this->pax8 = $pax8;
    }
}
