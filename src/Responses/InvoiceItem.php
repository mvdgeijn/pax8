<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;

class InvoiceItem extends AbstractResponse
{
    protected string $type;

    protected string $purchaseOrderNumber;

    protected string $externalId;

    protected string $companyId;

    protected string $companyName;

    protected Carbon $startPeriod;

    protected Carbon $endPeriod;

    protected string $term;

    protected string $sku;

    protected string $description;

    protected string $quantity;

    protected string $unitOfMeasure;

    protected string $rateType;

    protected string $chargeType;

    protected string $price;

    protected string $subTotal;

    protected string $cost;

    protected string $costTotal;

    protected string $offeredBy;

    protected bool $billedByPax8;

    protected string $total;

    protected string $productId;

    protected string $productName;

    protected string $billingFee;

    protected string $billingFeeRate;

    protected string $amountDue;

    protected string $currencyCode;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return InvoiceItem
     */
    public function setType(string $type): InvoiceItem
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurchaseOrderNumber(): string
    {
        return $this->purchaseOrderNumber;
    }

    /**
     * @param string $purchaseOrderNumber
     * @return InvoiceItem
     */
    public function setPurchaseOrderNumber(string $purchaseOrderNumber): InvoiceItem
    {
        $this->purchaseOrderNumber = $purchaseOrderNumber;
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
     * @param string $companyId
     * @return InvoiceItem
     */
    public function setCompanyId(string $companyId): InvoiceItem
    {
        $this->companyId = $companyId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @return InvoiceItem
     */
    public function setCompanyName(string $companyName): InvoiceItem
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getStartPeriod(): Carbon
    {
        return $this->startPeriod;
    }

    /**
     * @param mixed $startPeriod
     * @return InvoiceItem
     */
    public function setStartPeriod($startPeriod): InvoiceItem
    {
        $this->startPeriod = self::getDate($startPeriod);
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getEndPeriod(): Carbon
    {
        return $this->endPeriod;
    }

    /**
     * @param mixed $endPeriod
     * @return InvoiceItem
     */
    public function setEndPeriod($endPeriod): InvoiceItem
    {
        $this->endPeriod = self::getDate($endPeriod);
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return InvoiceItem
     */
    public function setQuantity(string $quantity): InvoiceItem
    {
        $this->quantity = self::getAmount($quantity);
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitOfMeasure(): string
    {
        return $this->unitOfMeasure;
    }

    /**
     * @param string $unitOfMeasure
     * @return InvoiceItem
     */
    public function setUnitOfMeasure(string $unitOfMeasure): InvoiceItem
    {
        $this->unitOfMeasure = $unitOfMeasure;
        return $this;
    }

    /**
     * @return string
     */
    public function getRateType(): string
    {
        return $this->rateType;
    }

    /**
     * @param string $rateType
     * @return InvoiceItem
     */
    public function setRateType(string $rateType): InvoiceItem
    {
        $this->rateType = $rateType;
        return $this;
    }

    /**
     * @return string
     */
    public function getChargeType(): string
    {
        return $this->chargeType;
    }

    /**
     * @param string $chargeType
     * @return InvoiceItem
     */
    public function setChargeType(string $chargeType): InvoiceItem
    {
        $this->chargeType = $chargeType;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return InvoiceItem
     */
    public function setPrice(string $price): InvoiceItem
    {
        $this->price = self::getAmount($price );
        return $this;
    }

    /**
     * @return int
     */
    public function getSubTotal(): string
    {
        return $this->subTotal;
    }

    /**
     * @param int $subTotal
     * @return InvoiceItem
     */
    public function setSubTotal(string $subTotal): InvoiceItem
    {
        $this->subTotal = self::getAmount($subTotal );
        return $this;
    }

    /**
     * @return int
     */
    public function getCostTotal(): string
    {
        return $this->costTotal;
    }

    /**
     * @param int $costTotal
     * @return InvoiceItem
     */
    public function setCostTotal(string $costTotal): InvoiceItem
    {
        $this->costTotal = self::getAmount($costTotal);
        return $this;
    }

    /**
     * @return string
     */
    public function getOfferedBy(): string
    {
        return $this->offeredBy;
    }

    /**
     * @param string $offeredBy
     * @return InvoiceItem
     */
    public function setOfferedBy(string $offeredBy): InvoiceItem
    {
        $this->offeredBy = $offeredBy;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBilledByPax8(): bool
    {
        return $this->billedByPax8;
    }

    /**
     * @param bool $billedByPax8
     * @return InvoiceItem
     */
    public function setBilledByPax8(bool $billedByPax8): InvoiceItem
    {
        $this->billedByPax8 = $billedByPax8;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotal(): string
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return InvoiceItem
     */
    public function setTotal(string $total): InvoiceItem
    {
        $this->total = self::getAmount($total);
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
     * @param string $productId
     * @return InvoiceItem
     */
    public function setProductId(string $productId): InvoiceItem
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     * @return InvoiceItem
     */
    public function setProductName(string $productName): InvoiceItem
    {
        $this->productName = $productName;
        return $this;
    }

    /**
     * @return int
     */
    public function getBillingFee(): string
    {
        return $this->billingFee;
    }

    /**
     * @param int $billingFee
     * @return InvoiceItem
     */
    public function setBillingFee(string $billingFee): InvoiceItem
    {
        $this->billingFee = self::getAmount($billingFee );
        return $this;
    }

    /**
     * @return int
     */
    public function getBillingFeeRate(): string
    {
        return $this->billingFeeRate;
    }

    /**
     * @param int $billingFeeRate
     * @return InvoiceItem
     */
    public function setBillingFeeRate(string $billingFeeRate): InvoiceItem
    {
        $this->billingFeeRate = self::getAmount($billingFeeRate);
        return $this;
    }

    /**
     * @return int
     */
    public function getAmountDue(): string
    {
        return $this->amountDue;
    }

    /**
     * @param int $amountDue
     * @return InvoiceItem
     */
    public function setAmountDue(int $amountDue): InvoiceItem
    {
        $this->amountDue = self::getAmount($amountDue);
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     * @return InvoiceItem
     */
    public function setCurrencyCode(string $currencyCode): InvoiceItem
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @param string $externalId
     * @return InvoiceItem
     */
    public function setExternalId(string $externalId): InvoiceItem
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @param string $term
     * @return InvoiceItem
     */
    public function setTerm(string $term): InvoiceItem
    {
        $this->term = $term;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * @param string $sku
     * @return InvoiceItem
     */
    public function setSku(string $sku): InvoiceItem
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $description
     * @return InvoiceItem
     */
    public function setDescription(string $description): InvoiceItem
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $cost
     * @return InvoiceItem
     */
    public function setCost(string $cost): InvoiceItem
    {
        $this->cost = self::getAmount($cost);
        return $this;
    }

    /**
     * @return string
     */
    public function getCost(): string
    {
        return $this->cost;
    }
}
