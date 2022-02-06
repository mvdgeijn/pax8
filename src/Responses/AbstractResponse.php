<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;

class AbstractResponse
{
    public static function getDate( $date ): Carbon
    {
        if( gettype($date) == "string" )
            $date = Carbon::parse( $date );

        return $date;
    }
}
