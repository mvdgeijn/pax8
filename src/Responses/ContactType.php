<?php

namespace Mvdgeijn\Pax8\Responses;

Class ContactType
{
    const CONTACTTYPE_ADMIN = "Admin";

    const CONTACTTYPE_TECH = "Technical";

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

    public static function getContactTypes(): array
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

    public function isAdmin(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_ADMIN] );
    }

    public function isPrimaryAdmin(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_ADMIN] ) && $this->types[self::CONTACTTYPE_ADMIN] == true;
    }

    public function enableTechnical( bool $primary = false )
    {
        $this->types[self::CONTACTTYPE_TECH] = $primary;
    }

    public function disableTechnical( )
    {
        if( isset( $this->types[self::CONTACTTYPE_TECH] ) )
            unset( $this->types[self::CONTACTTYPE_TECH]);
    }

    public function isTechnical(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_TECH] );
    }

    public function isPrimaryTechnical(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_TECH] ) && $this->types[self::CONTACTTYPE_TECH] == true;
    }

    public function enableBilling( bool $primary = false )
    {
        $this->types[self::CONTACTTYPE_BILLING] = $primary;
    }

    public function disableBilling( )
    {
        if( isset( $this->types[self::CONTACTTYPE_BILLING] ) )
            unset( $this->types[self::CONTACTTYPE_BILLING]);
    }

    public function isBilling(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_BILLING] );
    }

    public function isPrimaryBilling(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_BILLING] ) && $this->types[self::CONTACTTYPE_BILLING] == true;
    }

}
