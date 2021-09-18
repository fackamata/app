<?php

namespace App\Form;

use App\Entity\Conseil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConseilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            // ->add('datePublication')
            // ->add('nombreVue')
            ->add('file', FileType::class,[ 
                'mapped' => false,
                'required' => false,
                'label' => 'Avatar',
            ])
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conseil::class,
        ]);
    }
}
