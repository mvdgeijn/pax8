# Pax8

A PHP library for Pax8 Integration.
Use the Pax8 Rest API to have your PHP application communicate directly with your Pax8 account.

## Installation

Install this Pax8 PHP library with Composer:

```bash
composer require 'mvdgeijn/pax8'
```

## .env

You can get your developer credentials from the Pax8 panel: https://docs.pax8.com/api/v1#section/Create-a-Developer-Application

Added the credentials to your project .env file:

PAX8_CLIENT_ID=<your client id>

PAX8_CLIENT_SECRET=<your client secret>

These credentials are used to get your access token.

## Usage

```php
$accessToken = ( new AccessTokenRequest() )->getAccessToken();

$companies = $accessToken->companyRequest();

$list = $companies->list();

$company = $companies->get( $list[0]->getId() );

$contacts = $accessToken->contactRequest();

$list = $contacts->list( $company->getId() );

$contact = $contacts->get( $company->getId(), $list[0]->getId() );
```

## Links

* [Pax8 API documentation](https://docs.pax8.com/api/v1)

## Authors

* [bHosted](https://www.bhosted.nl/)
* [mvdgeijn](https://www.vdgeijn.com/)
