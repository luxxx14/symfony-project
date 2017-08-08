<?php

namespace Management\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use Management\AdminBundle\Validator\Constraints\CustomNotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('profileImageFile', VichImageType::class, array(
                'label' => false,
                'required' => false
            ))
//            ->add('email', EmailType::class, array(
//                'label' => 'Электронная почта',
//                'required' => false,
//                'invalid_message' => 'Адрес электронной почты не действителен'
//            ))
            ->add('currentPlainPassword', PasswordType::class, array(
                'label' => 'Старый пароль',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'mapped' => false,
                'required' => false,
//                'constraints' => [
//                    new UserPassword(['message' => 'Неверное значение вашего текущего пароля'])
//                ]
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'required' => false,
                'first_options'  => array(
                    'label' => 'Новый пароль',
                    'label_attr' => [
                        'class' => 'control-label required-label'
                    ],
                    'required' => false
                ),
                'second_options' => array(
                    'label' => 'Повторите новый',
                    'label_attr' => [
                        'class' => 'control-label required-label'
                    ],
                    'required' => false,
                    'attr' => [
                        'class' => ''
                    ]
                ),
            ))
            ->add('firstName', TextType::class, array(
                'label' => 'Имя',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'required' => false
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'Фамилия',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'required' => false
            ))
            ->add('country', EntityType::class, array(
                'label' => 'Страна',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'class' => 'Geo\LocationBundle\Entity\Country',
                'choice_label' => 'name',
                'mapped' => false,
                'required' => true
            ))
            ->add('city', EntityType::class, array(
                'label' => 'Город',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'class' => 'Geo\LocationBundle\Entity\City',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                'required' => true
            ))
            ->add('phoneNumber', TextType::class, array(
                'label' => 'Телефон',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'required' => false
            ))
            ->add('dateOfBirth', DateType::class, array(
                'label' => 'Дата рождения',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'required' => false,
                'format' => 'dd.MM.yyyy',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'fdatepicker'
                ]
            ))
            ->add('sex', ChoiceType::class, array(
                'label' => 'Пол',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices'  => array(
                    'Мужской' => 'Мужской',
                    'Женский' => 'Женский'
                ),
                'expanded' => true
            ))
            ->add('skillLevel', EntityType::class, array(
                'label' => 'Уровень мастерства',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'attr' => array(
                    'class' => 'small-9 large-9'
                ),
                'class' => 'SocialNetwork\TournamentsBundle\Entity\SkillLevel',
                'choice_label' => 'rating',
                'required' => false
            ))
            ->add('experience', IntegerType::class, array(
                'label' => 'Игровой опыт',
                'label_attr' => [
                    'class' => 'control-label required-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => '',
                    'min' => 0,
                    'max' => 70
                ]
            ))
            ->add('tennisClub', TextType::class, array(
                'label' => 'Теннисный клуб',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => ''
                ]
            ))
//            ->add('aWeekdaysFrom', IntegerType::class, array(
//                'label'  => 'с',
//                'required' => false,
//                'attr' => [
//                    'class' => 'form-control small-3 large-3',
//                    'min' => 0,
//                    'max' => 24
//                ]
//            ))
//            ->add('aWeekdaysTo', IntegerType::class, array(
//                'label'  => 'до',
//                'required' => false,
//                'attr' => [
//                    'class' => 'form-control small-3 large-3',
//                    'min' => 0,
//                    'max' => 24
//                ]
//            ))
//            ->add('aWeekendFrom', IntegerType::class, array(
//                'label'  => 'с',
//                'required' => false,
//                'attr' => [
//                    'class' => 'form-control small-3 large-3',
//                    'min' => 0,
//                    'max' => 24
//                ]
//            ))
//            ->add('aWeekendTo', IntegerType::class, array(
//                'label'  => 'до',
//                'required' => false,
//                'attr' => [
//                    'class' => 'form-control small-3 large-3',
//                    'min' => 0,
//                    'max' => 24
//                ]
//            ))
            ->add('aWeekdaysFrom', TimeType::class, array(
                'label'  => 'с',
                'required' => false,
                'attr' => [
                    'class' => 'form-control small-3 large-3'
                ],
                'input'  => 'datetime',
                'widget' => 'single_text'
            ))
            ->add('aWeekdaysTo', TimeType::class, array(
                'label'  => 'по',
                'required' => false,
                'attr' => [
                    'class' => 'form-control small-3 large-3'
                ],
                'input'  => 'datetime',
                'widget' => 'single_text'
            ))
            ->add('aWeekendFrom', TimeType::class, array(
                'label'  => 'с',
                'required' => false,
                'attr' => [
                    'class' => 'form-control small-3 large-3'
                ],
                'input'  => 'datetime',
                'widget' => 'single_text'
            ))
            ->add('aWeekendTo', TimeType::class, array(
                'label'  => 'по',
                'required' => false,
                'attr' => [
                    'class' => 'form-control small-3 large-3'
                ],
                'input'  => 'datetime',
                'widget' => 'single_text'
            ))
            ->add('briefInfo', TextareaType::class, array(
                'label' => 'О себе',
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
            'data_class' => 'Management\AdminBundle\Entity\User',
            'validation_groups' => ['Default', 'Profile']
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'management_adminbundle_user';
    }
}