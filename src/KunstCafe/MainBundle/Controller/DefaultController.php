<?php

namespace KunstCafe\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $configData = $this->getPageConfig('home');

        return $this->render('KunstCafeMainBundle:Default:index.html.twig', array(
            'config' => $configData,
        ));
    }

    public function aboutAction()
    {
        $configData = $this->getPageConfig('about');

        return $this->render('KunstCafeMainBundle:Default:about.html.twig', array(
            'config' => $configData,
        ));
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

    private function getPageConfig($page)
    {
        $fileLocator = new FileLocator(__DIR__ . '/../Resources/config/pages/');
        $file = $fileLocator->locate($page . '.config.yml');

        $parser = new Parser();
        $config = $parser->parse(file_get_contents($file));

        return $config;
    }
}
