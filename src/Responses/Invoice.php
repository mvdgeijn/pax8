<?php

namespace Mvdgeijn\Pax8\Responses;

use Carbon\Carbon;

class Invoice extends AbstractResponse
{
    protected int $total;

    protected ?string $companyId;

    protected ?string $externalId;

    protected string $balance;

    protected string $carriedBalance;

    protected string $status;

    protected Carbon $invoiceDate;

    protected Carbon $dueDate;

    protected string $partnerName;

    /**
     * @param int $total
     * @return Invoice
     */
    public function setTotal(int $total): Invoice
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param string $balance
     * @return Invoice
     */
    public function setBalance(string $balance): Invoice
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return string
     */
    public function getBalance(): string
    {
        return $this->balance;
    }

    /**
     * @param string $carriedBalance
     * @return Invoice
     */
    public function setCarriedBalance(string $carriedBalance): Invoice
    {
        $this->carriedBalance = $carriedBalance;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarriedBalance(): string
    {
        return $this->carriedBalance;
    }

    /**
     * @param string $status
     * @return Invoice
     */
    public function setStatus(string $status): Invoice
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param mixed $invoiceDate
     * @return Invoice
     */
    public function setInvoiceDate($invoiceDate): Invoice
    {
        $this->invoiceDate = self::getDate( $invoiceDate );
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getInvoiceDate(): Carbon
    {
        return $this->invoiceDate;
    }

    /**
     * @param Carbon $dueDate
     * @return Invoice
     */
    public function setDueDate($dueDate): Invoice
    {
        $this->dueDate = self::getDate( $dueDate );
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDueDate(): Carbon
    {
        return $this->dueDate;
    }

    /**
     * @param string $partnerName
     * @return Invoice
     */
    public function setPartnerName(string $partnerName): Invoice
    {
        $this->partnerName = $partnerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerName(): string
    {
        return $this->partnerName;
    }

    /**
     * @param ?string $companyId
     * @return Invoice
     */
    public function setCompanyId(?string $companyId): Invoice
    {
        $this->companyId = $companyId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    /**
     * @param string|null $externalId
     * @return Invoice
     */
    public function setExternalId(?string $externalId): Invoice
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }
}
