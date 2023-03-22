<?php

namespace App\Controller;



use App\Repository\DomainRepository;

use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{


    #[Route('/', name: 'app_index')]
    public function index(DomainRepository $domainRepository ): Response
    {
        return $this->render('app/index.html.twig', [
            //'controller_name' => 'AppController',
            'domains' => $domainRepository->findAll(),
        ]);
    }

    #[Route('/category/{id}', name: 'app_domain')]
    public function category($id, DomainRepository $domainRepository, StationRepository $stationRepository): Response
    {
        $domain = $domainRepository->find($id);

        if(!$domain){
            throw $this->createNotFoundException('Category not found');
        }

        return $this->render('app/domain.html.twig', [
            'domain' => $domain,
            'stations' => $stations,
        ]);
    }

    }
