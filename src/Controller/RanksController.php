<?php

namespace App\Controller;

use App\Entity\Ranks;
use App\Form\RanksType;
use App\Repository\RanksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ranks')]
class RanksController extends AbstractController
{
    #[Route('/', name: 'ranks_index', methods: ['GET'])]
    public function index(RanksRepository $ranksRepository): Response
    {
        return $this->render('ranks/index.html.twig', [
            'ranks' => $ranksRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'ranks_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $rank = new Ranks();
        $form = $this->createForm(RanksType::class, $rank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rank);
            $entityManager->flush();

            return $this->redirectToRoute('ranks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ranks/new.html.twig', [
            'rank' => $rank,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'ranks_show', methods: ['GET'])]
    public function show(Ranks $rank): Response
    {
        return $this->render('ranks/show.html.twig', [
            'rank' => $rank,
        ]);
    }

    #[Route('/{id}/edit', name: 'ranks_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Ranks $rank): Response
    {
        $form = $this->createForm(RanksType::class, $rank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ranks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ranks/edit.html.twig', [
            'rank' => $rank,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'ranks_delete', methods: ['POST'])]
    public function delete(Request $request, Ranks $rank): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rank->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rank);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ranks_index', [], Response::HTTP_SEE_OTHER);
    }
}
