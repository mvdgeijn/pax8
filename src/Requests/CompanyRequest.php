<?php

namespace Mvdgeijn\Pax8\Requests;

use Illuminate\Support\Collection;
use Mvdgeijn\Pax8\Responses\Company;

class CompanyRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of all your companies filtered by optional parameters
     *
     * Check https://docs.pax8.com/api/v1#operation/findCompanies for possible
     * options
     *
     * @param array $options
     * @return Collection|null
     */
    public function list(array $options = [] ): ?Collection
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
     */
    public function get(string $companyId ): ?Company
    {
        $response = $this->getRequest('/v1/companies/' . $companyId );

        if ($response->getStatusCode() == 200)
            return Company::parseCompany(json_decode( $response->getBody() ) );
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
     */
    public function create(Company $company ): ?Company
    {
        $response = $this->getRequest('/v1/companies', $company->createCompany() );

        if ($response->getStatusCode() == 200)
            return Company::parseCompany(json_decode( $response->getBody() ) );
        else
            return null;
    }
}
