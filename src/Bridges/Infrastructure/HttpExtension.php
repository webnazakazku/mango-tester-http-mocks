<?php declare(strict_types = 1);

namespace Webnazakazku\MangoTester\HttpMocks\Bridges\Infrastructure;

use Nette\DI\CompilerExtension;
use Webnazakazku\MangoTester\Infrastructure\MangoTesterExtension;

class HttpExtension extends CompilerExtension
{

	/** @var array<string|bool> */
	public array $defaults = [
		'baseUrl' => 'https://test.dev',
		'sessionMock' => true,
	];

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);

		$builder->addDefinition($this->prefix('mocksContainerHook'))
			->setClass(HttpMocksContainerHook::class)
			->setArguments(
				[
					$config['baseUrl'],
					$config['sessionMock'],
				]
			)
			->addTag(MangoTesterExtension::TAG_HOOK);
	}

}
