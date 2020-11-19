<?php

namespace App\Form;

use App\Entity\SoundFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class SoundFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('deletedAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soundPackage')
            ->add('brochure', FileType::class, [
                'label' => 'Music (MP3 file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
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
            'data_class' => SoundFile::class,
        ]);
    }
}
