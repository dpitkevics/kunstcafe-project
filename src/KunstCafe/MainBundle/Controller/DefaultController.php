<?php

namespace KunstCafe\MainBundle\Controller;

use KunstCafe\MainBundle\Entity\Application;
use KunstCafe\MainBundle\Form\ApplicationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
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

    public function applicationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new Application();

        $form = $this->createForm(new ApplicationType(), $entity);
        $form->add('submit', 'submit');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Application successfully submitted')
            );
        }

        return $this->render('KunstCafeMainBundle:Default:application.html.twig', array(
            'form' => $form->createView(),
            'config' => $this->getPageConfig('application'),
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
