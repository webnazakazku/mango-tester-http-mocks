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


	public function __construct(string $baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}


	public function onCompile(ContainerBuilder $builder): void
	{
		if ($builder->hasDefinition('http.request')) {
			$builder->getDefinition('http.request')
				->setClass(Request::class)
				->setFactory(HttpRequest::class, [new Statement(UrlScript::class, [$this->baseUrl])]);
		}

		if ($builder->hasDefinition('session.session')) {
			$builder->getDefinition('session.session')
				->setClass(\Nette\Http\Session::class)
				->setFactory(Session::class);
		}
	}
}
