<?php

namespace App\Form;

use App\Entity\SoundPackage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class SoundPackageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('level', ChoiceType::class,[
                'choices' => [
                    "Beginner" => 0,
                    "Intermediate" => 1,
                    "Hardcore" => 2,
                ]
            ])
            ->add('deletedAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('createdBy')
            ->add('category')
            ->add('brochure', FileType::class, [
                'label' => 'Music (MP3 file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                                 'maxSize' => '20M',
                                 'mimeTypes' => [
                                     'audio/mpeg',
                                     'audio/mp3',
                                 ],
                                 'mimeTypesMessage' => 'Please upload a valid MP3 file',
                             ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SoundPackage::class,
        ]);
    }
}
