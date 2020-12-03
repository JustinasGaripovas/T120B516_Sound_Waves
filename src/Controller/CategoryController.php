<?php

namespace App\Controller;

use App\Controller;
use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{id}", name="view_category")
     */
    public function view(Category $category)
    {
        $user = $this->getUser() !== null ? $this->getUser()->getUsername() : null;
        return $this->render("category/view.html.twig",
            [
                'category' => $category,
                'categories' => $this->getCategories(),
                'user' => $user
            ]
        );
    }
}
