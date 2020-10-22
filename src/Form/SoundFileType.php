<?php

namespace App\Form;

use App\Entity\SoundFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoundFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('deletedAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soundPackage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SoundFile::class,
        ]);
    }
}
