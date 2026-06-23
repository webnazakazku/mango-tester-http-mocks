<?php declare(strict_types = 1);

namespace Webnazakazku\MangoTester\HttpMocks\Bridges\Infrastructure;

use Nette\DI\ContainerBuilder;
use Nette\DI\Definitions\ServiceDefinition;
use Nette\DI\Definitions\Statement;
use Nette\Http\Request;
use Nette\Http\UrlScript;
use Webnazakazku\MangoTester\HttpMocks\HttpRequest;
use Webnazakazku\MangoTester\HttpMocks\Session;
use Webnazakazku\MangoTester\Infrastructure\Container\AppContainerHook;

class HttpMocksContainerHook extends AppContainerHook
{

	private string $baseUrl;

	private bool $sessionMock;

	public function __construct(string $baseUrl, bool $sessionMock)
	{
		$this->baseUrl = $baseUrl;
		$this->sessionMock = $sessionMock;
	}

	public function onCompile(ContainerBuilder $builder): void
	{
		if ($builder->hasDefinition('http.request')) {
			$definition = $builder->getDefinition('http.request');
			if ($definition instanceof ServiceDefinition) {
				$definition
					->setType(Request::class)
					->setFactory(HttpRequest::class, [new Statement(UrlScript::class, [$this->baseUrl])]);
			}
		}

		if ($this->sessionMock) {
			if ($builder->hasDefinition('session.session')) {
				$definition = $builder->getDefinition('session.session');
				if ($definition instanceof ServiceDefinition) {
					$definition
						->setType(\Nette\Http\Session::class)
						->setFactory(Session::class);
				}
			}
		}
	}

}
