<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Contact
{
    protected string $id;

    protected string $firstName;

    protected string $lastName;

    protected string $email;

    protected string $phone;

    protected string $phoneCountryCode;

    protected string $phoneNumber;

    protected Carbon $createdDate;

    protected array $types;

    public static function createFromBody( string $body )
    {
        $json = json_decode( $body );

        $collection = new Collection();

        foreach( $json->content as $contact )
        {
            $collection->add( Contact::parseContact( $contact ) );
        }

        return $collection;
    }

    public static function parseContact( object $data ): Contact
    {
        return (new Contact())
            ->setId( $data->id )
            ->setFirstName($data->firstName )
            ->setLastName($data->lastName )
            ->setEmail($data->email)
            ->setPhone($data->phone)
            ->setPhoneCountryCode($data->phoneCountryCode)
            ->setPhoneNumber($data->phoneNumber)
            ->setcreatedDate($data->createdDate)
            ->setTypes( $data->types );
    }

    /**
     * @param mixed $id
     * @return Contact
     */
    public function setId($id): Contact
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

    /**
     * @param mixed $firstName
     * @return Contact
     */
    public function setFirstName($firstName): Contact
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $lastName
     * @return Contact
     */
    public function setLastName($lastName): Contact
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $email
     * @return Contact
     */
    public function setEmail($email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $phone
     * @return Contact
     */
    public function setPhone($phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phoneCountryCode
     * @return Contact
     */
    public function setPhoneCountryCode($phoneCountryCode): Contact
    {
        $this->phoneCountryCode = $phoneCountryCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneCountryCode()
    {
        return $this->phoneCountryCode;
    }

    /**
     * @param mixed $createdDate
     * @return Contact
     */
    public function setCreatedDate($createdDate): Contact
    {
        if( gettype($createdDate) == "string" )
            $createdDate = Carbon::parse( $createdDate );

        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $types
     * @return Contact
     */
    public function setTypes($types): Contact
    {
        $this->types = $types;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param mixed $phoneNumber
     * @return Contact
     */
    public function setPhoneNumber($phoneNumber): Contact
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

}
