<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeExtranetController extends AbstractController
{
    /**
     * @Route("/home_extranet", name="home_extranet")
     */
    public function index(): Response
    {
        return $this->render('home_extranet/index.html.twig', [
            'controller_name' => 'HomeExtranetController',
        ]);
    }
}
