<?php

namespace Management\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grayScaleImageFile', VichImageType::class, array(
                'label' => 'Логотип (чёрно-белый)',
                'required' => false
            ))
            ->add('colorImageFile', VichImageType::class, array(
                'label' => 'Логотип (цветной)',
                'required' => false
            ))
            ->add('title', TextType::class, array(
                'label' => 'Название',
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
            'data_class' => 'Management\AdminBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'management_adminbundle_client';
    }


}
