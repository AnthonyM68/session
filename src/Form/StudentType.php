<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('zipCode', TextType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            // ->add('sessions', EntityType::class, [
            //     'class' => Session::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class' => 'uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
