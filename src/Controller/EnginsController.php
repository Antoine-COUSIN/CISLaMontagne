<?php

namespace App\Controller;

use App\Entity\Engins;
use App\Form\EnginsType;
use App\Repository\EnginsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/engins")
 */
class EnginsController extends AbstractController
{
    /**
     * @Route("/", name="engins_index", methods={"GET"})
     */
    public function index(EnginsRepository $enginsRepository): Response
    {
        return $this->render('engins/index.html.twig', [
            'engins' => $enginsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="engins_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $engin = new Engins();
        $form = $this->createForm(EnginsType::class, $engin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** Début du code à ajouter **/
            $enginpicture = $form->get('enginpicture')->getData();
            if ($enginpicture) {
                $originalFilename = pathinfo($enginpicture->getClientOriginalName(), PATHINFO_FILENAME);
                // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$enginpicture->guessExtension();
                // Déplacez le fichier dans le répertoire où les brochures sont stockées
                try {
                    $enginpicture->move(
                        $this->getParameter('photos_directory').'/engins',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                }
                // met à jour la propriété 'stationPicture' pour stocker le nom du fichier PDF
                // au lieu de son contenu
                $engin->setEnginPicture($newFilename);
            }
                /** Fin du code à ajouter **/

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($engin);
            $entityManager->flush();

            return $this->redirectToRoute('engins_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('engins/new.html.twig', [
            'engin' => $engin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="engins_show", methods={"GET"})
     */
    public function show(Engins $engin): Response
    {
        return $this->render('engins/show.html.twig', [
            'engin' => $engin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="engins_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Engins $engin): Response
    {
        $form = $this->createForm(EnginsType::class, $engin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('engins_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('engins/edit.html.twig', [
            'engin' => $engin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="engins_delete", methods={"POST"})
     */
    public function delete(Request $request, Engins $engin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$engin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($engin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('engins_index', [], Response::HTTP_SEE_OTHER);
    }
}
