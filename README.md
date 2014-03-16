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

Useage
======

```php
$login      = ''; // Your login at transip
$privateKey = ''; // Your key from transip

$client = new Transip\Client($login, $privateKey, true);

$domainApi  = $client->api('domain');
$domainInfo = $domainApi->getInfo('domain.com');

```

TransIp API documentation:
==========================

https://api.transip.nl/docs/
