<?php

namespace App\Controller\Admin;

use App\Entity\Lift;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class LiftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lift::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $types = [
            'Télécorde' => 'Télécorde',
            'Télésièges' => 'Télésièges',
            'Télécabines' => 'Télécabines',
            'Téléski' => 'Téléski',
            'Télécorde' => 'Télécorde',
        ];

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')
                ->setLabel('Nom de la remontée'),
            AssociationField::new('station'),
            ChoiceField::new('type')
                ->setLabel('Type de remontée')
                ->setChoices($types)
                ->setRequired(true)
                ->renderExpanded(),
            BooleanField::new('is_open')
                ->setLabel('Ouverture de la remontée'),
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
