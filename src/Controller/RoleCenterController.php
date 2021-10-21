<?php

namespace App\Controller;

use App\Entity\RoleCenter;
use App\Form\RoleCenterType;
use App\Repository\RoleCenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/role_center')]
class RoleCenterController extends AbstractController
{
    #[Route('/', name: 'role_center_index', methods: ['GET'])]
    public function index(RoleCenterRepository $roleCenterRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('role_center/index.html.twig', [
            'role_centers' => $roleCenterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'role_center_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $roleCenter = new RoleCenter();
        $form = $this->createForm(RoleCenterType::class, $roleCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($roleCenter);
            $entityManager->flush();

            return $this->redirectToRoute('role_center_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('role_center/new.html.twig', [
            'role_center' => $roleCenter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'role_center_show', methods: ['GET'])]
    public function show(RoleCenter $roleCenter): Response
    {
        return $this->render('role_center/show.html.twig', [
            'role_center' => $roleCenter,
        ]);
    }

    #[Route('/{id}/edit', name: 'role_center_edit', methods: ['GET','POST'])]
    public function edit(Request $request, RoleCenter $roleCenter): Response
    {
        $form = $this->createForm(RoleCenterType::class, $roleCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('role_center_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('role_center/edit.html.twig', [
            'role_center' => $roleCenter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'role_center_delete', methods: ['POST'])]
    public function delete(Request $request, RoleCenter $roleCenter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roleCenter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($roleCenter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('role_center_index', [], Response::HTTP_SEE_OTHER);
    }
}
