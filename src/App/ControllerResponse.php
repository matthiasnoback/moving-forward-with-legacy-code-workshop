<?php
declare(strict_types=1);

namespace App;

final class ControllerResponse
{
    /**
     * @var array<string,string>
     */
    private array $headers = [];

    private string $content = '';

    /**
     * @return array<string,string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function addHeader(string $header, string $value): void
    {
        $this->headers[$header] = $value;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
