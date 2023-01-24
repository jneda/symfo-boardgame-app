<?php

namespace App\Controller\Admin;

use App\Entity\BoardGame;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BoardGameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BoardGame::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
