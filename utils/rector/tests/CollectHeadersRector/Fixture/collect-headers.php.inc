<?php

use App\Output;

class SomeController
{
    public function someAction(): string
    {
        return Output::capture(function () {
            header('Content-Type: text/plain');
            echo 'Hello, world!';
        });
    }
}
?>
-----
<?php

use App\Output;

class SomeController
{
    public function someAction(): string
    {
        return Output::capture(function (array &$headers) {
            $headers[] = 'Content-Type: text/plain';
            echo 'Hello, world!';
        });
    }
}
?>
