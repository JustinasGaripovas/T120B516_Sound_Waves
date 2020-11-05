<?php

namespace App\Controller;

use App\Repository\SoundPackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SoundPackageController extends AbstractController
{
    /**
     * @Route("/sound_package", name="get_sound_package", methods={"POST"})
     */
    public function getSoundPackage(SoundPackageRepository $soundPackageRepository, Request $request)
    {
        $level = (int) $request->request->get('level');
        $category_id = (int) $request->request->get('category_id');


        $validSoundPackages = $soundPackageRepository->findBy(["level" => $level, "category" => $category_id]);

        return $this->json([
            'sound_packages' => $validSoundPackages],
            200,
            [],
            ['groups' => ['music_list']]);
    }


}
