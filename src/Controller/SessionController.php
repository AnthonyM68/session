<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{

    // liste des formations 
    // detail formation 
    // ajout etdit d'une formation 
    
    #[Route('/formation/list', name: 'list_formation')]
    public function listFormation(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
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
