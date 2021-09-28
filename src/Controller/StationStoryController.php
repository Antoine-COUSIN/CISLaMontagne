<?php

namespace App\Controller;

use App\Entity\StationStory;
use App\Form\StationStoryType;
use App\Repository\StationStoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/station_story")
 */
class StationStoryController extends AbstractController
{
    /**
     * @Route("/", name="station_story_index", methods={"GET"})
     */
    public function index(StationStoryRepository $stationStoryRepository): Response
    {
        return $this->render('station_story/index.html.twig', [
            'station_stories' => $stationStoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="station_story_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stationStory = new StationStory();
        $form = $this->createForm(StationStoryType::class, $stationStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stationStory);
            $entityManager->flush();

            return $this->redirectToRoute('station_story_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('station_story/new.html.twig', [
            'station_story' => $stationStory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="station_story_show", methods={"GET"})
     */
    public function show(StationStory $stationStory): Response
    {
        return $this->render('station_story/show.html.twig', [
            'station_story' => $stationStory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="station_story_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StationStory $stationStory): Response
    {
        $form = $this->createForm(StationStoryType::class, $stationStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('station_story_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('station_story/edit.html.twig', [
            'station_story' => $stationStory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="station_story_delete", methods={"POST"})
     */
    public function delete(Request $request, StationStory $stationStory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stationStory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stationStory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('station_story_index', [], Response::HTTP_SEE_OTHER);
    }
}
