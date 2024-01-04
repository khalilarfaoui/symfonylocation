<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use App\VoitureForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'app_voiture')]
    public function listeVoiture(VoitureRepository $vr): Response
    {
        $voitures = $vr->findAll();
        return $this->render('voiture/listeVoiture.html.twig', [
            'listeVoiture' => $voitures,
        ]);
    }

    #[Route('/voiture/{id}', name: 'voitureDelete')]
    public function delete(EntityManagerInterface $em , VoitureRepository $vr , $id): Response
    {
        $voiture = $vr->find($id);
        $em->remove($voiture);
        return $this->redirectToRoute("app_voiture");
    }

    #[Route('/addVoiture', name: 'addVoiture')]
    public function addVoiture(EntityManagerInterface $em , Request $request): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureForm::class , $voiture);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute("app_voiture");
        }
        return $this->render("voiture/addVoiture.html.twig" , ["formV"=>$form->createView()]);
    }
}
