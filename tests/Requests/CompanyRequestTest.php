<?php

namespace Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Facades\Pax8;
use Mvdgeijn\Pax8\Requests\CompanyRequest;
use Mvdgeijn\Pax8\Responses\Company;
use Tests\TestCase;

class CompanyRequestTest extends TestCase
{
    public function testCompanyRequest()
    {
        $companyRequest = Pax8::companyRequest();

        $this->assertTrue( get_class( $companyRequest ) == CompanyRequest::class );
    }

    public function testCompanyResponse()
    {
        $companyRequest = Pax8::companyRequest();

        $companies = $companyRequest->list();

        $this->assertTrue( get_class( $companies ) === PaginatedCollection::class );

        $this->assertTrue( $companies->getSize() > 0 );
        $this->assertTrue( $companies->getTotalElements() > 0 );
        $this->assertTrue( $companies->getTotalPages() > 0 );

        $company = $companies->get( 0 );

        $this->assertTrue( get_class( $company ) === Company::class );
    }
}
