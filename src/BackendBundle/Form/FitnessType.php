<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FitnessType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('stadt')
            ->add('offnenZeit',ChoiceType::class,array(
                'required'=>true,
                'choices'=>array(
                    'Auswählen'=>'',
                    'Ja'=>1,
                    'Nein'=>0,

                )
            ))
            ->add('trainer',ChoiceType::class,array(
                'required'=>true,
                'choices'=>array(
                    'Auswählen'=>'',
                    'Ja'=>'Ja',
                    'Nein'=>'Nein',
                    'Werktagen'=>'nur an Werktagen',
                    'Wochende'=>'nur an Wochenenden',


                )
            ))
            ->add('preis');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Fitness'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_fitness';
    }


}
