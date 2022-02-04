<?php

namespace Mvdgeijn\Pax8\Responses;

use Illuminate\Support\Collection;

class Company
{
    protected string $id;

    protected string $name;

    protected string $street;

    protected string $city;

    protected string $zipcode;

    protected string $country;

    protected string $website;

    protected string $status;

    protected bool $billOnBehalfOfEnabled = false;

    protected bool $orderApprovalRequired = false;


    public static function createFromBody( string $body )
    {
        $json = json_decode( $body );

        $collection = new Collection();

        foreach( $json->content as $company )
        {
            $collection->add( Company::parseCompany( $company ) );
        }

        return $collection;
    }

    public static function parseCompany( object $data ): Company
    {
        return (new Company())
            ->setId($data->id)
            ->setName($data->name)
            ->setStreet($data->address->street)
            ->setCity($data->address->city)
            ->setZipcode($data->address->postalCode)
            ->setCountry($data->address->country)
            ->setWebsite($data->website)
            ->setStatus($data->status)
            ->setBillOnBehalfOfEnabled($data->billOnBehalfOfEnabled)
            ->setOrderApprovalRequired($data->orderApprovalRequired);
    }

    /**
     * @param mixed $id
     * @return Company
     */
    public function setId($id): Company
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
     * @param mixed $name
     * @return Company
     */
    public function setName($name): Company
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $street
     * @return Company
     */
    public function setStreet($street): Company
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $city
     * @return Company
     */
    public function setCity($city): Company
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $zipcode
     * @return Company
     */
    public function setZipcode($zipcode): Company
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $country
     * @return Company
     */
    public function setCountry($country): Company
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $status
     * @return Company
     */
    public function setStatus($status): Company
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $billOnBehalfOfEnables
     * @return Company
     */
    public function setBillOnBehalfOfEnabled(bool $billOnBehalfOfEnables): Company
    {
        $this->billOnBehalfOfEnabled = $billOnBehalfOfEnables;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBillOnBehalfOfEnabled(): bool
    {
        return $this->billOnBehalfOfEnabled;
    }

    /**
     * @param bool $orderApprovalRequired
     * @return Company
     */
    public function setOrderApprovalRequired(bool $orderApprovalRequired): Company
    {
        $this->orderApprovalRequired = $orderApprovalRequired;

        return $this;
    }

    /**
     * @return bool
     */
    public function isOrderApprovalRequired(): bool
    {
        return $this->orderApprovalRequired;
    }

    /**
     * @param mixed $website
     * @return Company
     */
    public function setWebsite($website): Company
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }


}
