<?php

namespace KunstCafe\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KunstCafeMainBundle:Default:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('KunstCafeMainBundle:Default:about.html.twig');
    }
}
