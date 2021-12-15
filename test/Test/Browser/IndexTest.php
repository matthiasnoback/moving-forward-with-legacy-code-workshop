<?php

declare(strict_types=1);

namespace Test\Browser;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\Panther\PantherTestCase;

final class IndexTest extends PantherTestCase
{
    private HttpBrowser $browser;

    protected function setUp(): void
    {
        $this->browser = self::createHttpBrowserClient([
            'env' => [
                'APPLICATION_ENV' => 'testing',
            ],
        ]);
    }

    public function testHelloWorld(): void
    {
        $response = $this->browser->request('GET', '/');
        $responseText = $response->text();
        self::assertStringContainsString('Hello, world!', $responseText);
        self::assertStringContainsString('Environment: testing', $responseText);
        self::assertEquals('test', $this->browser->getInternalResponse()->getHeader('X-Special'));
    }

    public function testHelloUser(): void
    {
        $this->browser->request('GET', '/');

        $response = $this->browser->submitForm('Send', [
            'username' => 'user',
        ], 'GET');

        $responseText = $response->text();
        self::assertStringContainsString('Hello, user!', $responseText);
    }
}
