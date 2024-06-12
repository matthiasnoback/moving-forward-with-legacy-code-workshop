<?php

class SomeController
{
    public function someAction()
    {
    }

    public function someOtherAction()
    {
    }
}
?>
-----
<?php

use Psr\Http\Message\ServerRequestInterface;
class SomeController
{
    public function someAction(ServerRequestInterface $request)
    {
    }

    public function someOtherAction(ServerRequestInterface $request)
    {
    }
}
