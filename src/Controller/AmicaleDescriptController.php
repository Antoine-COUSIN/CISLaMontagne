<?php

namespace App\Controller;

use App\Entity\AmicaleDescript;
use App\Form\AmicaleDescriptType;
use App\Repository\AmicaleDescriptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/amicale_descript")
 */
class AmicaleDescriptController extends AbstractController
{
    /**
     * @Route("/", name="amicale_descript_index", methods={"GET"})
     */
    public function index(AmicaleDescriptRepository $amicaleDescriptRepository): Response
    {
        return $this->render('amicale_descript/index.html.twig', [
            'amicale_descripts' => $amicaleDescriptRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="amicale_descript_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $amicaleDescript = new AmicaleDescript();
        $form = $this->createForm(AmicaleDescriptType::class, $amicaleDescript);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($amicaleDescript);
            $entityManager->flush();

            return $this->redirectToRoute('amicale_descript_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('amicale_descript/new.html.twig', [
            'amicale_descript' => $amicaleDescript,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="amicale_descript_show", methods={"GET"})
     */
    public function show(AmicaleDescript $amicaleDescript): Response
    {
        return $this->render('amicale_descript/show.html.twig', [
            'amicale_descript' => $amicaleDescript,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="amicale_descript_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AmicaleDescript $amicaleDescript): Response
    {
        $form = $this->createForm(AmicaleDescriptType::class, $amicaleDescript);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('amicale_descript_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('amicale_descript/edit.html.twig', [
            'amicale_descript' => $amicaleDescript,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="amicale_descript_delete", methods={"POST"})
     */
    public function delete(Request $request, AmicaleDescript $amicaleDescript): Response
    {
        if ($this->isCsrfTokenValid('delete'.$amicaleDescript->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($amicaleDescript);
            $entityManager->flush();
        }

        return $this->redirectToRoute('amicale_descript_index', [], Response::HTTP_SEE_OTHER);
    }
}
