<?php

namespace KunstCafe\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KunstCafeUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
