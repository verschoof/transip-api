Wrapper of the transip API


###Symfony2
Do you want to use the TransIp API in your symfony2 project?

https://github.com/verschoof/transip-api-bundle

Installation
============

composer.json
```json
"require": {
  ...
  "verschoof/transip-api": "1.1.0"
}
```

Run `composer update verschoof/transip-api-bundle`

Usage
======

```php
$login      = ''; // Your login at transip
$privateKey = ''; // Your key from transip

$client = new Transip\Client($login, $privateKey, true);

$domainApi  = $client->api('domain');
$domainInfo = $domainApi->getInfo('domain.com'); 
// This returns an exception if the domain cannot be found !
// So it might be wise to do it in a try catch instruction
$status = $domainApi->checkAvailability(); 
// returns the string FREE if the domain is available
```

Tips
====

Do not use batchCheckAvailability in a loop, as it will break out with an error.
batchCheckAvailability only allows 20 records in the array.

TransIP is aware of this issue and they will update that in a next release.

Laravel
=======

This package is succesfully tested on the Laravel 4.1 Framework
However there is no ServiceProvider for it, just use the example in the usage section.
Advice is ofcourse to create a config-file for your tranip-api-credentials.

TransIp API documentation:
==========================

https://api.transip.nl/docs/
