<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }

    // #[route('/{categoryName}', route_name: 'show')]
    // public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository)
    // {
    //     $category = $categoryRepository->findOneBy(['category_name' => $categoryName]);

    //     if (!$category) {
    //         throw $this->createNotFoundException(
    //             'No program found for this category : ' . $category
    //         );
    //     } else {
    //         $program = $programRepository->findBy(['category_name' => $categoryName]);
    //     }
    // }
}
