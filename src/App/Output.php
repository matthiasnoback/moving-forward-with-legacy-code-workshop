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
        if (!is_string($output)) {
            $output = '';
        }

        ob_end_clean();

        return $output;
    }
}
