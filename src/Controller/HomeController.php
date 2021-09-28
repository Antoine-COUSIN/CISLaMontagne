<?php

namespace App\Controller;

use App\Repository\ChiefSpeechRepository;
use App\Repository\StationStoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationCorePictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(StationCorePictureRepository $stationCorePictureRepository, ChiefSpeechRepository $chiefSpeechRepository, StationStoryRepository $stationStoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'station_core_pictures' => $stationCorePictureRepository->findAll(),
            'chief_speeches' => $chiefSpeechRepository->findAll(),
            'station_stories' => $stationStoryRepository->findAll(),
        ]);
    }
}
