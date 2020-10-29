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
        $categoryTitles = [];

        foreach ($categoryRepository->findAll() as $category)
        {
            $categoryTitles[] = [
                'id' => $category->getId(),
                'title' => $category->getTitle()
            ];
        }

        return $this->json([
           'categories' => $categoryTitles
        ]);
    }

    /**
     * @Route("/category", name="post_categories", methods={"POST"})
     */
    public function postCategory()
    {

    }
}
