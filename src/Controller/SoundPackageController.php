<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SoundPackageController extends AbstractController
{
    /**
     * @Route("/sound/package", name="sound_package")
     */
    public function index()
    {
        return $this->render('sound_package/index.html.twig', [
            'controller_name' => 'SoundPackageController',
        ]);
    }



}
