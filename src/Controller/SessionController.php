<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{

    // liste des formations 
    // detail formation 
    // ajout etdit d'une formation 

    /* HOME */

    #[Route('/formation', name: 'formation')]
    public function index(FormationRepository $FormationRepository): Response
    {
        $formations = $FormationRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'home/index.html.twig',
            'slug' => 'formation',
            "formations" => $formations
        ]);
    }
    /* TRAINER */
    #[Route('/trainer/list', name: 'list_trainer')]
    public function listTrainer(FormationRepository $FormationRepository): Response
    {
        // recherche les formateurs
        return $this->render('trainer/trainer.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'trainer/trainer.html.twig',
            'slug' => 'trainer',
            "trainer" => null
        ]);
    }

    /* SESSION */

    #[Route('/session/list', name: 'list_session')]
    public function listSession(SessionRepository $SessionRepository): Response
    {
        $sessions = $SessionRepository->findAll();

        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/session.html.twig',
            'slug' => 'session',
            "sessions" => $sessions
        ]);
    }

    #[Route('/session/{id}/detail', name: 'detail_session')]
    public function detailsSession(): Response
    {
        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }

    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function editSession(): Response
    {
        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }


    /* FORMATION  */

    #[Route('/formation/list', name: 'list_formation')]
    public function listFormation(FormationRepository $FormationRepository): Response
    {
        $formations = $FormationRepository->findAll();

        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/session.html.twig',
            'slug' => 'formation',
            "formations" => $formations
        ]);
    }

    #[Route('/formation/{id}/detail', name: 'detail_formation')]
    public function detailFormation(): Response
    {
        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }

    #[Route('/formation/{id}/edit', name: 'edit_formation')]
    public function editFormation(): Response
    {
        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }



}
