<?php

class SomeController
{
    public function someAction(): void
    {
        echo 'Hello, world!';
        exit;
    }
}
?>
-----
<?php

class SomeController
{
    public function someAction(): void
    {
        echo 'Hello, world!';
        return;
    }
}
?>
