<?php

namespace KunstCafe\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $config = $this->getPageConfig('blog');

        $articles = $em->getRepository('KunstCafeBlogBundle:Article')->findBy(array(), array('createdAt' => 'DESC'), 20);

        return $this->render('KunstCafeBlogBundle:Default:index.html.twig', array(
            'articles' => $articles,
            'config' => $config,
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
