<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Responses\AbstractResponse;
use Mvdgeijn\Pax8\Responses\Invoice;
use Mvdgeijn\Pax8\Responses\InvoiceItem;

class InvoiceRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of all your invoices filtered by optional parameters
     *
     * Check https://docs.pax8.com/api/v1#tag/Invoices for possible
     * options
     *
     * @param array $options
     * @return PaginatedCollection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $options = [] ): ?PaginatedCollection
    {
        $response = $this->getRequest( '/v1/invoices', $options );

        if ($response->getStatusCode() == 200)
            return Invoice::createFromBody( $response->getBody() );
        else
            return null;
    }

    /**
     * Returns a single invoice record matching the invoiceId you specify
     *
     * @param string $invoiceId
     * @return Invoice|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function get(string $invoiceId): ?Invoice
    {
        $response = $this->getRequest('/v1/invoices/' . $invoiceId);

        if ($response->getStatusCode() == 200)
            return Invoice::parse(json_decode($response->getBody()));
        else
            return null;
    }

    /**
     * Returns a paginated list of all your invoice items filtered by invoiceId
     * and optional parameters
     *
     * Check https://docs.pax8.com/api/v1#operation/findPartnerInvoiceItems
     * for possible options
     *
     * @param array $options
     * @return PaginatedCollection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listItems(string $invoiceId, array $options = []): ?PaginatedCollection
    {
        $response = $this->getRequest( "/v1/invoices/$invoiceId/items", $options );

        if ($response->getStatusCode() == 200)
            return InvoiceItem::createFromBody( $response->getBody() );
        else
            return null;
    }

}
