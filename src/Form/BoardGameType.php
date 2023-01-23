<?php

namespace App\Form;

use App\Entity\BoardGame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BoardGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('playerCount', TextType::class, [
                'label' => 'Nombre de joueurs'
            ])
            ->add('durationMinutes', IntegerType::class, [
                'label' => "Durée d'une partie (en minutes)"
            ])
            ->add('minAge', IntegerType::class, [
                'label' => 'Âge'
            ])
            ->add('publicationDate', DateType::class, [
                'label' => 'Date de publication',
                'widget' => 'single_text'
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description"
            ])
            ->add('contents', TextareaType::class, [
                'label' => "Matériel de jeu"
            ])
            ->add('image', FileType::class, [
                'label' => 'Image'
            ])
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
