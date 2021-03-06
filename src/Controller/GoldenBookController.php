<?php

namespace App\Controller;

use App\Entity\GoldenBook;
use App\Form\GoldenBookType;
use App\Repository\GoldenBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/golden_book")
 */
class GoldenBookController extends AbstractController
{
    /**
     * @Route("/", name="golden_book_index", methods={"GET", "POST"})
     */
    public function index(Request $request, GoldenBookRepository $goldenBookRepository): Response
    {
        $this->denyAccessUnlessGranted('PUBLIC_ACCESS');
        $goldenBook = new GoldenBook();
        $form = $this->createForm(GoldenBookType::class, $goldenBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goldenBook);
            $entityManager->flush();

            return $this->redirectToRoute('golden_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('golden_book/index.html.twig', [
            'golden_book' => $goldenBook,
            'form' => $form,
            'golden_books' => $goldenBookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin", name="golden_book_admin", methods={"GET"})
     */
    public function admin(GoldenBookRepository $goldenBookRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('golden_book/admin.html.twig', [
            'golden_books' => $goldenBookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="golden_book_show", methods={"GET"})
     */
    public function show(GoldenBook $goldenBook): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('golden_book/show.html.twig', [
            'golden_book' => $goldenBook,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="golden_book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GoldenBook $goldenBook): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(GoldenBookType::class, $goldenBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('golden_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('golden_book/edit.html.twig', [
            'golden_book' => $goldenBook,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="golden_book_delete", methods={"POST"})
     */
    public function delete(Request $request, GoldenBook $goldenBook): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$goldenBook->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($goldenBook);
            $entityManager->flush();
        }

        return $this->redirectToRoute('golden_book_index', [], Response::HTTP_SEE_OTHER);
    }
}
