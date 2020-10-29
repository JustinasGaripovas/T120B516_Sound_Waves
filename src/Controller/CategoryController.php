<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="get_categories", methods={"GET"})
     */
    public function getAllCategories(CategoryRepository $categoryRepository)
    {
        return $this->json([
           'categories' => $categoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/category", name="post_categories", methods={"POST"})
     */
    public function postCategory()
    {

    }
}
