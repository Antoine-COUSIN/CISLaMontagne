<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeBackOfficeController extends AbstractController
{
    /**
     * @Route("/home_back_office", name="home_back_office")
     */
    public function index(): Response
    {
        return $this->render('home_back_office/index.html.twig', [
            'controller_name' => 'HomeBackOfficeController',
        ]);
    }
}
