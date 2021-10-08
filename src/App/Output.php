<?php
declare(strict_types=1);

namespace App;

final class Output
{
    /**
     * @return array{string,array<string>}
     */
    public static function capture(callable $callable): array
    {
        ob_start();

        $headers = [];

        $callable($headers);

        $output = ob_get_contents();
        if (!is_string($output)) {
            $output = '';
        }

        ob_end_clean();

        return [$output, $headers];
    }
}
