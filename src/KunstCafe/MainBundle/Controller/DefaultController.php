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
        $configData = $this->getPageConfig('calendar');

        return $this->render('KunstCafeMainBundle:Default:calendar.html.twig', array(
            'config' => $configData
        ));
    }

    public function artistsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $artists = $em->getRepository('KunstCafeMainBundle:Artist')->findAll();

        return $this->render('KunstCafeMainBundle:Default:artists.html.twig', array(
            'artists' => $artists,
        ));
    }

    public function viewArtistAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $artist = $em->getRepository('KunstCafeMainBundle:Artist')->findOneBy(array(
            'slug' => $slug,
        ));

        return $this->render('KunstCafeMainBundle:Default:view_artist.html.twig', array(
            'artist' => $artist,
        ));
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
