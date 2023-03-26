<?php

namespace App\Controller;



use App\Repository\DomainRepository;
use App\Repository\StationRepository;
use App\Repository\SlopeRepository;
use App\Repository\LiftRepository;

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
            'controller_name' => 'AppController',
            'domains' => $domainRepository->findAll(),
        ]);
    }

    #[Route('/domain/{id}', name: 'app_domain')]
    public function domain($id, DomainRepository $domainRepository): Response
    {
        $domain = $domainRepository->find($id);

        if (!$domain) {
            throw $this->createNotFoundException('Domain not found');
        }

        return $this->render('app/domain.html.twig', [
            'domain' => $domain,
        ]);
    }


    #[Route('/station/{id}', name: 'app_station')]
    public function station($id, StationRepository $stationRepository, LiftRepository $liftRepository,DomainRepository $domainRepository): Response
    {
        $station = $stationRepository->find($id);

        if (!$station) {
            throw $this->createNotFoundException('Station not found');
        }

        $lift = $station->getLifts()[0];
        $lifts = $liftRepository->findBy(['station' => $station]);

        return $this->render('app/station.html.twig', [
            'domains' => $domainRepository->findAll(),
            'station' => $station,
            'lift' => $lift,
            'lifts' => $lifts,
        ]);
    }


    #[Route('/slope/{id}', name: 'app_slope')]

    public function slope($id, SlopeRepository $slopeRepository, DomainRepository $domainRepository): Response
    {
        $slope = $slopeRepository->find($id);

        if (!$slope) {
            throw $this->createNotFoundException('Slope not found');
        }

        return $this->render('app/slope.html.twig', [
            'domains' => $domainRepository->findAll(),
            'slope' => $slope,
        ]);
    }

    }
