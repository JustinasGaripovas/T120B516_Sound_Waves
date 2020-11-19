<?php

namespace App\Controller;

use App\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('home/index.html.twig',[
            'categories' => $this->getCategories()
        ]);
    }
}
