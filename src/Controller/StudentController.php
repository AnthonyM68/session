<?php

namespace App\Controller;

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

    public function listStudents(StudentRepository $StudentRepository): Response
    {
        $students = $StudentRepository->findBy([], ["firstName" => "ASC"]);

        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
            'view_name' => 'student/index.html.twig',
            'slug' => 'student',
            "students" => $students
        ]);
    }





    #[Route('/student/{id}/detail', name: 'detail_student')]
    public function detailStudent(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/student/add', name: 'add_student')]
    public function addStudent(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
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
