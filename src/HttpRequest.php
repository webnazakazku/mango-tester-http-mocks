<?php declare(strict_types = 1);

namespace Webnazakazku\MangoTester\HttpMocks;

use Nette\Http\FetchDest;
use Nette\Http\FetchSite;
use Nette\Http\Request;

class HttpRequest extends Request
{

	/** @var array<mixed> */
	private array $headers = [];

	/** @var string|NULL */
	private ?string $body;

	public function setRawBody(?string $body): void
	{
		$this->body = $body;
	}

	public function getRawBody(): ?string
	{
		return $this->body ?? parent::getRawBody();
	}

	public function setHeader(string $name, string $value): void
	{
		$this->headers[$name] = $value;
	}

	public function getHeader(string $header): ?string
	{
		if (isset($this->headers[$header])) {
			return $this->headers[$header];
		}

		return parent::getHeader($header);
	}

	/**
	 * @return array<string, string>
	 */
	public function getHeaders(): array
	{
		return array_merge(parent::getHeaders(), $this->headers);
	}

	public function isSameSite(): bool
	{
		return true;
	}

	public function isFrom(array|FetchSite $site, array|FetchDest|null $dest = null, ?bool $user = null,): bool
	{
		return true;
	}

}
