<?php

namespace Mvdgeijn\Pax8\Requests;

use Illuminate\Support\Collection;
use Mvdgeijn\Pax8\Responses\Company;

class CompanyRequest extends AbstractRequest
{
    public function list( $page = 1, $nrPerPage = 5, $sort = "name" ): ?Collection
    {
        $response = $this->getRequest( '/v1/companies', [
            "page" => $page,
            "size" => $nrPerPage,
            "sort" => $sort
        ]);

        if ($response->getStatusCode() == 200)
            return Company::createFromBody( $response->getBody() );
        else
            return null;
    }

    public function get( string $id ): ?Company
    {
        $response = $this->getRequest('/v1/companies/' . $id );

        if ($response->getStatusCode() == 200)
            return Company::parseCompany(json_decode( $response->getBody() ) );
        else
            return null;
    }

    public function create( Company $company ): ?Company
    {
        $response = $this->getRequest('/v1/companies', $company->createCompany() );

        if ($response->getStatusCode() == 200)
            return Company::parseCompany(json_decode( $response->getBody() ) );
        else
            return null;
    }
}
