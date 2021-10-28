<?php

namespace App\Controller;

use App\Entity\ReportVehicle;
use App\Form\ReportVehicleType;
use App\Repository\ReportVehicleRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/report/vehicle')]
class ReportVehicleController extends AbstractController
{
    #[Route('/', name: 'report_vehicle_index', methods: ['GET'])]
    public function index(ReportVehicleRepository $reportVehicleRepository): Response
    {
        return $this->render('report_vehicle/index.html.twig', [
            'report_vehicles' => $reportVehicleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'report_vehicle_new', methods: ['GET','POST'])]
    public function new(Request $request, MailerInterface $mailer): Response
    {
        $reportVehicle = new ReportVehicle();
        $form = $this->createForm(ReportVehicleType::class, $reportVehicle);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reportVehicle);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from('No_Reply@servicevehicule.fr')
                ->to('ac.acousin@free.fr')
                ->subject('Signalement véhicule')
                ->htmlTemplate('email/reportVehicle.html.twig')
                ->context([
                    'prenom' =>$form->get('user')->getData()->getFirstName(),
                    'nom' =>$form->get('user')->getData()->getLastName(),
                    'vehicle' => $form->get('vehicles')->getData()->getNameVehicle(),
                    'description' => $form->get('reportVehicle')->getData(),
                ]);

                $mailer->send($email);

            $this->addFlash('messageReportVehicle', 'Le report à bien été effectué !');
            return $this->redirectToRoute('report_vehicle_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('report_vehicle/new.html.twig', [
            'report_vehicle' => $reportVehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'report_vehicle_show', methods: ['GET'])]
    public function show(ReportVehicle $reportVehicle): Response
    {
        return $this->render('report_vehicle/show.html.twig', [
            'report_vehicle' => $reportVehicle,
        ]);
    }

    #[Route('/{id}/edit', name: 'report_vehicle_edit', methods: ['GET','POST'])]
    public function edit(Request $request, ReportVehicle $reportVehicle): Response
    {
        $form = $this->createForm(ReportVehicleType::class, $reportVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('report_vehicle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('report_vehicle/edit.html.twig', [
            'report_vehicle' => $reportVehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'report_vehicle_delete', methods: ['POST'])]
    public function delete(Request $request, ReportVehicle $reportVehicle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reportVehicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reportVehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('report_vehicle_index', [], Response::HTTP_SEE_OTHER);
    }
}
