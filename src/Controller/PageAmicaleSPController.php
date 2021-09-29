<?php

namespace App\Controller;

use App\Repository\AmicaleNewsRepository;
use App\Repository\AmicaleDescriptRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageAmicaleSPController extends AbstractController
{
    #[Route('/page_amicale_sp', name: 'page_amicale_sp')]
    public function index(AmicaleDescriptRepository $amicaleDescriptRepository, AmicaleNewsRepository $amicaleNewsRepository): Response
    {
        return $this->render('page_amicale_sp/index.html.twig', [
            'controller_name' => 'PageAmicaleSPController',
            'amicale_descripts' => $amicaleDescriptRepository->findAll(),
            'amicale_news' => $amicaleNewsRepository->findAll(),
        ]);
    }
}
