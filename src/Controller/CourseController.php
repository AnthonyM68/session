<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CategoryType;

use App\Entity\Program;
use App\Entity\Category;

use App\Repository\CourseRepository;
use App\Repository\ProgramRepository;
use App\Repository\SessionRepository;

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

    /* Categories */

    #[Route('/category/list', name: 'app_category')]
    public function listCategory(CategoryRepository $CategoryRepository): Response
    {
        $categories = $CategoryRepository->findBy([], ["name" => "ASC"]);

        return $this->render('category/category.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'category/category.html.twig',
            'slug' => 'list',
            "categories" => $categories
        ]);
    }
    #[Route('/category/{id}/detail', name: 'detail_category')]
    public function detailCategory(): Response
    {
        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }
    #[Route('/category/add', name: 'add_category')]
    public function createCategory(): Response
    {
        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }

    #[Route('/category/new', name: 'new_category')]
    #[Route('/category/{id}/edit', name: 'edit_category')]

    public function editCategory(Category $category = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$category) {
            $category = new Category();
        }

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $category = $form->getData();
            // prepare PDO
            $entityManager->persist($category);
            // execute PDO
            $entityManager->flush();

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/category.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'category/category.html.twig',
            'slug' => 'add',
            'formAddCategory' => $form,
        ]);
    }

    #[Route('/category/{id}/delete', name: 'delete_category')]
    public function deleteCategory(): Response
    {
        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }

    /* COURSE */
    #[Route('/course/list', name: 'list_course')]
    public function listCours(CourseRepository $CourseRepository): Response
    {
        $courses = $CourseRepository->findAll();

        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
            'slug' => 'course',
            "courses" => $courses
        ]);
    }

    #[Route('/course/category/{id}', name: 'list_course_category')]
    public function listSessionFormation(Category $category, Request $request, CourseRepository $categoryRepository): Response
    {

        $courses = $categoryRepository->findBy(["id_category" => $category->getId()]);

        return $this->render('course/course.html.twig', [
            'controller_name' => 'SessionController',
            'view_name' => 'course/course.html.twig',
            'slug' => 'course',
            "courses" => $courses
        ]);
    }


    #[Route('/course/{id}/detail', name: 'detail_course')]
    public function detailCourse(): Response
    {
        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
        ]);
    }
    #[Route('/course/{id}/delete', name: 'delete_course')]
    public function deleteCourse(): Response
    {
        return $this->render('course/course.html.twig', [
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

        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'course/course.html.twig',
            'slug' => 'program',
            "programs" => $programs
        ]);
    }

    #[Route('/program/{id}/detail', name: 'detail_program')]
    public function detailProgram(Program $program, Request $request, ProgramRepository $programRepository): Response
    {
        if (!$program) {
            $program = new Program();
        }
        return $this->render('program/detail.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'program/detail.html.twig',
            'slug' => 'detail',
            'program' => $program
        ]);
    }

    #[Route('/course/{id}/delete', name: 'delete_course')]
    public function deleteProgram(): Response
    {
        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'course/course.html.twig',
        ]);
    }
}
