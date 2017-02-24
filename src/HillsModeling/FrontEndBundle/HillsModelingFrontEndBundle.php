<?php

namespace HillsModeling\FrontEndBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HillsModelingFrontEndBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
