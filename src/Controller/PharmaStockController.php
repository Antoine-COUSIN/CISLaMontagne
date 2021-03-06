<?php

namespace App\Controller;

use App\Entity\PharmaStock;
use App\Form\PharmaStockType;
use App\Form\PharmaReplenishmentType;
use App\Repository\PharmaStockRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/pharma_stock')]
class PharmaStockController extends AbstractController
{
    #[Route('/configService', name: 'pharma_stock_configService', methods: ['GET'])] //Page accueil référencement des produits
    public function configService(PharmaStockRepository $pharmaStockRepository): Response
    {
        return $this->render('pharma_stock/configService.html.twig', [
            'pharma_stocks' => $pharmaStockRepository->findAll(),
        ]);
    }

    #[Route('/replenishment', name: 'pharma_stock_replenishment', methods: ['GET'])] //Page accueil gestion des stocks produit cotés service
    public function replenishment(PharmaStockRepository $pharmaStockRepository): Response
    {
        return $this->render('pharma_stock/replenishment.html.twig', [
            'pharma_stocks' => $pharmaStockRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'pharma_stock_index', methods: ['GET'])] //Page d'aceuil réarmement VSAV
    public function index(PharmaStockRepository $pharmaStockRepository): Response
    {
        return $this->render('pharma_stock/index.html.twig', [
            'pharma_stocks' => $pharmaStockRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'pharma_new_product', methods: ['GET','POST'])] //Page
    public function new(Request $request): Response
    {
        $pharmaStock = new PharmaStock();
        $form = $this->createForm(PharmaStockType::class, $pharmaStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // $pharmaStock->setProductsQuantity(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pharmaStock);
            $entityManager->flush();

            return $this->redirectToRoute('pharma_stock_configService', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharma_stock/new.html.twig', [
            'pharma_stock' => $pharmaStock,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'pharma_stock_edit', methods: ['GET','POST'])]
    public function edit(Request $request, PharmaStock $pharmaStock): Response
    {
        $form = $this->createForm(PharmaStockType::class, $pharmaStock);
        $stock = $pharmaStock->getProductsQuantity();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if ($pharmaStock->getProductsQuantity() >= 0)
            {
                $pharmaStock->setProductsQuantity($stock - $pharmaStock->getProductsQuantity());
            } 
            elseif ($pharmaStock->getProductsQuantity() < 0) 
            {
                $pharmaStock->setProductsQuantity($stock + $pharmaStock->getProductsQuantity());
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pharma_stock_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharma_stock/edit.html.twig', [
            'pharma_stock' => $pharmaStock,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editReplenishment', name: 'pharma_stock_editReplenishment', methods: ['GET','POST'])]
    public function editReplenishment(Request $request, PharmaStock $pharmaStock): Response
    {
        $form = $this->createForm(PharmaReplenishmentType::class, $pharmaStock);
        $stock = $pharmaStock->getProductsQuantity();
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {
            $pharmaStock->setProductsQuantity($stock + $pharmaStock->getProductsQuantity());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pharma_stock_replenishment', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharma_stock/editReplenishment.html.twig', [
            'pharma_stock' => $pharmaStock,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pharma_stock_delete', methods: ['POST'])]
    public function delete(Request $request, PharmaStock $pharmaStock): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharmaStock->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pharmaStock);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pharma_stock_index', [], Response::HTTP_SEE_OTHER);
    }
}
