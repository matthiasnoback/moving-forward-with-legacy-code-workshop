<?php
declare(strict_types=1);

namespace App;

final class ControllerResponse
{
    /**
     * @var array<int,string>
     */
    private array $headers = [];

    private string $content = '';

    /**
     * @return array<int,string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function addHeader(string $header): void
    {
        $this->headers[] = $header;
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
