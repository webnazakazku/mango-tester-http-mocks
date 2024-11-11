Mango Tester nette/http mocks
======
[![Build Status](https://github.com/webnazakazku/mango-tester-http-mocks/actions/workflows/main.yaml/badge.svg)](https://github.com/webnazakazku/mango-tester-http-mocks/actions/workflows/main.yaml)


Installation
----

The recommended way to install is via Composer:

```
composer require webnazakazku/mango-tester-http-mocks --dev
composer require dg/bypass-finals --dev
```

Usage
----

`tests/config/tests.neon`

```neon
extensions:
	mango.tester.httpMock: Webnazakazku\MangoTester\HttpMocks\Bridges\Infrastructure\HttpExtension

mango.tester.httpMock:
	baseUrl: 'https://test.dev'
	sessionMock: true #or false
```

`tests/bpotstrap.php`

```php
<?php declare(strict_types = 1);


require __DIR__ . '/../vendor/autoload.php';

DG\BypassFinals::enable(); //required

$configurator = new Nette\Bootstrap\Configurator();
...
```
