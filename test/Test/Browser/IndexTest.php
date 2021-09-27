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
        $this->browser = self::createHttpBrowserClient(['env' => ['APPLICATION_ENV' => 'testing']]);
    }

    public function testHelloWorld(): void
    {
        $response = $this->browser->request('GET', '/');
        $responseText = $response->text();
        self::assertStringContainsString('Hello, world!', $responseText);
        self::assertStringContainsString('Environment: testing', $responseText);
    }
}
