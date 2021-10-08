<?php

class SomeController
{
    public function someAction(): void
    {
        echo 'Hello, world!';
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
        return Output::capture(function () {
            echo 'Hello, world!';
        });
    }
}
