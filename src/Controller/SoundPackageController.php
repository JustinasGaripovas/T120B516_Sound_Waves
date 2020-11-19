<?php

namespace App\Controller;

use App\Controller;
use App\Entity\SoundPackage;
use App\Repository\SoundPackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SoundPackageController extends Controller
{
    /**
     * @Route("/sound_package", name="index_sound_packages")
     */
    public function index(SoundPackageRepository $soundPackageRepository, Request $request)
    {
        $level = (int) $request->get('level');
        $category_id = (int) $request->get('category_id');

        $validSoundPackages = $soundPackageRepository->findBy(["level" => $level, "category" => $category_id]);

        return $this->render("sound_package/index.html.twig", [
            'categories' => $this->getCategories(),
            'soundPackages' => $validSoundPackages
        ]);
    }

    /**
     * @Route("/sound_package/{id}", name="view_sound_packages")
     */
    public function view(SoundPackage $soundPackage)
    {
        return $this->render("sound_package/view.html.twig", [
            'categories' => $this->getCategories(),
            'soundPackage' => $soundPackage
        ]);
    }


}
