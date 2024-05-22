<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Program;

use App\Entity\Session;
use App\Entity\Category;
use App\Form\CourseType;
use App\Form\CategoryType;
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


    #[Route('/interface', name: 'interface')]
    public function indexy(): Response
    {
        return $this->render('interface/interface.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'interface/interface.html.twig',
        ]);
    }
    #[Route('/tab/category', name: 'tab_category')]
    public function tabCategory(CategoryRepository $CategoryRepository): Response
    {
        $categories = $CategoryRepository->findBy([], ["name" => "ASC"]);
        return $this->render('category/tab/category.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'category/tab/category.html.twig',
            "categories" => $categories
        ]);
    }
    
    #[Route('/category', name: 'list_category')]
    public function listCategory(CategoryRepository $CategoryRepository): Response
    {
        $categories = $CategoryRepository->findBy([], ["name" => "ASC"]);

        return $this->render('category/category.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'category/category.html.twig',
            "categories" => $categories
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

            return $this->redirectToRoute('list_category');
        }

        return $this->render('category/category.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'category/category.html.twig',
            'slug' => 'add',
            'category_id' => $category->getId(),
            'formAddCategory' => $form,
        ]);
    }
    #[Route('/category/{id}/detail', name: 'detail_category')]
    public function detailCategory(): Response
    {
        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'course/course.html.twig',
        ]);
    }
    #[Route('/category/{id}/delete', name: 'delete_category')]
    public function deleteCategory(Category $category, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($category);
        $entityManager->flush();
        return $this->redirectToRoute('list_category');
    }





    /* COURSE */
    #[Route('/course/list', name: 'list_course')]
    public function listCours(Course $course, CourseRepository $CourseRepository): Response
    {
        $courses = $CourseRepository->findAll();

        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'course/course.html.twig',
            'slug' => 'course',
            'course_id' => $course->getId(),
            "courses" => $courses
        ]);
    }



    #[Route('/course/category/{id}', name: 'list_course_category')]
    public function listSessionFormation(Category $category, Request $request, CourseRepository $categoryRepository): Response
    {
        $courses = $categoryRepository->findBy(["category" => $category->getId()]);

        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
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
            'view_name' => 'course/course.html.twig',
        ]);
    }

#[Route('/course/new', name: 'new_course')]
    #[Route('/course/edit/{id}', name: 'edit_course')]
    public function form(Request $request, EntityManagerInterface $entityManager, ?Course $course = null): Response
    {
        if (!$course) {
            $course = new Course();
        }

        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirectToRoute('list_course');
        }

        return $this->render('course/course.html.twig', [
            'controller_name' => 'CourseController',
            'slug' => 'add',
            'view_name' => 'course/course.html.twig',
            'formAddCourse' => $form->createView(),
            'course_id' => $course->getId()
        ]);
    }

    #[Route('/course/{id}/delete', name: 'delete_course')]
    public function deleteCourse(Course $course, Request $request, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($course);
        $entityManager->flush();
        return $this->redirectToRoute('list_course_category', ['id' => $course->getCategory()->getId() ]);
    }
    /**
     *  PROGRAMS
     */
    #[Route('/program', name: 'list_program')]
    public function listProgram(Program $program, Request $request, ProgramRepository $ProgramRepository): Response
    {
        $programs = $ProgramRepository->findAll();

        return $this->render('program/program.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'program/program.html.twig',
            'slug' => 'program',
            "programs" => $programs
        ]);
    }
    #[Route('/tab/program', name: 'tab_program')]
    public function tabProgram(Program $program, Request $request, ProgramRepository $ProgramRepository): Response
    {
        $programs = $ProgramRepository->findAll();

        return $this->render('program/tab/program.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'program/tab/program.html.twig',
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
    #[Route('/program/new', name: 'new_program')]
    #[Route('/program/{id}/edit', name: 'edit_program')]
    public function editProgram(Program $program, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$program) {
            $program = new Program();
        }

        // $form = $this->createForm(CourseType::class, $program);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager->persist($program);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('list_course');
        // }

        return $this->render('program/program.html.twig', [
            'controller_name' => 'CourseController',
            'view_name' => 'program/program.html.twig',
            'slug' => 'add',
            //'formAddProgram' => $form,
            'program' => $program->getId()
        ]);
    }
    #[Route('/program/{id}/delete', name: 'delete_program')]
    public function deleteProgram(): Response
    {
        return $this->render('program/program.html.twig', [
            'controller_name' => 'ProgramController',
            'view_name' => 'program/program.html.twig',
        ]);
    }
}
