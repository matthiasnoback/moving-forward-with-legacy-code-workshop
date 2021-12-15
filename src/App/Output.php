<?php

declare(strict_types=1);

namespace App;

final class Output
{
    public static function capture(callable $callable): string
    {
        ob_start();

        $callable();

        $output = ob_get_contents();
        if (! is_string($output)) {
            $output = '';
        }

        ob_end_clean();

        return $output;
    }

    /**
     * @return array{body: string, headers: array<string>}
     */
    public static function captureAndCollectHeaders(callable $callable): array
    {
        ob_start();

        $headers = [];
        $callable($headers);

        $output = ob_get_contents();
        if (! is_string($output)) {
            $output = '';
        }

        ob_end_clean();

        return ['body' => $output,  'headers' => $headers];
    }
}
