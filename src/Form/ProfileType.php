<?php

namespace App\Form;

use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class,[
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                ]
            ])
            ->add('age', NumberType::class)
            ->add('level', ChoiceType::class, [
                'choices' => [
                    'Beginner' => 'Beginner',
                    'Intermediate' => 'Intermediate',
                    'Professional' => 'Professional',
                ]
            ])
            ->add('isProfessional', null, [
                'label' => 'Are you considered professional in music related field'
            ])
            ->add('timeSingingInYears', NumberType::class, [
                'label' => 'Age is music related environment'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
