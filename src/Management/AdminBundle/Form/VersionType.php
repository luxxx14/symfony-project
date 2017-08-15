<?php

namespace Management\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VersionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'label' => 'Тип',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices'  => array(
                    'Стабильная' => 'Стабильная',
                    'Новейшая' => 'Новейшая',
                    'Исходный код' => 'Исходный код'
                ),
                'required' => true
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Описание',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false
            ))
            ->add('name', TextType::class, array(
                'label' => 'Версия',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false
            ))
            ->add('mavenDependency', TextareaType::class, array(
                'label' => 'Maven dependency',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Management\AdminBundle\Entity\Version'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'management_adminbundle_version';
    }
}
