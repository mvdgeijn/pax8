<?php

namespace Mvdgeijn\Pax8\Facades;

use Illuminate\Support\Facades\Facade;

class Pax8 extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Mvdgeijn\Pax8\Pax8::class;
    }
}
