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
    #[Route('/home', name: 'home')]
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
    #[Route('/trainer', name: 'list_trainer')]
    public function listTrainer(FormationRepository $formationRepository): Response
    {
        // recherche les formateurs
        return $this->render('trainer/trainer.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'trainer/trainer.html.twig',
            "trainer" => null
        ]);
    }
    #[Route('/tab/trainer', name: 'tab_trainer')]
    public function tabTrainer(FormationRepository $formationRepository): Response
    {
        // recherche les formateurs
        return $this->render('trainer/tab/trainer.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'trainer/tab/trainer.html.twig',
            "trainer" => null
        ]);
    }




    /* SESSION */
    #[Route('/session', name: 'list_session')]
    public function listSession(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findAll();

        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/session.html.twig',
            "sessions" => $sessions
        ]);
    }
    #[Route('/tab/session', name: 'tab_session')]
    public function tabSession(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findAll();

        return $this->render('session/tab/session.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/tab/session.html.twig',
            "sessions" => $sessions
        ]);
    }


    /* SESSION */

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


    #[Route('/session/new', name: 'session_session')]
    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function editSession(Session $session, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$session) {
            $session = new Session();
        }
        return $this->render('session/session.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'session/session.html.twig',
            //'formAddSession' => $form,
            'edit' => $session->getId()
        ]);
    }









    /* FORMATION  */    
    
    #[Route('/formation', name: 'list_formation')]
    public function listFormation(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();

        return $this->render('formation/formation.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'formation/formation.html.twig',
            "formations" => $formations
        ]);
    }
    #[Route('/tab/formation', name: 'tab_formation')]
    public function tabFormation(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();

        return $this->render('formation/tab/formation.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'formation/tab/formation.html.twig',
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


    /* LISTE DES MODULES D'UNE FORMATION */
    #[Route('/formation/{id}/detail', name: 'detail_formation')]
    public function detailFormation(Formation $formation, Request $request, SessionRepository $sessionRepository): Response
    {
        $formations = $sessionRepository->findBy(["id" => $formation->getId()]);
        return $this->render('formation/detail.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'formation/detail.html.twig',
            'name' => $formation->getName(),
            "formations" => $formations
        ]);
    }
    #[Route('/formation/{id}/delete', name: 'delete_formation')]
    public function deleteFormation(Formation $formation, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($formation);
        $entityManager->flush();
        return $this->redirectToRoute('list_formation');
    }
}
