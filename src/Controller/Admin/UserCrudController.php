<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $roles = [
            'No Role' => '',
            'Super Admin' => 'ROLE_SUPER_ADMIN',
            'Admin' => 'ROLE_ADMIN',
        ];

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')
                ->setLabel('Nom'),
            TextField::new('email')
                ->setLabel('Email'),
            TextField::new('password')
                ->setLabel('Mot de passe'),
            ChoiceField::new('roles')
                ->setLabel('Rôle')
                ->setChoices($roles)
                ->setRequired(true)
                ->renderExpanded(),
        ];
    }
    
}