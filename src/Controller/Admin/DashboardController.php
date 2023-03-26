<?php

namespace App\Controller\Admin;

use App\Entity\Domain;
use App\Entity\Lift;
use App\Entity\Slope;
use App\Entity\Station;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Check if the user has the ROLE_SUPER_ADMIN role
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            // If yes, redirect to the list of Domain entities
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            return $this->redirect($adminUrlGenerator->setController(DomainCrudController::class)->generateUrl());
        } else if ($this->isGranted('ROLE_ADMIN')) {
            // If the user has the ROLE_ADMIN role, redirect to the admin page 
            $user = $this->getUser();
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            return $this->redirect($adminUrlGenerator->setController(StationCrudController::class)->generateUrl());
        } else {
            // If the user doesn't have the required roles, show an error message
            throw $this->createAccessDeniedException();
        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Rhone-Alpes Ski ⛷️');
    }

    public function configureMenuItems(): iterable
    {
        // Define the menu items for the ROLE_SUPER_ADMIN role
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToCrud('Domain', 'fa fa-list', Domain::class);
            yield MenuItem::linkToCrud('Station', 'fa fa-list', Station::class);
            yield MenuItem::linkToCrud('User', 'fa fa-list', User::class);
            yield MenuItem::linkToCrud('Slope', 'fa fa-list', Slope::class);
            yield MenuItem::linkToCrud('Lift', 'fa fa-list', Lift::class);
        }

        // Define the menu item for the ROLE_ADMIN role
        if ($this->isGranted('ROLE_ADMIN')) {
            $user = $this->getUser();
            yield MenuItem::linkToCrud('Station', 'fa fa-list', Station::class);
            yield MenuItem::linkToCrud('Slope', 'fa fa-list', Slope::class);
            yield MenuItem::linkToCrud('Lift', 'fa fa-list', Lift::class);
        }
    }

}