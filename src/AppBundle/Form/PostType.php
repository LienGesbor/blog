<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('postTitle', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Post Title'
                    ),
                    'label' => false
                ))
                ->add('postAuthor', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Post Author'
                    ),
                    'label' => false
                ))
                ->add('postDate', DateType::class, array(
                    'widget' =>  'choice',

                    'label' => 'Post Date'
                ))
                ->add('postBody', TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Post Text'
                    ),
                    'label' => false
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
//    public function getBlockPrefix()
//    {
//        return 'postCreate';
//    }


}
