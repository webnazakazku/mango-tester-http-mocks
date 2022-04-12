Mango Tester nette/http mocks
======
[![Build Status](https://github.com/webnazakazku/mango-tester-http-mocks/actions/workflows/main.yaml/badge.svg)](https://github.com/webnazakazku/mango-tester-http-mocks/actions/workflows/main.yaml)


Installation
----

The recommended way to install is via Composer:

```
composer require webnazakazku/mango-tester-http-mocks
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
