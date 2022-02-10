# Pax8

A Laravel library for Pax8 Integration.
Use the Pax8 Rest API to have your Laravel application communicate directly with your Pax8 account.

## Installation

Install this Pax8 PHP library with Composer:

```bash
composer require 'mvdgeijn/pax8'
```

## .env

You can get your developer credentials from the Pax8 panel: https://docs.pax8.com/api/v1#section/Create-a-Developer-Application

Add the credentials to your project .env file. These credentials are used to get an access token. This access token is valid for 24h, so
it's recommended to store it and renew it within 24h.

PAX8_CLIENT_ID="your client id"

PAX8_CLIENT_SECRET="your client secret"

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
| Products      |  :white_check_mark:   |  :white_check_mark:   |      :no_entry:       |      :no_entry:       |      :no_entry:       |
| Orders        |  :white_check_mark:   |  :white_check_mark:   |  :white_check_mark:   |      :no_entry:       |      :no_entry:       |
| Subscriptions |  :white_check_mark:   |  :white_check_mark:   |      :no_entry:       | :black_square_button: | :black_square_button: |
| Invoices      |  :white_check_mark:   |  :white_check_mark:   |      :no_entry:       |      :no_entry:       |      :no_entry:       |
| Usage         | :black_square_button: | :black_square_button: |      :no_entry:       |      :no_entry:       |      :no_entry:       |

## Links

* [Pax8 API documentation](https://docs.pax8.com/api/v1)

## Authors

* [bHosted](https://www.bhosted.nl/)
* [mvdgeijn](https://www.vdgeijn.com/)
