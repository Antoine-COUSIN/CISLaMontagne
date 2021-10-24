<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrgencyPhoneController extends AbstractController
{
    #[Route('/urgency_phone', name: 'urgency_phone')]
    public function index(): Response
    {
        return $this->render('urgency_phone/index.html.twig', [
            'controller_name' => 'UrgencyPhoneController',
        ]);
    }
}
