<?php

namespace Vb\Bundle\CodeSearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VbCodeSearchBundle:Default:index.html.twig');
    }
}
