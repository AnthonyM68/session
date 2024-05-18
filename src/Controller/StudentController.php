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
    // liste students 
    // detail student 
    // ajout student 
    // delete student


    #[Route('/student/list', name: 'list_student')]

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

    #[Route('/student/{id}/detail', name: 'detail_student')]
    public function detailStudent(Student $student = null, Request $request, StudentRepository $studentRepository): Response
    {
        if (!$student) {
            $student = new Student();
        }
        return $this->render('student/detail.html.twig', [
            'controller_name' => 'StudentController',
            'view_name' => 'student/detail.html.twig',
            'student' => $student,
            'slug' => 'detail'
        ]);
    }


    #[Route('/student/new', name: 'new_student')]
    #[Route('/student/{id}edit', name: 'edit_student')]

    public function editStudent(Student $student, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$student) {
            $student = new Student();
        }

        $form = $this->createForm(StudentType::class, $student);

        if($form->isSubmitted() && $form->isValid()) {

            $student = $form->getData();

            $entityManager->persist($student);

            return $this->redirectToRoute('');
        }

        return $this->render('student/new.html.twig', [
            'controller_name' => 'StudentController',
            'view_name' => 'student/new.html.twig',
            'slug' => 'add',
            'formAddStudent' => $form,
        ]);
    }


    #[Route('/student/{id}/delete', name: 'delete_student')]
    public function deleteStudent(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
}
