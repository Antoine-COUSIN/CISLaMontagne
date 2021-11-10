<?php

namespace App\Controller;

use App\Entity\StationCorePicture;
use App\Form\StationCorePictureType;
use App\Repository\StationCorePictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/station_core_picture")
 */
class StationCorePictureController extends AbstractController
{
    /**
     * @Route("/", name="station_core_picture_index", methods={"GET"})
     */
    public function index(StationCorePictureRepository $stationCorePictureRepository): Response
    {
        return $this->render('station_core_picture/index.html.twig', [
            'station_core_pictures' => $stationCorePictureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="station_core_picture_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $stationCorePicture = new StationCorePicture();
        $form = $this->createForm(StationCorePictureType::class, $stationCorePicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** Début du code à ajouter **/
            $stationPicture = $form->get('picture')->getData();
            if ($stationPicture) {
                $originalFilename = pathinfo($stationPicture->getClientOriginalName(), PATHINFO_FILENAME);
                // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$stationPicture->guessExtension();
                // Déplacez le fichier dans le répertoire où les brochures sont stockées
                try {
                    $stationPicture->move(
                        $this->getParameter('photos_directory').'/stationPicture',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                }
                // met à jour la propriété 'stationPicture' pour stocker le nom du fichier PDF
                // au lieu de son contenu
                $stationCorePicture->setPicture($newFilename);
            }
                /** Fin du code à ajouter **/

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stationCorePicture);
            $entityManager->flush();

            return $this->redirectToRoute('station_core_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('station_core_picture/new.html.twig', [
            'station_core_picture' => $stationCorePicture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="station_core_picture_show", methods={"GET"})
     */
    public function show(StationCorePicture $stationCorePicture): Response
    {
        return $this->render('station_core_picture/show.html.twig', [
            'station_core_picture' => $stationCorePicture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="station_core_picture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StationCorePicture $stationCorePicture, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(StationCorePictureType::class, $stationCorePicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            /** Début du code à ajouter **/
            $stationPicture = $form->get('picture')->getData();
            if ($stationPicture) {
                $originalFilename = pathinfo($stationPicture->getClientOriginalName(), PATHINFO_FILENAME);
                // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$stationPicture->guessExtension();
                // Déplacez le fichier dans le répertoire où les brochures sont stockées
                try {
                    $stationPicture->move(
                        $this->getParameter('photos_directory').'/stationPicture',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                }
                // met à jour la propriété 'stationPicture' pour stocker le nom du fichier PDF
                // au lieu de son contenu
                $stationCorePicture->setPicture($newFilename);
            }
                /** Fin du code à ajouter **/

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('station_core_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('station_core_picture/edit.html.twig', [
            'station_core_picture' => $stationCorePicture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="station_core_picture_delete", methods={"POST"})
     */
    public function delete(Request $request, StationCorePicture $stationCorePicture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stationCorePicture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stationCorePicture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('station_core_picture_index', [], Response::HTTP_SEE_OTHER);
    }
}
