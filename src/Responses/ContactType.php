<?php

namespace Mvdgeijn\Pax8\Responses;

Class ContactType
{
    const CONTACTTYPE_ADMIN = "Admin";

    const CONTACTTYPE_TECH = "Tech";

    const CONTACTTYPE_BILLING = "Billing";

    protected array $types = [];

    public static function create( array $types ): ContactType
    {
        $contactType = new ContactType;

        $contactTypes = self::getContactTypes();

        foreach( $types as $type )
        {
            if( in_array( $type->type, $contactTypes ) )
                $contactType->{'enable' . $type->type}( $type->primary );
        }

        return $contactType;
    }

    public function getTypes(): array
    {
        $types = [];

        foreach( $this->types as $type => $primary )
        {
            $types[] = [
                'type' => $type,
                'primary' => $primary
            ];
        }

        return $types;
    }

    public function getContactTypes(): array
    {
        return [
            self::CONTACTTYPE_ADMIN,
            self::CONTACTTYPE_TECH,
            self::CONTACTTYPE_BILLING
        ];
    }

    public function enableAdmin( bool $primary = false )
    {
        $this->types[self::CONTACTTYPE_ADMIN] = $primary;
    }

    public function disableAdmin( )
    {
        if( isset( $this->types[self::CONTACTTYPE_ADMIN] ) )
            unset( $this->types[self::CONTACTTYPE_ADMIN]);
    }

    public function enableTech( bool $primary = false )
    {
        $this->types[self::CONTACTTYPE_TECH] = $primary;
    }

    public function disableTech( )
    {
        if( isset( $this->types[self::CONTACTTYPE_TECH] ) )
            unset( $this->types[self::CONTACTTYPE_TECH]);
    }

    public function enableBilling( bool $primary = false )
    {
        $this->types[self::CONTACTTYPE_TECH] = $primary;
    }

    public function disableBilling( )
    {
        if( isset( $this->types[self::CONTACTTYPE_BILLING] ) )
            unset( $this->types[self::CONTACTTYPE_BILLING]);
    }

}
