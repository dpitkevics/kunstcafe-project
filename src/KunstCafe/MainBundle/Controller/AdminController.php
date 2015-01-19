<?php

namespace KunstCafe\MainBundle\Controller;

use KunstCafe\MainBundle\Form\AboutPageType;
use KunstCafe\MainBundle\Form\HomePageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('KunstCafeMainBundle:Admin:index.html.twig');
    }

    public function homeAction(Request $request)
    {
        $config = $this->getPageConfig('home');

        $form = $this->createForm(new HomePageType($config));
        $form->add('submit', 'submit');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $newConfig = array();
            if (isset($data['mainBannerImage']) && $data['mainBannerImage'] !== null) {
                $newConfig['main_banner_image'] = $this->uploadImage($data['mainBannerImage']);
            } else {
                $newConfig['main_banner_image'] = $config['main_banner_image'];
            }

            if (isset($data['mainBannerText']) && $data['mainBannerText'] !== null) {
                $newConfig['main_banner_text'] = $data['mainBannerText'];
            }

            $this->parseHomePageBlock('first', $data, $config, $newConfig);
            $this->parseHomePageBlock('second', $data, $config, $newConfig);
            $this->parseHomePageBlock('third', $data, $config, $newConfig);
            $this->parseHomePageBlock('fourth', $data, $config, $newConfig);
            $this->parseHomePageBlock('fifth', $data, $config, $newConfig);

            $dumper = new Dumper();
            $yml = $dumper->dump($newConfig);

            $configFile = $this->getPageConfigFile('home');
            file_put_contents($configFile, $yml);

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Data Saved')
            );
        }

        return $this->render('KunstCafeMainBundle:Admin:home.html.twig', array(
            'config' => $config,
            'form' => $form->createView(),
        ));
    }

    private function parseHomePageBlock($blockName, $data, $config, &$newConfig)
    {
        if (isset($data[$blockName . '_block_image']) && $data[$blockName . '_block_image'] !== null) {
            $newConfig['blocks'][$blockName . '_block']['image'] = $this->uploadImage($data[$blockName . '_block_image']);
        } else {
            $newConfig['blocks'][$blockName . '_block']['image'] = $config['blocks'][$blockName . '_block']['image'];
        }

        if (isset($data[$blockName . '_block_text']) && $data[$blockName . '_block_text'] !== null) {
            $newConfig['blocks'][$blockName . '_block']['text'] = $data[$blockName . '_block_text'];
        } else {
            $newConfig['blocks'][$blockName . '_block']['text'] = $config['blocks'][$blockName . '_block']['text'];
        }

        if (isset($data[$blockName . '_block_url']) && $data[$blockName . '_block_url'] !== null) {
            $newConfig['blocks'][$blockName . '_block']['url'] = $data[$blockName . '_block_url'];
        } else {
            $newConfig['blocks'][$blockName . '_block']['url'] = $config['blocks'][$blockName . '_block']['url'];
        }
    }

    public function aboutAction(Request $request)
    {
        $config = $this->getPageConfig('about');

        $form = $this->createForm(new AboutPageType($config));
        $form->add('submit', 'submit');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $newConfig = array();

            if (isset($data['mainBannerImage']) && $data['mainBannerImage'] !== null) {
                $newConfig['main_banner_image'] = $this->uploadImage($data['mainBannerImage']);
            } else {
                $newConfig['main_banner_image'] = $config['main_banner_image'];
            }

            if (isset($data['mainBannerText']) && $data['mainBannerText'] !== null) {
                $newConfig['main_banner_text'] = $data['mainBannerText'];
            }

            if (isset($data['about_us_picture']) && $data['about_us_picture'] !== null) {
                $newConfig['about_us_picture'] = $this->uploadImage($data['about_us_picture']);
            } else {
                $newConfig['about_us_picture'] = $config['about_us_picture'];
            }

            if (isset($data['about_us_heading']) && $data['about_us_heading'] !== null) {
                $newConfig['about_us_heading'] = $data['about_us_heading'];
            } else {
                $newConfig['about_us_heading'] = $config['about_us_heading'];
            }

            if (isset($data['about_us_text']) && $data['about_us_text'] !== null) {
                $newConfig['about_us_text'] = $data['about_us_text'];
            } else {
                $newConfig['about_us_text'] = $config['about_us_text'];
            }

            if (isset($data['about_us_quote']) && $data['about_us_quote'] !== null) {
                $newConfig['about_us_quote'] = $data['about_us_quote'];
            } else {
                $newConfig['about_us_quote'] = $config['about_us_quote'];
            }

            if (isset($data['about_us_quote_author']) && $data['about_us_quote_author'] !== null) {
                $newConfig['about_us_quote_author'] = $data['about_us_quote_author'];
            } else {
                $newConfig['about_us_quote_author'] = $config['about_us_quote_author'];
            }

            if (isset($data['about_us_quote_image']) && $data['about_us_quote_image'] !== null) {
                $newConfig['about_us_quote_image'] = $this->uploadImage($data['about_us_quote_image']);
            } else {
                $newConfig['about_us_quote_image'] = $config['about_us_quote_image'];
            }

            $dumper = new Dumper();
            $yml = $dumper->dump($newConfig);

            $configFile = $this->getPageConfigFile('about');
            file_put_contents($configFile, $yml);

            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('Data Saved')
            );
        }

        return $this->render('KunstCafeMainBundle:Admin:about.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function imagesAction()
    {
        return $this->render('KunstCafeMainBundle:Admin:images.html.twig', array(

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

    private function getPageConfigFile($page)
    {
        $fileLocator = new FileLocator(__DIR__ . '/../Resources/config/pages/');
        $file = $fileLocator->locate($page . '.config.yml');

        return $file;
    }

    private function getPageConfig($page)
    {
        $file = $this->getPageConfigFile($page);

        $parser = new Parser();
        $config = $parser->parse(file_get_contents($file));

        return $config;
    }

    private function uploadImage(UploadedFile $image)
    {
        $imageName = md5(uniqid(rand(), true)) . '.' . $image->guessExtension();

        $uploadDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/media';

        $image->move(
            $uploadDir,
            $imageName
        );

        return $imageName;
    }
}
