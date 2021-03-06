<?php

namespace Management\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Заголовок',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false
            ))
            ->add('subtitle', TextType::class, array(
                'label' => 'Подзаголовок',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false
            ))
        ;

//        $builder->add('sourceLinks', CollectionType::class, array(
//            'entry_type' => SourceLinkType::class,
//            'allow_add'  => true,
//            'by_reference' => false
//        ));
        $builder->add('sourceLinks', CollectionType::class, array(
            'entry_type' => SourceLinkType::class,
            'label' => false,
            'allow_add'  => true,
            'allow_delete' => true,
            'prototype' => true,
            'by_reference' => false
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Management\AdminBundle\Entity\Source'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'management_adminbundle_source';
    }
}
