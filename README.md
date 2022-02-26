# Pax8

A Laravel library for Pax8 Integration.
Use the Pax8 Rest API to have your Laravel application communicate directly with your Pax8 account.

## Installation

Install this Pax8 PHP library with Composer:

```bash
composer require 'mvdgeijn/pax8'
```

## Alias

In the config\app.php file add the following line to the 'aliases' array

```php
'Pax8' => Mvdgeijn\Pax8\Facades\Pax8::class,
```

## .env

You can get your developer credentials from the Pax8 panel: https://docs.pax8.com/api/v1#section/Create-a-Developer-Application

Add the credentials to your project .env file. These credentials are used to get an access token. This access token is valid for 24h, so
it's recommended to store it and renew it within 24h. Check also the Events section below.

PAX8_CLIENT_ID="your client id"

PAX8_CLIENT_SECRET="your client secret"

The requested access token is stored in and requested from the default cache. 

## Usage

```php
$companies = Pax8::companyRequest();

$list = $companies->list();

$company = $companies->get( $list[0]->getId() );

$contacts = Pax8::contactRequest();

$list = $contacts->list( $company->getId() );

$contact = $contacts->get( $company->getId(), $list[0]->getId() );
```

## Events

This package fires one event: Mvdgeijn/Pax8/Pax8AccessTokenCreatedEvent. This event can be used to store
the newly created AccessToken somewhere.

```php
namespace App\Listeners;

use Mvdgeijn\Pax8\Events\Pax8AccessTokenCreatedEvent;

class Pax8AccessTokenCreatedListener
{
    public function handle(Pax8AccessTokenCreatedEvent $event)
    {
        //
        // The new accessToken object can be access using $event->accessToken
        //
        // Store $event->accessToken->accessToken and $event->accessToken->expiryTimestamp
        // for later usage
        //
    }
}
```

## Need to knows

During the development of this package I ran into some pitfalls. Here a tip to hopefully save you some time.

- When creating an order request, you have to add one lineItem to the array of lineItems for each product you order. For each lineItem there is a required provisioning details array. Each product has it's own provisioning details, which you can get using the productRequest()->getProvisioningDetails() request.

## Supported resources

| Component     |       Fetch all       |     Fetch single      |       Create        |        Update         |        delete         |
|---------------|:---------------------:|:---------------------:|:-------------------:|:---------------------:|:---------------------:|
| AccessToken   |  :white_check_mark:   |      :no_entry:       |     :no_entry:      |      :no_entry:       |      :no_entry:       |
| Companies     |  :white_check_mark:   |  :white_check_mark:   | :white_check_mark:  |      :no_entry:       |      :no_entry:       |
| Contacts      |  :white_check_mark:   |  :white_check_mark:   | :white_check_mark:  |  :white_check_mark:   | :black_square_button: | 
| Products      |  :white_check_mark:   |  :white_check_mark:   |     :no_entry:      |      :no_entry:       |      :no_entry:       |
| Orders        |  :white_check_mark:   |  :white_check_mark:   | :white_check_mark:  |      :no_entry:       |      :no_entry:       |
| Subscriptions |  :white_check_mark:   |  :white_check_mark:   |     :no_entry:      | :black_square_button: | :black_square_button: |
| Invoices      |  :white_check_mark:   |  :white_check_mark:   |     :no_entry:      |      :no_entry:       |      :no_entry:       |
| Usage         | :black_square_button: | :black_square_button: |     :no_entry:      |      :no_entry:       |      :no_entry:       |

## Links

* [Pax8 API documentation](https://docs.pax8.com/api/v1)

## Authors

* [bHosted](https://www.bhosted.nl/)
* [mvdgeijn](https://www.vdgeijn.com/)
