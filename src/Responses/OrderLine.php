<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;

class OrderLine extends AbstractResponse
{
    protected string $productId;

    protected string $subscriptionId;

    protected Carbon $provisionStartDate;

    protected string $billingTerm;

    protected int $quantity;

    public static function parse( object $item ): OrderLine
    {
        $orderLine = new OrderLine();

        $orderLine
            ->setId($item->id)
            ->setProductId($item->productId )
            ->setSubscriptionId($item->subscriptionId)
            ->setProvisionStartDate($item->provisionStartDate)
            ->setBillingTerm($item->billingTerm)
            ->setQuantity($item->quantity);

        return $orderLine;
    }

    /**
     * @param string $productId
     * @return OrderLine
     */
    public function setProductId(string $productId): OrderLine
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $subscriptionId
     * @return OrderLine
     */
    public function setSubscriptionId(string $subscriptionId): OrderLine
    {
        $this->subscriptionId = $subscriptionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

    /**
     * @param Carbon $provisionStartDate
     * @return OrderLine
     */
    public function setProvisionStartDate(Carbon $provisionStartDate): OrderLine
    {
        $this->provisionStartDate = $provisionStartDate;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getProvisionStartDate(): Carbon
    {
        return $this->provisionStartDate;
    }

    /**
     * @param string $billingTerm
     * @return OrderLine
     */
    public function setBillingTerm(string $billingTerm): OrderLine
    {
        $this->billingTerm = $billingTerm;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingTerm(): string
    {
        return $this->billingTerm;
    }

    /**
     * @param int $quantity
     * @return OrderLine
     */
    public function setQuantity(int $quantity): OrderLine
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
