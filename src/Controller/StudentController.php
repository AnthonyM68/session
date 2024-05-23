<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;

use Doctrine\ORM\EntityManager;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{

    #[Route('/profile', name: 'profile')]

    public function profileUser(StudentRepository $studentRepository): Response
    {
    
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'StudentController',
            'view_name' => 'profile/profile.html.twig'
        ]);
    }

    #[Route('/student', name: 'list_student')]

    public function listStudents(StudentRepository $studentRepository): Response
    {
        $students = $studentRepository->findBy([], ["firstName" => "ASC"]);

        return $this->render('student/student.html.twig', [
            'controller_name' => 'StudentController',
            'view_name' => 'student/student.html.twig',
            'slug' => 'list',
            "students" => $students
        ]);
    }
    #[Route('/tab/student', name: 'tab_student')]

    public function tabStudents(StudentRepository $studentRepository): Response
    {
        $students = $studentRepository->findBy([], ["firstName" => "ASC"]);

        return $this->render('student/tab/student.html.twig', [
            'controller_name' => 'StudentController',
            'view_name' => 'student/tab/student.html.twig',
            'slug' => 'list',
            "students" => $students
        ]);
    }
    #[Route('/student/{id}/detail', name: 'detail_student')]
    public function detailStudent(Student $student = null, Request $request, StudentRepository $studentRepository): Response
    {
        if (!$student) {
            $student = new Student();
        }
        return $this->render('student/detail.html.twig', [
            'controller_name' => 'StudentController',
            'view_name' => 'student/detail.html.twig',
            'student' => $student
        ]);
    }


    #[Route('/student/new', name: 'new_student')]
    #[Route('/student/{id}/edit', name: 'edit_student')]

    public function editStudent(Student $student = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$student) {
            $student = new Student();
        }

        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $student = $form->getData();
            // prepare PDO
            $entityManager->persist($student);
            // execute PDO
            $entityManager->flush();

            return $this->redirectToRoute('list_student');
        }

        return $this->render('student/new.html.twig', [
            'controller_name' => 'StudentController',
            'view_name' => 'student/new.html.twig',
            'formAddStudent' => $form,
            'student_id' => $student->getId()
        ]);
    }


    #[Route('/student/{id}/delete', name: 'delete_student')]
    public function deleteStudent(Student $student, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($student);
        $entityManager->flush();
        return $this->redirectToRoute('list_student');
    }
}
