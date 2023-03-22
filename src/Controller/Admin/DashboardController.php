<?php

namespace App\Controller\Admin;

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
        #return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(DomainCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Rhone Alpes');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToCrud('Station', 'fa fa-cat',Station::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToDashboard('Domain', 'fa fa-home');
            yield MenuItem::linkToCrud('User', 'fa fa-home', User::class);
            yield MenuItem::linkToCrud('Station', 'fa fa-cat',Station::class);
            yield MenuItem::linkToCrud('Slope', 'fa fa-home',Slope::class);
            yield MenuItem::linkToCrud('Lift', 'fa fa-home',Lift::class);

        }
    }







}
