<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\RecruitementType;
use App\Repository\EnginsRepository;
use App\Repository\AmicaleNewsRepository;
use App\Repository\ChiefSpeechRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Repository\AmicaleDescriptRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationCorePictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(StationCorePictureRepository $stationCorePictureRepository, ChiefSpeechRepository $chiefSpeechRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'station_core_pictures' => $stationCorePictureRepository->findAll(),
            'chief_speeches' => $chiefSpeechRepository->findAll(),
        ]);
    }

    #[Route('/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('home/admin.html.twig');
    }

    #[Route('/extranet', name: 'extranet')]
    public function extranet(): Response
    {
        return $this->render('home/extranet.html.twig');
    }

    #[Route('/amicale_sp', name: 'amicale_sp')]
    public function amicale_sp(AmicaleDescriptRepository $amicaleDescriptRepository, AmicaleNewsRepository $amicaleNewsRepository): Response
    {
        return $this->render('home/amicale_sp.html.twig', [
            'amicale_descripts' => $amicaleDescriptRepository->findAll(),
            'amicale_news' => $amicaleNewsRepository->findAll(),
        ]);
    }

    #[Route('/nosMissions', name: 'nosMissions')]
    public function nosMissions(EnginsRepository $enginsRepository): Response
    {
        return $this->render('home/nosMissions.html.twig', [
            'engins' => $enginsRepository->findAll(),
        ]);
    }

    #[Route('/rgpd', name: 'rgpd')]
    public function rgpd(): Response
    {
        return $this->render('home/rgpd.html.twig');
    }

    #[Route('/recruitement', name: 'recruitement')]
    public function recruitement(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(RecruitementType::class);

        $contact = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $email = (new TemplatedEmail())
            ->from($contact->get('email')->getData())
            ->to('ac.acousin@free.fr')
            ->subject('contact depuis le site caserne')
            ->htmlTemplate('email/recruitementMail.html.twig')
            ->context([
                'prenom' => $contact->get('firstname')->getData(),
                'nom' => $contact->get('lastname')->getData(),
                'mail' => $contact->get('email')->getData(),
                'message' => $contact->get('message')->getData(),
            ]);

            $mailer->send($email);

            $this->addFlash('sendMessage', 'Message envoyé');
            return $this->redirectToRoute('recruitement');
        }

        return $this->render('home/recruitement.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/urgency_phone', name: 'urgency_phone')]
    public function urgency_phone(): Response
    {
        return $this->render('home/urgency_phone.html.twig', [
            'controller_name' => 'UrgencyPhoneController',
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $contact = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $email = (new TemplatedEmail())
                ->from($contact->get('email')->getData())
                ->to('ac.acousin@free.fr')
                ->subject('contact depuis le site caserne')
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    'prenom' => $contact->get('firstname')->getData(),
                    'nom' => $contact->get('lastname')->getData(),
                    'mail' => $contact->get('email')->getData(),
                    'sujet' => $contact->get('subject')->getData(),
                    'message' => $contact->get('message')->getData(),
                ]);

                $mailer->send($email);

            $this->addFlash('sendMessage', 'Message envoyé');
            return $this->redirectToRoute('contact');
        }

        return $this->render('home/contact.html.twig', [
            'form' => $form->createView(),
        ])
        ;
    }

    #[Route('/bugSignalement', name: 'bugSignalement')]
    public function bugSignalement(): Response
    {
        return $this->render('home/bugSignalement.html.twig', [
            'controller_name' => 'UrgencyPhoneController',
        ]);
    }
}
