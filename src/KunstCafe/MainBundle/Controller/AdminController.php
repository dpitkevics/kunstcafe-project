<?php

namespace KunstCafe\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('KunstCafeMainBundle:Default:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('KunstCafeMainBundle:Default:about.html.twig');
    }

    public function calendarAction()
    {
        return $this->render('KunstCafeMainBundle:Default:calendar.html.twig');
    }

    public function artistsAction()
    {
        return $this->render('KunstCafeMainBundle:Default:artists.html.twig');
    }

    public function viewArtistAction($slug)
    {
        return $this->render('KunstCafeMainBundle:Default:view_artist.html.twig');
    }
}
