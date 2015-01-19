<?php

namespace KunstCafe\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AboutPageType extends AbstractType
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
            ->add('about_us_picture', 'file', array(
                'data_class' => null,
                'data' => $this->config['about_us_picture']
            ))
            ->add('about_us_heading', null, array(
                'data' => $this->config['about_us_heading']
            ))
            ->add('about_us_text', 'textarea', array(
                'data' => $this->config['about_us_text']
            ))
            ->add('about_us_quote', null, array(
                'data' => $this->config['about_us_quote']
            ))
            ->add('about_us_quote_author', null, array(
                'data' => $this->config['about_us_quote_author']
            ))
            ->add('about_us_quote_image', 'file', array(
                'data_class' => null,
                'data' => $this->config['about_us_quote_image']
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
