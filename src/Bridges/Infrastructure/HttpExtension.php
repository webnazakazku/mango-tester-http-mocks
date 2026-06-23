<?php declare(strict_types = 1);

namespace Webnazakazku\MangoTester\HttpMocks\Bridges\Infrastructure;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Webnazakazku\MangoTester\Infrastructure\MangoTesterExtension;

/**
 * @property-read \stdClass $config
 */
class HttpExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'baseUrl' => Expect::string()
				->default('https://test.dev'),
			'sessionMock' => Expect::bool()
				->default(true),
		]);
	}

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$config = $this->config;

		$builder->addDefinition($this->prefix('mocksContainerHook'))
			->setType(HttpMocksContainerHook::class)
			->setArguments(
				[
					$config->baseUrl, // Fixed the double ->config typo
					$config->sessionMock,
				]
			)
			->addTag(MangoTesterExtension::TAG_HOOK);
	}

}
