<?php

namespace TrajetsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TrajetsBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
