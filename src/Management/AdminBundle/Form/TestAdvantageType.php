<?php

namespace Management\AdminBundle\Form;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use A2lix\TranslationFormBundle\Form\Type\TranslatedEntityType;
use Management\AdminBundle\Entity\Advantage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TestAdvantageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('translations', TranslationsType::class);

        $builder
            ->add('imageFile', VichImageType::class, array(
                'label' => 'Рисунок',
                'label_attr' => [
                    'class' => 'label'
                ],
//                'attr' => [
//                    'class' => 'form-control'
//                ],
//                'download_label' => function (Advantage $advantage) {
//                    return $advantage->getId();
//                },
                'required' => false
            ))
            ->add('description', TranslatedEntityType::class, array(
                'class' => 'Management\AdminBundle\Entity\Advantage',
                'label' => 'Описание',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
                'translation_property' => 'text',
                'multiple' => true,

//                'locales' => ['ru', 'en'],   // [1]
//                'default_locale' => ['ru'],               // [1]
//                'required_locales' => ['en'],            // [1]
//                'fields' => [                               // [2]
//                    'description' => [                         // [3.a]
//                        'field_type' => 'textarea',                // [4]
//                        'label' => 'Описание',                    // [4]
//                        'locale_options' => [                  // [3.b]
//                            'en' => ['label' => 'Description'],     // [4]
////                            'fr' => ['display' => false]           // [4]
//                        ]
//                    ]
//                ],
//                'excluded_fields' => ['details']            // [2]
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Management\AdminBundle\Entity\Advantage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'management_adminbundle_advantage';
    }


}
