<?php declare(strict_types = 1);

namespace Webnazakazku\MangoTester\HttpMocks;

use ArrayIterator;
use Iterator;
use Nette;

class SessionSection extends Nette\Http\SessionSection
{

	/** @var array<mixed> */
	private $data = [];

	public function __construct(Nette\Http\Session $session, string $name)
	{
		parent::__construct($session, $name);
	}

	/** @return Iterator<mixed> */
	public function getIterator(): Iterator
	{
		return new ArrayIterator($this->data);
	}

	/** @phpstan-param mixed $value */
	public function __set(string $name, $value): void
	{
		$this->data[$name] = $value;
	}


	public function &__get(string $name)
	{
		if ($this->warnOnUndefined && !array_key_exists($name, $this->data)) {
			trigger_error("The variable '" . $name . ' does not exist in session section', E_USER_NOTICE);
		}

		return $this->data[$name];
	}


	public function __isset(string $name): bool
	{
		return isset($this->data[$name]);
	}


	public function __unset(string $name): void
	{
		unset($this->data[$name]);
	}


	public function setExpiration($time, $variables = null)
	{
		return $this;
	}


	public function removeExpiration($variables = null): void
	{
	}


	public function remove($name = null): void
	{
		$this->data = [];
	}

}
