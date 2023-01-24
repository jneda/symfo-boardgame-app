<?php

namespace App\Controller\Admin;

use App\Entity\BoardGame;
use App\Form\CategoryType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BoardGameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BoardGame::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('playerCount', 'Nombre de joueurs'),
            IntegerField::new('durationMinutes',"Durée d'une partie (en minutes)"),
            IntegerField::new('minAge', 'Âge minimum'),
            DateField::new('publicationDate', 'Date de publication'),
            TextareaField::new('description', 'Description'),
            TextareaField::new('contents', 'Matériel de jeu'),
            ImageField::new('image')->setBasePath('images/')->setUploadDir('public/images/')->setFormTypeOption('required', false),
            AssociationField::new('categories', 'Catégories'),
        ];
    }
   
}
