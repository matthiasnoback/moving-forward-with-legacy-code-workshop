<?php

class SomeController
{
    private function notAnActionMethod()
    {
        new class {
            public function looksLikeAnAction()
            {
            }
        };
    }
}
?>
