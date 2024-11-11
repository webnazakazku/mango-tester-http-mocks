<?php declare(strict_types = 1);

namespace Webnazakazku\MangoTester\HttpMocks;

use ArrayIterator;
use Iterator;
use Nette\Http\Session as NetteSession;
use Nette\Http\SessionSection as NetteSessionSection;
use SessionHandlerInterface;

class Session extends NetteSession
{

	/** @var SessionSection[] */
	private array $sections = [];

	private bool $started = false;

	private bool $exists = false;

	private string $id;

	public function __construct()
	{
	}

	public function start(): void
	{
		$this->started = true;
	}

	public function autoStart(bool $forWrite): void
	{
		$this->started = true;
	}

	public function isStarted(): bool
	{
		return $this->started;
	}

	public function close(): void
	{
		$this->started = false;
	}

	public function destroy(): void
	{
		$this->started = false;
	}

	public function exists(): bool
	{
		return $this->exists;
	}

	public function setFakeExists(bool $exists): void
	{
		$this->exists = $exists;
	}

	public function regenerateId(): void
	{
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function setFakeId(mixed $id): void
	{
		$this->id = $id;
	}

	/** @return NetteSessionSection<mixed> */
	public function getSection(string $section, string $class = SessionSection::class): NetteSessionSection
	{
		if (isset($this->sections[$section])) {
			return $this->sections[$section];
		}

		$sessionSection = parent::getSection($section, $class);
		assert($sessionSection instanceof SessionSection);

		return $this->sections[$section] = $sessionSection;
	}

	public function hasSection(string $section): bool
	{
		return isset($this->sections[$section]);
	}

	/** @return ArrayIterator<int, (int|string)>*/
	public function getIterator(): Iterator
	{
		return new ArrayIterator(array_keys($this->sections));
	}

	public function clean(): void
	{
	}

	public function setName(string $name): static
	{
		return $this;
	}

	public function getName(): string
	{
		return '';
	}

	/** @param array<mixed> $options */
	public function setOptions(array $options): static
	{
		return $this;
	}

	/** @return array<mixed> */
	public function getOptions(): array
	{
		return [];
	}

	public function setExpiration(?string $time): static
	{
		return $this;
	}

	public function setCookieParameters(string $path, ?string $domain = null, ?bool $secure = null, ?string $samesite = null): static
	{
		return $this;
	}

	/** @return array<null> */
	public function getCookieParameters(): array
	{
		return [];
	}

	public function setSavePath(string $path): static
	{
		return $this;
	}

	public function setHandler(SessionHandlerInterface $handler): static
	{
		return $this;
	}

}
