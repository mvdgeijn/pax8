<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;

class OrderLine extends AbstractResponse
{
    public string $productId;

    public string $subscriptionId;

    public string $provisionStartDate;

    public array $provisioningDetails;

    public string $billingTerm;

    public string $commitmentTermId;

    public int $quantity;

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
        $this->provisionStartDate = $provisionStartDate->toDateString();
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getProvisionStartDate(): string
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
     * @param string $commitmentTermId
     * @return $this
     */
    public function setCommitmentTermId(string $commitmentTermId): OrderLine
    {
        $this->commitmentTermId = $commitmentTermId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommitmentTermId(): string
    {
        return $this->commitmentTermId;
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

    /**
     * @param string $key
     * @param string|array $values
     * @return $this
     */
    public function add(string $key, string|array $values ): OrderLine
    {
        $line = new \stdClass();
        $line->key = $key;
        $line->values = is_string( $values ) ? [$values] : $values;

        $this->provisioningDetails[] = $line;

        return $this;
    }
}
