<?php

namespace Management\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeedSourceEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class, array(
                'label' => 'URL источника новостей',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false
            ))
            ->add('locale', EntityType::class, array(
                'label' => 'Перевод',
                'label_attr' => [
                    'class' => 'label'
                ],
                'attr' => array(
                    'class' => 'form-control'
                ),
                'class' => 'Translation\LocaleBundle\Entity\Locale',
                'choice_label' => 'shortname',
//                'query_builder' => function (EntityRepository $er) {
//                    $qb = $er->createQueryBuilder('l');
//
//                    $usedLocales = $qb->select('DISTINCT usedLocales.id')
//                        ->from('ManagementAdminBundle:FeedSource', 'fS')
//                        ->join('fS.locale', 'usedLocales')
//                        ->where('usedLocales.id IS NOT NULL')
//                        ->getQuery()
//                        ->getResult();
//
//                    $qb
//                        ->select('l')
//                        ->where('l NOT IN (:usedLocales)')
//                        ->setParameter('usedLocales', $usedLocales);
//                    return $qb;
//                },
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
            'data_class' => 'Management\AdminBundle\Entity\FeedSource'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'management_adminbundle_feedsource';
    }
}
