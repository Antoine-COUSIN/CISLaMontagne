<?php

namespace App\Controller;

use App\Entity\ChiefSpeech;
use App\Form\ChiefSpeechType;
use App\Repository\ChiefSpeechRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/chief_speech")
 */
class ChiefSpeechController extends AbstractController
{
    /**
     * @Route("/", name="chief_speech_index", methods={"GET"})
     */
    public function index(ChiefSpeechRepository $chiefSpeechRepository): Response
    {
        return $this->render('chief_speech/index.html.twig', [
            'chief_speeches' => $chiefSpeechRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chief_speech_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $chiefSpeech = new ChiefSpeech();
        $form = $this->createForm(ChiefSpeechType::class, $chiefSpeech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** Début du code à ajouter **/
            $chiefPicture = $form->get('picture')->getData();
            if ($chiefPicture) {
                $originalFilename = pathinfo($chiefPicture->getClientOriginalName(), PATHINFO_FILENAME);
                // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$chiefPicture->guessExtension();
                // Déplacez le fichier dans le répertoire où les brochures sont stockées
                try {
                    $chiefPicture->move(
                        $this->getParameter('photos_directory').'/chiefPicture',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                }
                // met à jour la propriété 'stationPicture' pour stocker le nom du fichier PDF
                // au lieu de son contenu
                $chiefSpeech->setPicture($newFilename);
            }
                /** Fin du code à ajouter **/

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chiefSpeech);
            $entityManager->flush();

            return $this->redirectToRoute('chief_speech_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chief_speech/new.html.twig', [
            'chief_speech' => $chiefSpeech,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="chief_speech_show", methods={"GET"})
     */
    public function show(ChiefSpeech $chiefSpeech): Response
    {
        return $this->render('chief_speech/show.html.twig', [
            'chief_speech' => $chiefSpeech,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chief_speech_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ChiefSpeech $chiefSpeech, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ChiefSpeechType::class, $chiefSpeech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            /** Début du code à ajouter **/
            $chiefPicture = $form->get('picture')->getData();
            if ($chiefPicture) {
                $originalFilename = pathinfo($chiefPicture->getClientOriginalName(), PATHINFO_FILENAME);
                // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$chiefPicture->guessExtension();
                // Déplacez le fichier dans le répertoire où les brochures sont stockées
                try {
                    $chiefPicture->move(
                        $this->getParameter('photos_directory').'/chiefPicture',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                }
                // met à jour la propriété 'stationPicture' pour stocker le nom du fichier PDF
                // au lieu de son contenu
                $chiefSpeech->setPicture($newFilename);
            }
                /** Fin du code à ajouter **/

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chief_speech_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chief_speech/edit.html.twig', [
            'chief_speech' => $chiefSpeech,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="chief_speech_delete", methods={"POST"})
     */
    public function delete(Request $request, ChiefSpeech $chiefSpeech): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chiefSpeech->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chiefSpeech);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chief_speech_index', [], Response::HTTP_SEE_OTHER);
    }
}
