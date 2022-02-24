<?php

namespace Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Facades\Pax8;
use Mvdgeijn\Pax8\Requests\ContactRequest;
use Mvdgeijn\Pax8\Responses\Company;
use Mvdgeijn\Pax8\Responses\Contact;
use Tests\TestCase;

class ContactRequestTest extends TestCase
{
    public function testContactRequest()
    {
        $contactRequest = Pax8::contactRequest();

        $this->assertTrue( get_class( $contactRequest ) == ContactRequest::class );
    }

    public function testContactResponse()
    {
        $companyRequest = Pax8::companyRequest();

        $companies = $companyRequest->list();

        $this->assertTrue( get_class( $companies ) === PaginatedCollection::class );

        $company = $companies->get( 0 );

        $this->assertTrue( get_class( $company ) === Company::class );

        $contactRequest = Pax8::contactRequest();

        $contacts = $contactRequest->list( $company->getId() );

        $contact = $contacts->get( 0 );

        $this->assertTrue(get_class( $contact ) === Contact::class);
    }
}
