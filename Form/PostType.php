<?php

namespace Okulbilisim\CmsBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    private $container;
    public function __construct(ContainerInterface $servicecontainer)
    {
        $this->container = $servicecontainer;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $post_types = $this->container->getParameter('post_types');
        if(!$post_types)
            $post_types = [];
        $builder
            ->add('title')
            ->add('content','textarea',[
                'attr'=>[
                    'class'=>'tinymce'
                ]
            ])
            ->add('status','choice',[
                'choices'=>[
                    0=>'Disable',
                    1=>'Enable',
                    2=>'Canceled'
                ]
            ])
            ->add('post_type','choice',[
                'choices'=>$post_types
            ])
            ->add('object','hidden',[
                'attr'=>[
                    'value'=>$options['object']
                ]
            ])
            ->add('objectId','hidden',[
                'attr'=>[
                    'value'=>$options['objectId']
                ]
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Okulbilisim\CmsBundle\Entity\Post',
            'object'=>null,
            'objectId'=>null,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'okulbilisim_cmsbundle_post';
    }
}
