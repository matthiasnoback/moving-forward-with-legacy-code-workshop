<?php

use Psr\Http\Message\ServerRequestInterface;

class SomeController
{
    public function someAction()
    {
        echo $_GET['name'];
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
        echo $request->getQueryParams()['name'];
    }
}
?>
