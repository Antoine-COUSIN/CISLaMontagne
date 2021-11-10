<?php

namespace App\Controller;

use App\Entity\AmicaleNews;
use App\Form\AmicaleNewsType;
use App\Repository\AmicaleNewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/amicale_news")
 */
class AmicaleNewsController extends AbstractController
{
    /**
     * @Route("/", name="amicale_news_index", methods={"GET"})
     */
    public function index(AmicaleNewsRepository $amicaleNewsRepository): Response
    {
        return $this->render('amicale_news/index.html.twig', [
            'amicale_news' => $amicaleNewsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="amicale_news_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $amicaleNews = new AmicaleNews();
        $form = $this->createForm(AmicaleNewsType::class, $amicaleNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** Début du code à ajouter **/
            $imgNews = $form->get('img')->getData();
            if ($imgNews) {
                $originalFilename = pathinfo($imgNews->getClientOriginalName(), PATHINFO_FILENAME);
                // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imgNews->guessExtension();
                // Déplacez le fichier dans le répertoire où les brochures sont stockées
                try {
                    $imgNews->move(
                        $this->getParameter('photos_directory').'/imgNews',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                }
                // met à jour la propriété 'stationPicture' pour stocker le nom du fichier PDF
                // au lieu de son contenu
                $amicaleNews->setImg($newFilename);
            }
                /** Fin du code à ajouter **/

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($amicaleNews);
            $entityManager->flush();

            return $this->redirectToRoute('amicale_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('amicale_news/new.html.twig', [
            'amicale_news' => $amicaleNews,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="amicale_news_show", methods={"GET"})
     */
    public function show(AmicaleNews $amicaleNews): Response
    {
        return $this->render('amicale_news/show.html.twig', [
            'amicale_news' => $amicaleNews,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="amicale_news_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AmicaleNews $amicaleNews, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(AmicaleNewsType::class, $amicaleNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            /** Début du code à ajouter **/
            $imgNews = $form->get('img')->getData();
            if ($imgNews) {
                $originalFilename = pathinfo($imgNews->getClientOriginalName(), PATHINFO_FILENAME);
                // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imgNews->guessExtension();
                // Déplacez le fichier dans le répertoire où les brochures sont stockées
                try {
                    $imgNews->move(
                        $this->getParameter('photos_directory').'/imgNews',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                }
                // met à jour la propriété 'stationPicture' pour stocker le nom du fichier PDF
                // au lieu de son contenu
                $amicaleNews->setImg($newFilename);
            }
                /** Fin du code à ajouter **/

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('amicale_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('amicale_news/edit.html.twig', [
            'amicale_news' => $amicaleNews,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="amicale_news_delete", methods={"POST"})
     */
    public function delete(Request $request, AmicaleNews $amicaleNews): Response
    {
        if ($this->isCsrfTokenValid('delete'.$amicaleNews->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($amicaleNews);
            $entityManager->flush();
        }

        return $this->redirectToRoute('amicale_news_index', [], Response::HTTP_SEE_OTHER);
    }
}
