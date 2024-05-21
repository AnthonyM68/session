<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Program;
use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('days', IntegerType::class, [
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            // ->add('session', EntityType::class, [
            //     'class' => Session::class,
            //     'choice_label' => 'id',
            // ])
            ->add('course', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'nameCourse',
                'attr' => [
                    'class' => 'uk-select'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
