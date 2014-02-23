transip-api
===========

Wrapper of the transip API


Useage:

```php
$login      = ''; // Your login at transip
$privateKey = ''; // Your key from transip

$client = new Transip\Client($login, $privateKey, true);

$domainApi = $client->api('domain');

$domainInfo = $domainApi->getInfo('domain.com');

```

