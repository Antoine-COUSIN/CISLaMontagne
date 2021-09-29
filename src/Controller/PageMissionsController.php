<?php

namespace App\Controller;

use App\Repository\EnginsRepository;
use App\Repository\MissionsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageMissionsController extends AbstractController
{
    #[Route('/page_missions', name: 'page_missions')]
    public function index(MissionsRepository $missionsRepository, EnginsRepository $enginsRepository): Response
    {
        return $this->render('page_missions/index.html.twig', [
            'controller_name' => 'PageMissionsController',
            'missions' => $missionsRepository->findAll(),
            'engins' => $enginsRepository->findAll(),
        ]);
    }
}
