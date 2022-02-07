<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;
use Mvdgeijn\Pax8\Collections\PaginatedCollection;

abstract class AbstractResponse
{
    public static function createFromBody( string $body ): PaginatedCollection
    {
        $json = json_decode( $body );
        $collection = PaginatedCollection::create( $json->page );

        foreach( $json->content as $item )
        {
            $collection->add( Subscription::parse( $item ) );
        }

        return $collection;
    }

    abstract public static function parse( object $item ): AbstractResponse;

    public static function getDate( $date ): Carbon
    {
        if( gettype($date) == "string" )
            $date = Carbon::parse( $date );

        return $date;
    }
}
