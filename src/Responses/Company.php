<?php

namespace Mvdgeijn\Pax8\Responses;

class Company extends AbstractResponse
{
    protected string $name;

    protected string $street;

    protected string $city;

    protected string $zipcode;

    protected string $country;

    protected string $phone;

    protected string $website;

    protected string $status;

    protected bool $billOnBehalfOfEnabled = false;

    protected bool $selfServiceAllowed = false;

    protected bool $orderApprovalRequired = false;

    protected ?string $externalId = null;

    public function createCompany( ): array
    {
        return [
            'name' => $this->getName(),
            'address' => [
                'street' => $this->getStreet(),
                'city' => $this->getCity(),
                'postalCode' => $this->getZipcode(),
                'country' => $this->getCountry()
            ],
            'phone' => $this->getPhone(),
            'website' => $this->getWebsite(),
            'externalId' => $this->getExternalId(),
            'billOnBehalfOfEnabled' => $this->isBillOnBehalfOfEnabled(),
            'selfServiceAllowed' => $this->isSelfServiceAllowed(),
            'orderApprovalRequired' => $this->isOrderApprovalRequired()
        ];
    }

    public function setAddress( $address )
    {
        $this->setStreet( $address->street );
        $this->setCity( $address->city );
        $this->setZipcode( $address->postalCode );
        $this->setCountry( $address->country );
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

    /**
     * @param string|null $externalId
     * @return Company
     */
    public function setExternalId(?string $externalId): Company
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * @return string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @param bool $selfServiceAllowed
     * @return Company
     */
    public function setSelfServiceAllowed(bool $selfServiceAllowed): Company
    {
        $this->selfServiceAllowed = $selfServiceAllowed;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSelfServiceAllowed(): bool
    {
        return $this->selfServiceAllowed;
    }

    /**
     * @param string $phone
     * @return Company
     */
    public function setPhone(string $phone): Company
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }


}
