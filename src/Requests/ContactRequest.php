<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Responses\Contact;

class ContactRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of contacts ordered by createDate descending
     *
     * Possible options:
     * - page (default 0): The page number of the request for in the contacts list
     * - size (default 10): number of contacts per page
     *
     * Returns null if company not found
     *
     * @param string $companyId
     * @param array $options
     * @return PaginatedCollection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(string $companyId, array $options = [] ): ?PaginatedCollection
    {
        $response = $this->getRequest("/v1/companies/$companyId/contacts", $options);

        if ($response->getStatusCode() == 200)
            return Contact::createFromBody( $response->getBody() );
        else
            return null;
    }

    /**
     * Returns a contact, identified by the companyId and contactId. Returns null
     * if companyId and/or contactId not found
     *
     * @param string $companyId
     * @param string $contactId
     * @return Contact|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $companyId, string $contactId ): ?Contact
    {
        $response = $this->getRequest("/v1/companies/$companyId/contacts/$contactId" );

        if ($response->getStatusCode() == 200)
            return Contact::parse(json_decode( $response->getBody() ) );
        else
            return null;
    }

    /**
     * Creates a new Contact. Returns a new Contact object when successfully created,
     * or null if company not found or invalid contact information is passed.
     *
     * @param Contact $contact
     * @return Contact|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(string $companyId, Contact $contact): ?Contact
    {
        $response = $this->postRequest("/v1/companies/$companyId/contacts", $contact->toObject() );

        if ($response->getStatusCode() == 200)
            return Contact::parse(json_decode( $response->getBody() ) );
        else
            return null;

    }

    /**
     * Updates an existing contact. Returns a new Contact object when successfully updated,
     * or null if contact not updated or invalid contact information is passed
     *
     * @param string $companyId
     * @param Contact $contact
     * @return Contact|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(string $companyId, Contact $contact): ?Contact
    {
        $contactId = $contact->getId();
        $response = $this->putRequest("/v1/companies/$companyId/contacts/$contactId", $contact->toObject() );

        if ($response->getStatusCode() == 200)
            return Contact::parse(json_decode( $response->getBody() ) );
        else
            return null;
    }

}
