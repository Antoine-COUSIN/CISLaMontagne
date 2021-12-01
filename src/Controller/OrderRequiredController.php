<?php

namespace App\Controller;

use App\Entity\OrderStatus;
use App\Entity\OrderRequired;
use App\Form\StatusChangeType;
use App\Form\OrderRequiredType;
use App\Repository\OrderStatusRepository;
use App\Repository\OrderRequiredRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/order_required')]
class OrderRequiredController extends AbstractController
{
    #[Route('/', name: 'order_required_index')]
    public function index(OrderRequiredRepository $orderRequiredRepository, OrderStatusRepository $orderStatusRepository, Request $request): Response
    {
        if ($request->request->count() > 0)
        {
            $data = $request->request->get('order_required_order_status'); // Première intention avant de tenter de le mettre direct dans le setOrderStatus
            $idTarget = $request->request->get('id-target');

            $entityManager = $this->getDoctrine()->getManager();
            $product = $entityManager->getRepository(OrderRequired::class)->find($idTarget);
            $newStatus = $entityManager->getRepository(OrderStatus::class)->find($data);
            $product->setOrderStatus($newStatus);
            $entityManager->flush();

            return $this->json(['code' => 200, 'Message' => 'Ca fonctionne bien'], 200 );
        } 

        return $this->render('order_required/index.html.twig', [
            'order_requireds' => $orderRequiredRepository->findAll(),
            'order_statuses' => $orderStatusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'order_required_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser(); // Pour set la jointure

        $orderRequired = new OrderRequired();
        $form = $this->createForm(OrderRequiredType::class, $orderRequired, [
                'user_readonly_value' => $user->getUserIdentity() // On imagine que cela provient de $user->getUserIdentity()
            ]
        ); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $orderRequired = $form->getData(); // Récupération des valeurs mappées

            $orderRequired->setUser($user); // Set de la jointure 

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
