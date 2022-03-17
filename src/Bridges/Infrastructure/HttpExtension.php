<?php declare(strict_types = 1);

namespace Webnazakazku\MangoTester\HttpMocks\Bridges\Infrastructure;

use Nette\DI\CompilerExtension;
use Webnazakazku\MangoTester\Infrastructure\MangoTesterExtension;

class HttpExtension extends CompilerExtension
{

	/** @var string[] */
	public $defaults = [
		'baseUrl' => 'https://test.dev',
	];

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);

		$builder->addDefinition($this->prefix('mocksContainerHook'))
			->setClass(HttpMocksContainerHook::class)
			->setArguments([$config['baseUrl']])
			->addTag(MangoTesterExtension::TAG_HOOK);
	}

}
