<p align="center"><a href="https://vptrading.et"><img src="/src/imgs/logo.png" alt="VP Logo"></a></p>

<h1 align="center">Laravel Package For<br> Safaricom USSD</h1>

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

This Laravel package is a featherweight package to integrate Safaricom MPesa.

## Installation

Via Composer

```bash
composer require vptrading/safaricom-ussd
```

Run the artisan command to publish the Vptrading\SafaricomUssd configuration file.

```bash
php artisan vendor:publish --provider="Vptrading\SafaricomUssd\SafaricomUssdServiceProvider"
```

## Usage

### Send Push

In order to send a buy request using MPesa all you have to do is import the SafaricomUssd Facade where you want to use it and call the push method. The SafaricomUssd::push() method accepts five parameters, these are: Amount, Phone, Reference Number, a `nullable` Description and `nullable` array of ReferenceData (Refer to the Safaricom MPesa Documentation for the description of ReferenceData).

**Example**

```php
use Vptrading\SafaricomUssd\Facades\SafaricomUssd;

$response = SafaricomUssd::push(1, '0912345678', 'VP_212fw323r3', 'Pay for Good', "ReferenceData":[
    {
        "Key": "CashierName",
        "Value": "Test User"
    },
    {
        "Key": "CashierNumber",
        "Value": "251712121212"
    },
    {
        "Key": "CustomerTINNumber",
        "Value": "0012345678"
    }
]);
```

When calling the method if successful, it will respond with the following.

**Example**

```json
{
    "MerchantRequestID": "850ee93b",
    "CheckoutRequestID": "ws_CO_1710202417354636158753",
    "ResponseCode": "0",
    "ResponseDescription": "Request accepted for processing",
    "CustomerMessage": "Request accepted for processing"
}
```

### Deconstruct Callback Data

The next is being notified when a payment is successful. After the user has paid the amount described, Safaricom MPesa will send you a notification on the Result URL you specified in the safaricom-uss.php config file.

**Example Data**

```json
{"Envelope":{"Body":{"stkCallback":{"MerchantRequestID":"b36272fa","CheckoutRequestID":"ws_CO_1710202412231281053980","ResultCode":3002,"ResultDesc":"No response from user.","CallbackMetadata":{"Item":[{"Name":"MpesaReceiptNumber"},{"Name":"Amount"},{"Name":"TransactionDate"},{"Name":"PhoneNumber","Value":251777713780}]}}}}}
```

In order to decode this, the package provides a `SafaricomUssd::deconstruct()` method. All you need to do is put the notification string sent from Safaricom MPesa in to that method and it will be decoded.

**Example**

```php
use Vptrading\SafaricomUssd\Facades\SafaricomUssd;

$decoded = SafaricomUssd::deconstruct('{"Envelope":{"Body":{"stkCallback":{"MerchantRequestID":"b36272fa","CheckoutRequestID":"ws_CO_1710202412231281053980","ResultCode":3002,"ResultDesc":"No response from user.","CallbackMetadata":{"Item":[{"Name":"MpesaReceiptNumber"},{"Name":"Amount"},{"Name":"TransactionDate"},{"Name":"PhoneNumber","Value":251777713780}]}}}}}');
```

**Result**

```php
array (
  'Envelope' => 
  array (
    'Body' => 
    array (
      'stkCallback' => 
      array (
        'MerchantRequestID' => '41ec1de4',
        'CheckoutRequestID' => 'ws_CO_1710202416562907417583',
        'ResultCode' => 0,
        'ResultDesc' => 'The service request is processed successfully.',
        'CallbackMetadata' => 
        array (
          'Item' => 
          array (
            0 => 
            array (
              'Name' => 'MpesaReceiptNumber',
              'Value' => 'SJH9BVRIO3',
            ),
            1 => 
            array (
              'Name' => 'Amount',
              'Value' => 1.0,
            ),
            2 => 
            array (
              'Name' => 'TransactionDate',
              'Value' => 20241017165717,
            ),
            3 => 
            array (
              'Name' => 'PhoneNumber',
              'Value' => 251777713780,
            ),
          ),
        ),
      ),
    ),
  ),
)
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email dev@vptrading.et instead of using the issue tracker.

## Credits

- [Alazar Kassahun][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/vptrading/safaricom-ussd.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/vptrading/safaricom-ussd.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/vptrading/safaricom-ussd/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/vptrading/safaricom-ussd
[link-downloads]: https://packagist.org/packages/vptrading/safaricom-ussd
[link-author]: https://github.com/vptrading
[link-contributors]: ../../contributors

🚀 And that's it. Do your thing and Give us a star if this helped you.🚀
