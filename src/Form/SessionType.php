<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\Session;
use App\Entity\Student;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxStudents', IntegerType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('dateStart', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('dateEnd', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('reservations', IntegerType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('students', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => Student::class,
                    'choice_label' => function ($student) {
                        return $student->__toString();
                    },
                    'attr' => [
                        'class' => 'uk-select'
                    ]
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('programs', CollectionType::class, [
                'entry_type' => ProgramType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true, 
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class' => 'ui-button ui-widget ui-corner-all'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
