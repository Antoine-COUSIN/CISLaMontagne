<?php

namespace App\Controller;

use App\Entity\ControlVehicles;
use App\Form\ControlVehiclesType;
use App\Repository\ControlVehiclesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/control/vehicles')]
class ControlVehiclesController extends AbstractController
{
    #[Route('/', name: 'control_vehicles_index', methods: ['GET'])]
    public function index(ControlVehiclesRepository $controlVehiclesRepository): Response
    {
        return $this->render('control_vehicles/index.html.twig', [
            'control_vehicles' => $controlVehiclesRepository->findByLast(),
        ]);
    }

    #[Route('/new', name: 'control_vehicles_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $controlVehicle = new ControlVehicles();
        $form = $this->createForm(ControlVehiclesType::class, $controlVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($controlVehicle);
            $entityManager->flush();

            return $this->redirectToRoute('control_vehicles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('control_vehicles/new.html.twig', [
            'control_vehicle' => $controlVehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'control_vehicles_show', methods: ['GET'])]
    public function show(ControlVehicles $controlVehicle): Response
    {
        return $this->render('control_vehicles/show.html.twig', [
            'control_vehicle' => $controlVehicle,
        ]);
    }

    #[Route('/{id}/edit', name: 'control_vehicles_edit', methods: ['GET','POST'])]
    public function edit(Request $request, ControlVehicles $controlVehicle): Response
    {
        $form = $this->createForm(ControlVehiclesType::class, $controlVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('control_vehicles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('control_vehicles/edit.html.twig', [
            'control_vehicle' => $controlVehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'control_vehicles_delete', methods: ['POST'])]
    public function delete(Request $request, ControlVehicles $controlVehicle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$controlVehicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($controlVehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('control_vehicles_index', [], Response::HTTP_SEE_OTHER);
    }
}
