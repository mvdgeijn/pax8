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

## Supported resources

| Component     |       Fetch all       |     Fetch single      |        Create         |        Update         |        delete         |
|---------------|:---------------------:|:---------------------:|:---------------------:|:---------------------:|:---------------------:|
| AccessToken   |  :white_check_mark:   |      :no_entry:       |      :no_entry:       |      :no_entry:       |      :no_entry:       |
| Companies     |  :white_check_mark:   |  :white_check_mark:   |  :white_check_mark:   |      :no_entry:       |      :no_entry:       |
| Contacts      |  :white_check_mark:   |  :white_check_mark:   | :black_square_button: | :black_square_button: | :black_square_button: | 
| Products      | :black_square_button: | :black_square_button: |      :no_entry:       |      :no_entry:       |      :no_entry:       |
| Orders        | :black_square_button: | :black_square_button: | :black_square_button: |      :no_entry:       |      :no_entry:       |
| Subscriptions | :black_square_button: | :black_square_button: |      :no_entry:       | :black_square_button: | :black_square_button: |
| Invoices      | :black_square_button: | :black_square_button: |      :no_entry:       |      :no_entry:       |      :no_entry:       |
| Usage         | :black_square_button: | :black_square_button: |      :no_entry:       |      :no_entry:       |      :no_entry:       |

## Links

* [Pax8 API documentation](https://docs.pax8.com/api/v1)

## Authors

* [bHosted](https://www.bhosted.nl/)
* [mvdgeijn](https://www.vdgeijn.com/)
