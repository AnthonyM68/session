<?php

namespace App\Controller;

use App\Repository\CourseRepository;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    // list category
    // detail catégory 
    // add catégory
    // edit catégory
    // delete catégory 

    // liste course 
    // detail course 
    // delete course

    /**
     * Categories
     *
     */
    #[Route('/category/list', name: 'app_category')]
    public function listCategory(CategoryRepository $CategoryRepository): Response
    {
        $categories = $CategoryRepository->findBy([], ["name" => "ASC"]);

        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
            "categories" => $categories
        ]);
    }
    #[Route('/category/{id}/detail', name: 'detail_category')]
    public function detailCategory(): Response
    {
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }
    #[Route('/category/add', name: 'add_category')]
    public function createCategory(): Response
    {
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }
    #[Route('/catgegory/{id}/edit', name: 'edit_category')]
    public function editCategory(): Response
    {
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }
    #[Route('/category/{id}/delete', name: 'delete_category')]
    public function deleteCategory(): Response
    {
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }
    /**
     *  COURSE
     */
    #[Route('/course/list', name: 'list_course')]
    public function listCours(CourseRepository $CourseRepository): Response
    {
        $courses = $CourseRepository->findAll();

        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
            "courses" => $courses
        ]);
    }

    #[Route('/course/{id}/detail', name: 'detail_course')]
    public function detailCourse(): Response
    {
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }
    #[Route('/course/{id}/delete', name: 'delete_course')]
    public function deleteCourse(): Response
    {
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }
    /**
     *  PROGRAMS
     */
    #[Route('/program/list', name: 'list_program')]
    public function listProgram(ProgramRepository $ProgramRepository): Response
    {
        $programs = $ProgramRepository->findAll();

        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'course/index.html.twig',
            "programs" => $programs
        ]);
    }
    #[Route('/program/{id}/detail', name: 'detail_program')]
    public function detailProgram(): Response
    {
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'course/index.html.twig',
        ]);
    }
    #[Route('/course/{id}/delete', name: 'delete_course')]
    public function deleteProgram(): Response
    {
        return $this->render('course/index.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'course/index.html.twig',
        ]);
    }
}
