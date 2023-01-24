<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $categoryManager = $doctrine->getRepository(Category::class);
        $categories = $categoryManager->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/category/new', name: 'app_new_category')]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $category = new Category;
        
        $form = $this
            ->createForm(CategoryType::class, $category)
            ->add('save', SubmitType::class, ['label' => 'Ajouter']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Une nouvelle catégorie a été enregistrée !');

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/new.html.twig', [
            'controller_name' => 'CategoryController',
            'form' => $form
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_details')]
    public function show(ManagerRegistry $doctrine, $id)
    {
        $categoryRepository = $doctrine->getRepository(Category::class);
        $category = $categoryRepository->find($id);

        return $this->render('category/details.html.twig', [
            'category' => $category
        ]);
    }
}
