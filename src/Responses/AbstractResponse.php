<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;
use Mvdgeijn\Pax8\Collections\PaginatedCollection;

class AbstractResponse
{
    protected string $id;

    /**
     * @param string $body
     * @return PaginatedCollection
     * @throws \Exception
     */
    public static function createFromBody(string $body ): PaginatedCollection
    {
        $json = json_decode( $body );
        $collection = PaginatedCollection::create( $json->page );

        foreach( $json->content as $item )
            $collection->add( static::parse( $item ) );

        return $collection;
    }

    /**
     * @param object $item
     * @return AbstractResponse
     * @throws \Exception
     */
    public static function parse(object $item)
    {
        $response = new (static::class)();

        foreach( $item as $key => $value )
        {
            $method = 'set' . ucfirst( $key );
            if( method_exists($response,$method ) )
            {
                $response->{$method}($value);
            } else
            {
                throw new \Exception( "$method : $key" );
            }
        }

        return $response;
    }

    /**
     * @param $date
     * @return Carbon
     */
    public static function getDate($date ): Carbon
    {
        if( gettype($date) == "string" )
            $date = Carbon::parse( $date );

        return $date;
    }

    /**
     * @param $amount
     * @return string
     */
    public static function getAmount($amount ): string
    {
        return bcmul( $amount, 1, 2 );
    }

    /**
     * @param mixed $id
     * @return AbstractResponse
     */
    public function setId($id): AbstractResponse
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
