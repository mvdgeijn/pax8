<?php

namespace Mvdgeijn\Pax8\Requests;

use Illuminate\Support\Collection;
use Mvdgeijn\Pax8\Responses\Company;
use Mvdgeijn\Pax8\Responses\Contact;

class ContactRequest extends AbstractRequest
{
    public function list( string $companyId ): ?Collection
    {
        $response = $this->getRequest( "/v1/companies/$companyId/contacts");

        if ($response->getStatusCode() == 200)
            return Contact::createFromBody( $response->getBody() );
        else
            return null;
    }

    public function get( string $companyId, string $contactId ): ?Contact
    {
        $response = $this->getRequest("/v1/companies/$companyId/contacts/$contactId" );

        if ($response->getStatusCode() == 200)
            return Contact::parseContact(json_decode( $response->getBody() ) );
        else
            return null;

    }
}
