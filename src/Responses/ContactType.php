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

    public function enableAdmin( bool $primary = false ): static
    {
        $this->types[self::CONTACTTYPE_ADMIN] = $primary;

        return $this;
    }

    public function disableAdmin( ): static
    {
        if( isset( $this->types[self::CONTACTTYPE_ADMIN] ) )
            unset( $this->types[self::CONTACTTYPE_ADMIN]);

        return $this;
    }

    public function isAdmin(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_ADMIN] );
    }

    public function isPrimaryAdmin(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_ADMIN] ) && $this->types[self::CONTACTTYPE_ADMIN] == true;
    }

    public function enableTechnical( bool $primary = false ): static
    {
        $this->types[self::CONTACTTYPE_TECH] = $primary;

        return $this;
    }

    public function disableTechnical( ): static
    {
        if( isset( $this->types[self::CONTACTTYPE_TECH] ) )
            unset( $this->types[self::CONTACTTYPE_TECH]);

        return $this;
    }

    public function isTechnical(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_TECH] );
    }

    public function isPrimaryTechnical(): bool
    {
        return isset( $this->types[self::CONTACTTYPE_TECH] ) && $this->types[self::CONTACTTYPE_TECH] == true;
    }

    public function enableBilling( bool $primary = false ): static
    {
        $this->types[self::CONTACTTYPE_BILLING] = $primary;

        return $this;
    }

    public function disableBilling( ): static
    {
        if( isset( $this->types[self::CONTACTTYPE_BILLING] ) )
            unset( $this->types[self::CONTACTTYPE_BILLING]);

        return $this;
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
