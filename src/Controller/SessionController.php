<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{

    // liste des formations 
    // detail formation 
    // ajout etdit d'une formation 
    
    #[Route('/formation/list', name: 'list_formation')]
    public function listFormation(FormationRepository $FormationRepository): Response
    {
        $formations = $FormationRepository->findAll();

        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/index.html.twig',
            "formations" => $formations
        ]);
    }


    #[Route('/formation/{id}/detail', name: 'detail_formation')]
    public function detailFormation(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }


    #[Route('/formation/{id}/edit', name: 'edit_formation')]
    public function editFormation(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
