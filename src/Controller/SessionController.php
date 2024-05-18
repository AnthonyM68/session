<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\SessionRepository;
use App\Repository\StudentRepository;
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
    public function index(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'home/index.html.twig',
            'slug' => 'formation',
            "formations" => $formations
        ]);
    }
    /* TRAINER */
    #[Route('/trainer/list', name: 'list_trainer')]
    public function listTrainer(FormationRepository $formationRepository): Response
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
    public function listSession(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findAll();

        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/session.html.twig',
            'slug' => 'session',
            "sessions" => $sessions
        ]);
    }







    /* SESSION */
    #[Route('/session/formation/{id}', name: 'list_session_formation')]
    public function listSessionFormation(Formation $formation, Request $request, SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findBy(["id" => $formation->getId()]);

        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/session.html.twig',
            'slug' => 'session',
            "sessions" => $sessions
        ]);
    }




    #[Route('/session/{id}/detail', name: 'detail_session')]
    public function detailSession(Session $session = null, Request $request, StudentRepository $studentRepository): Response
    {
        if (!$session) {
            $session = new Session();
        }
        $notRegister = $studentRepository->findNotRegister($session->getId());

        return $this->render('session/detail.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/detail.html.twig',
            'slug' => 'detail',
            'session' => $session,
            'notRegister' => $notRegister,
        ]);
    }
    // #[Route('/session/{id}/edit', name: 'edit_session')]
    // public function foundSessionByIdFormation()
    // {

    // }



    // #[Route('/session/{id}/formations', name: 'formations_session')]
    // public function formationsSession(Session $session = null, Request $request, FormationRepository $formationRepository): Response
    // {
    //     if (!$session) {
    //         $session = new Session();
    //     }
    //     $formations = $formationRepository->findFormationByIdStudent($session->getId());

    //     return $this->render('formation/formation.html.twig', [
    //         'controller_name' => 'SessionController',
    //         'view_name' => 'formation/formation.html.twig',
    //         'slug' => 'formations',
    //         'formations' => $formations,
    //     ]);
    // }

    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function editSession(): Response
    {
        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }









    /* FORMATION  */
    #[Route('/formation/list', name: 'list_formation')]
    public function listFormation(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();

        return $this->render('formation/formation.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'formation/formation.html.twig',
            'slug' => 'list',
            "formations" => $formations
        ]);
    }
    #[Route('/formation/new', name: 'new_formation')]
    #[Route('/formation/{id}/edit', name: 'edit_formation')]

    public function editFormation(Formation $formation = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$formation) {
            $formation = new Formation();
        }

        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid()) {
            
            $formation = $form->getData();
            // prepare PDO
            $entityManager->persist($formation);
            // execute PDO
            $entityManager->flush();

            return $this->redirectToRoute('formation');
        }

        return $this->render('formation/formation.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'formation/formation.html.twig',
            'slug' => 'add',
            'formAddFormation' => $form,
        ]);
    }



}
