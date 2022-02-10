<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Order extends AbstractResponse
{
    protected string $companyId;

    protected Carbon $createdDate;

    protected string $orderedBy;

    protected string $orderedByUserId;

    protected string $orderedByUserEmail;

    protected Collection $lineItems;

    public function createOrder(): array
    {
        return [
            'companyId' => $this->getCompanyId(),
            'lineItems' => $this->getLineItems()
        ];
    }

    /**
     * @param string $companyId
     * @return Order
     */
    public function setCompanyId(string $companyId): Order
    {
        $this->companyId = $companyId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * @param mixed $createdDate
     * @return Order
     */
    public function setCreatedDate($createdDate): Order
    {
        $this->createdDate = Order::getDate($createdDate);
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getCreatedDate(): Carbon
    {
        return $this->createdDate;
    }

    /**
     * @param string $orderedBy
     * @return Order
     */
    public function setOrderedBy(string $orderedBy): Order
    {
        $this->orderedBy = $orderedBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderedBy(): string
    {
        return $this->orderedBy;
    }

    /**
     * @param string $orderedByUserId
     * @return Order
     */
    public function setOrderedByUserId(string $orderedByUserId): Order
    {
        $this->orderedByUserId = $orderedByUserId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderedByUserId(): string
    {
        return $this->orderedByUserId;
    }

    /**
     * @param string $orderedByUserEmail
     * @return Order
     */
    public function setOrderedByUserEmail(string $orderedByUserEmail): Order
    {
        $this->orderedByUserEmail = $orderedByUserEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderedByUserEmail(): string
    {
        return $this->orderedByUserEmail;
    }

    /**
     * @param array $lineItems
     * @return Order
     */
    public function setLineItems(array $lineItems): Order
    {
        $this->lineItems = new Collection();

        foreach( $lineItems as $lineItem )
            $lineItem = OrderLine::parse( (object) $lineItem );
            $this->lineItems->add($lineItem);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getLineItems(): Collection
    {
        return $this->lineItems;
    }
}
