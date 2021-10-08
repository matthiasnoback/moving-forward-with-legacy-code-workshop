<?php

class SomeController
{
    public function someAction()
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
        return Output::capture(function () : void {
            echo 'Hello, world!';
        });
    }
}
