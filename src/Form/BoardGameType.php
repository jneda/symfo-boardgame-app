<?php

namespace App\Form;

use App\Entity\BoardGame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoardGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('playerCount')
            ->add('durationMinutes')
            ->add('minAge')
            ->add('publicationDate', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('description')
            ->add('contents')
            ->add('categories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BoardGame::class,
        ]);
    }
}
