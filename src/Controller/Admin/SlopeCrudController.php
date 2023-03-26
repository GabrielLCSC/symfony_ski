<?php

namespace App\Controller\Admin;

use App\Entity\Slope;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class SlopeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slope::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $levels = [
            'Vert' => 'Vert',
            'Bleu' => 'Blue',
            'Rouge' => 'Rouge',
            'Noir' => 'Noir',
        ];

        $types = [
            'Piste Nordique' => 'Nordique',
            'Piste Alpine' => 'Alpine',
        ];

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')
                ->setLabel('Nom de la piste'),
            AssociationField::new('station'),
            ChoiceField::new('level')
                ->setChoices($levels)
                ->setRequired(true)
                ->renderExpanded(),
            ChoiceField::new('type')
                ->setLabel('Type de piste')
                ->setChoices($types)
                ->setRequired(true)
                ->renderExpanded(),
            BooleanField::new('is_open')
                ->setLabel('Ouverture de la piste'),
            TextEditorField::new('message'),
            BooleanField::new('is_season')
                ->setLabel('Saison de ski'),
            TimeField::new('opening')
                ->setLabel('Heure d\'ouverture'),
            TimeField::new('closing')
                ->setLabel('Heure de fermeture'),
        ];
    }
}
