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
                        'class' => 'post_form_title',
                        'placeholder' => 'Post Title'
                    ),
                    'label' => false
                ))
                ->add('postAuthor', TextType::class, array(
                    'attr' => array(
                        'class' => 'post_form_author',
                        'placeholder' => 'Post Author'
                    ),
                    'label' => false
                ))
                ->add('postDate', DateType::class, array(
                    'widget' =>  'choice',
                    'attr' => array(
                        'class' => 'post_form_date',
                    ),
                    'label' => 'Post Date',
                    'label_attr' => array(
                        'id' => 'post_date_label'
                    )
                ))
                ->add('postBody', TextareaType::class, array(
                    'attr' => array(
                        'class' => 'post_form_body',
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
