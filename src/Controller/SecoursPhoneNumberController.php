<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecoursPhoneNumberController extends AbstractController
{
    #[Route('/secours_phone_number', name: 'secours_phone_number')]
    public function index(): Response
    {
        return $this->render('secours_phone_number/index.html.twig', [
            'controller_name' => 'SecoursPhoneNumberController',
        ]);
    }
}
