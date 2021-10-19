<?php

namespace App\Controller;

use App\Entity\Speciality;
use App\Form\SpecialityType;
use App\Repository\SpecialityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/speciality')]
class SpecialityController extends AbstractController
{
    #[Route('/', name: 'speciality_index', methods: ['GET'])]
    public function index(SpecialityRepository $specialityRepository): Response
    {
        return $this->render('speciality/index.html.twig', [
            'specialities' => $specialityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'speciality_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $speciality = new Speciality();
        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($speciality);
            $entityManager->flush();

            return $this->redirectToRoute('speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('speciality/new.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'speciality_show', methods: ['GET'])]
    public function show(Speciality $speciality): Response
    {
        return $this->render('speciality/show.html.twig', [
            'speciality' => $speciality,
        ]);
    }

    #[Route('/{id}/edit', name: 'speciality_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Speciality $speciality): Response
    {
        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('speciality/edit.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'speciality_delete', methods: ['POST'])]
    public function delete(Request $request, Speciality $speciality): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speciality->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($speciality);
            $entityManager->flush();
        }

        return $this->redirectToRoute('speciality_index', [], Response::HTTP_SEE_OTHER);
    }
}
