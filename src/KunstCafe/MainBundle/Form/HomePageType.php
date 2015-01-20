<?php

namespace KunstCafe\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HomePageType extends AbstractType
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mainBannerImage', 'file', array(
                'data_class' => null,
                'data' => $this->config['main_banner_image']
            ))
            ->add('mainBannerText', null, array(
                'data' => $this->config['main_banner_text']
            ))
            ->add('first_block_image', 'file', array(
                'data_class' => null,
                'data' => $this->config['blocks']['first_block']['image']
            ))
            ->add('first_block_text', 'text', array(
                'data' => $this->config['blocks']['first_block']['text']
            ))
            ->add('first_block_url', 'choice', array(
                'choices' => array(
                    'kunst_cafe_main_homepage' => 'Home Page',
                    'kunst_cafe_main_about_us' => 'About Us',
                    'kunst_cafe_main_calendar' => 'Calendar',
                    'kunst_cafe_main_artists' => 'Artists',
                    'kunst_cafe_main_application_form' => 'Application Form',
                    'kunst_cafe_main_blog' => 'Blog',
                    'kunst_cafe_main_contact_us' => 'Contact Us',
                ),
                'data' => $this->config['blocks']['first_block']['url']
            ))
            ->add('second_block_image', 'file', array(
                'data_class' => null,
                'data' => $this->config['blocks']['second_block']['image']
            ))
            ->add('second_block_text', 'text', array(
                'data' => $this->config['blocks']['second_block']['text']
            ))
            ->add('second_block_url', 'choice', array(
                'choices' => array(
                    'kunst_cafe_main_homepage' => 'Home Page',
                    'kunst_cafe_main_about_us' => 'About Us',
                    'kunst_cafe_main_calendar' => 'Calendar',
                    'kunst_cafe_main_artists' => 'Artists',
                    'kunst_cafe_main_application_form' => 'Application Form',
                    'kunst_cafe_main_blog' => 'Blog',
                    'kunst_cafe_main_contact_us' => 'Contact Us',
                ),
                'data' => $this->config['blocks']['second_block']['url']
            ))
            ->add('third_block_image', 'file', array(
                'data_class' => null,
                'data' => $this->config['blocks']['third_block']['image']
            ))
            ->add('third_block_text', 'text', array(
                'data' => $this->config['blocks']['third_block']['text']
            ))
            ->add('third_block_url', 'choice', array(
                'choices' => array(
                    'kunst_cafe_main_homepage' => 'Home Page',
                    'kunst_cafe_main_about_us' => 'About Us',
                    'kunst_cafe_main_calendar' => 'Calendar',
                    'kunst_cafe_main_artists' => 'Artists',
                    'kunst_cafe_main_application_form' => 'Application Form',
                    'kunst_cafe_main_blog' => 'Blog',
                    'kunst_cafe_main_contact_us' => 'Contact Us',
                ),
                'data' => $this->config['blocks']['third_block']['url']
            ))
            ->add('fourth_block_image', 'file', array(
                'data_class' => null,
                'data' => $this->config['blocks']['fourth_block']['image']
            ))
            ->add('fourth_block_text', 'text', array(
                'data' => $this->config['blocks']['fourth_block']['text']
            ))
            ->add('fourth_block_url','choice', array(
                'choices' => array(
                    'kunst_cafe_main_homepage' => 'Home Page',
                    'kunst_cafe_main_about_us' => 'About Us',
                    'kunst_cafe_main_calendar' => 'Calendar',
                    'kunst_cafe_main_artists' => 'Artists',
                    'kunst_cafe_main_application_form' => 'Application Form',
                    'kunst_cafe_main_blog' => 'Blog',
                    'kunst_cafe_main_contact_us' => 'Contact Us',
                ),
                'data' => $this->config['blocks']['fourth_block']['url']
            ))
            ->add('fifth_block_image', 'file', array(
                'data_class' => null,
                'data' => $this->config['blocks']['fifth_block']['image']
            ))
            ->add('fifth_block_text', 'text', array(
                'data' => $this->config['blocks']['fifth_block']['text']
            ))
            ->add('fifth_block_url', 'choice', array(
                'choices' => array(
                    'kunst_cafe_main_homepage' => 'Home Page',
                    'kunst_cafe_main_about_us' => 'About Us',
                    'kunst_cafe_main_calendar' => 'Calendar',
                    'kunst_cafe_main_artists' => 'Artists',
                    'kunst_cafe_main_application_form' => 'Application Form',
                    'kunst_cafe_blog_index' => 'Blog',
                    'kunst_cafe_main_contact_us' => 'Contact Us',
                ),
                'data' => $this->config['blocks']['fifth_block']['url']
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            //'data_class' => 'KunstCafe\MainBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kunstcafe_mainbundle_homepage';
    }
}
