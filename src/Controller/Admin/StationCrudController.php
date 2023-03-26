<?php

namespace App\Controller\Admin;

use App\Entity\Station;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Station::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')
                ->setLabel('Nom de la station'),
            AssociationField::new('domain')
                ->setLabel('Domaine'),
            AssociationField::new('user')
                ->setLabel('Responsable'),
            ImageField::new('logo')
                ->setUploadDir('public/uploads/station')
                ->setBasePath('uploads/station')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
        ];
    }
}
