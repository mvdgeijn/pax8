<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Responses\Company;

class CompanyRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of all your companies filtered by optional parameters
     *
     * Check link for possible options
     *
     * @link https://docs.pax8.com/api/v1#operation/findCompanies
     *
     * @param array $options
     * @return PaginatedCollection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $options = [] ): ?PaginatedCollection
    {
        $response = $this->getRequest( '/v1/companies', $options );

        if ($response->getStatusCode() == 200)
            return Company::createFromBody( $response->getBody() );
        else
            return null;
    }

    /**
     * Returns a single company record matching the companyId you specify
     *
     * @param string $companyId
     * @return Company|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $companyId ): ?Company
    {
        $response = $this->getRequest('/v1/companies/' . $companyId );

        if ($response->getStatusCode() == 200)
            return Company::parse(json_decode( $response->getBody() ) );
        else
            return null;
    }

    /**
     * Creates a new Company. The Company will be placed in an inactive status
     * until the Company has primary Contacts added
     *
     * Returns null if the company contains invalid data
     *
     * @param Company $company
     * @return Company|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(Company $company): ?Company
    {
        $response = $this->getRequest('/v1/companies', $company->toObject() );

        if ($response->getStatusCode() == 200)
            return Company::parse(json_decode( $response->getBody() ) );
        else
            return null;
    }
}
