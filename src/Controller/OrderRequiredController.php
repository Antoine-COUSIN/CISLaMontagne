<?php

namespace App\Controller;

use App\Entity\OrderRequired;
use App\Form\OrderRequiredType;
use App\Repository\OrderRequiredRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order_required')]
class OrderRequiredController extends AbstractController
{
    #[Route('/', name: 'order_required_index', methods: ['GET'])]
    public function index(OrderRequiredRepository $orderRequiredRepository): Response
    {
        return $this->render('order_required/index.html.twig', [
            'order_requireds' => $orderRequiredRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'order_required_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $orderRequired = new OrderRequired();
        $form = $this->createForm(OrderRequiredType::class, $orderRequired);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($orderRequired);
            $entityManager->flush();

            return $this->redirectToRoute('order_required_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_required/new.html.twig', [
            'order_required' => $orderRequired,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'order_required_show', methods: ['GET'])]
    public function show(OrderRequired $orderRequired): Response
    {
        return $this->render('order_required/show.html.twig', [
            'order_required' => $orderRequired,
        ]);
    }

    #[Route('/{id}/edit', name: 'order_required_edit', methods: ['GET','POST'])]
    public function edit(Request $request, OrderRequired $orderRequired): Response
    {
        $form = $this->createForm(OrderRequiredType::class, $orderRequired);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_required_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_required/edit.html.twig', [
            'order_required' => $orderRequired,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'order_required_delete', methods: ['POST'])]
    public function delete(Request $request, OrderRequired $orderRequired): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderRequired->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orderRequired);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_required_index', [], Response::HTTP_SEE_OTHER);
    }
}
