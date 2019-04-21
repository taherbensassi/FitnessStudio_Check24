<?php

namespace BackendBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BewertungType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('fitness',EntityType::class,array(
                'required'=>true,
                'placeholder'=>'Fitness',
                'class'=>'BackendBundle\Entity\Fitness',
                'query_builder'=>function (EntityRepository $er){
                    return  $er->createQueryBuilder('u');
                },
                'choice_label' => 'name',
            ))
            ->add('trainer',ChoiceType::class,array(
                'required'=>true,
                'choices'=>array(
                    'Auswählen'=>'',
                    'Ja'=>3,
                    'Nein'=>0,
                    'Werktagen'=>1,
                    'Wochende'=>1,


                )
            ))
            ->add('duschen',ChoiceType::class,array(
                'required'=>true,
                'choices'=>array(
                    'Auswählen'=>'',
                    'Ja kostenlos'=>3,
                    'Ja kostenpflichtig'=>1,
                    'Nein'=>0,



                )
            ))
            ->add('laufzeit',ChoiceType::class,array(
                'required'=>true,
                'choices'=>array(
                    'Auswählen'=>'',
                    '24 monate'=>0,
                    '12 monate'=>1,
                    '1 monate'=>4,




                )
            ))

           ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Bewertung'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_bewertung';
    }


}
