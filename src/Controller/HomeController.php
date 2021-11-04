<?php

namespace App\Controller;

use App\Repository\EnginsRepository;
use App\Repository\AmicaleNewsRepository;
use App\Repository\ChiefSpeechRepository;
use App\Repository\AmicaleDescriptRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationCorePictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(StationCorePictureRepository $stationCorePictureRepository, ChiefSpeechRepository $chiefSpeechRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'station_core_pictures' => $stationCorePictureRepository->findAll(),
            'chief_speeches' => $chiefSpeechRepository->findAll(),
        ]);
    }

    #[Route('/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('home/admin.html.twig');
    }

    #[Route('/extranet', name: 'extranet')]
    public function extranet(): Response
    {
        return $this->render('home/extranet.html.twig');
    }

    #[Route('/amicale_sp', name: 'amicale_sp')]
    public function amicale_sp(AmicaleDescriptRepository $amicaleDescriptRepository, AmicaleNewsRepository $amicaleNewsRepository): Response
    {
        return $this->render('home/amicale_sp.html.twig', [
            'amicale_descripts' => $amicaleDescriptRepository->findAll(),
            'amicale_news' => $amicaleNewsRepository->findAll(),
        ]);
    }

    #[Route('/nosMissions', name: 'nosMissions')]
    public function nosMissions(EnginsRepository $enginsRepository): Response
    {
        return $this->render('home/nosMissions.html.twig', [
            'engins' => $enginsRepository->findAll(),
        ]);
    }

    #[Route('/rgpd', name: 'rgpd')]
    public function rgpd(EnginsRepository $enginsRepository): Response
    {
        return $this->render('home/rgpd.html.twig', [
            'engins' => $enginsRepository->findAll(),
        ]);
    }
}
