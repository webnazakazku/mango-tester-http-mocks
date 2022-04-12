<?php declare(strict_types = 1);

namespace Webnazakazku\MangoTester\HttpMocks\Bridges\Infrastructure;

use Nette\DI\ContainerBuilder;
use Nette\DI\Definitions\Statement;
use Nette\Http\Request;
use Nette\Http\UrlScript;
use Webnazakazku\MangoTester\HttpMocks\HttpRequest;
use Webnazakazku\MangoTester\HttpMocks\Session;
use Webnazakazku\MangoTester\Infrastructure\Container\AppContainerHook;

class HttpMocksContainerHook extends AppContainerHook
{

	/** @var string */
	private $baseUrl;

	/** @var bool */
	private $sessionMock;

	public function __construct(string $baseUrl, bool $sessionMock)
	{
		$this->baseUrl = $baseUrl;
		$this->sessionMock = $sessionMock;
	}


	public function onCompile(ContainerBuilder $builder): void
	{
		if ($builder->hasDefinition('http.request')) {
			$builder->getDefinition('http.request')
				->setClass(Request::class)
				->setFactory(HttpRequest::class, [new Statement(UrlScript::class, [$this->baseUrl])]);
		}

		if ($this->sessionMock) {
			if ($builder->hasDefinition('session.session')) {
				$builder->getDefinition('session.session')
					->setClass(\Nette\Http\Session::class)
					->setFactory(Session::class);
			}
		}
	}

}
