<?php

namespace App\Form;

use App\Entity\Exports;
use App\Entity\Locals;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ExportsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('local', EntityType::class, [
                'class' => Locals::class,
                'choice_label' => 'name',
                'label' => 'Lokal:',
                'required'   => false,
                'empty_data' => '',
            ])
            ->add('export_at_from', DateType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Od:'
            ])
            ->add('export_at_to', DateType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Do:'
            ])
            ->add('Submit', SubmitType::class, ['label' => 'Zatwierdź',]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exports::class,
        ]);
    }
}
