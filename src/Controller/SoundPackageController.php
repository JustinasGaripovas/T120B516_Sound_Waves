<?php

namespace App\Controller;

use App\Controller;
use App\Entity\Score;
use App\Entity\SoundFile;
use App\Entity\SoundPackage;
use App\Entity\User;
use App\Form\ScoreType;
use App\Form\SoundPackageType;
use App\Repository\SoundPackageRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/sound/package")
 */
class SoundPackageController extends Controller
{
    /**
     * @Route("/", name="index_sound_packages")
     */
    public function index(SoundPackageRepository $soundPackageRepository, Request $request)
    {
        $level = (int) $request->get('level');
        $category_id = (int) $request->get('category_id');
        $user = $this->getUser() !== null ? $this->getUser()->getUsername() : null;


        $validSoundPackages = $soundPackageRepository->findBy(["level" => $level, "category" => $category_id]);

        return $this->render("sound_package/index.html.twig", [
            'categories' => $this->getCategories(),
            'soundPackages' => $validSoundPackages,
            'user' => $user
        ]);
    }

    /**
     * @Route("/new", name="sound_package_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger)
    {
        $soundPackage = new SoundPackage();
        $form = $this->createForm(SoundPackageType::class, $soundPackage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('brochure')->getData();

            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('upload-directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $soundPackage->setFilename($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($soundPackage);
            $entityManager->flush();

            return $this->redirectToRoute('default');
        }

        return $this->render('sound_file/new.html.twig', [
            'categories' => $this->getCategories(),
            'sound_package' => $soundPackage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="view_sound_packages")
     */
    public function view(SoundPackage $soundPackage)
    {
        return $this->render("sound_package/view.html.twig", [
            'categories' => $this->getCategories(),
            'user' => $this->getUser(),
            'soundPackage' => $soundPackage,
            'scoreForm' => $this->createForm(ScoreType::class)->createView()
        ]);
    }

    /**
     * @Route("/{id}/sound/file", name="get_sound_file")
     */
    public function getSoundFile(SoundPackage $soundPackage)
    {
        $response = new BinaryFileResponse($this->getParameter('upload-directory').'/'.$soundPackage->getFilename());
        BinaryFileResponse::trustXSendfileTypeHeader();

        return $response;
    }

    /**
     * @Route("/{id}", name="sound_package_file_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SoundFile $soundFile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soundFile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soundFile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('default');
    }

    /**
     * @Route("/score/submit", name="sound_package_submit_score")
     */
    public function submit(Request $request, UserRepository $repository)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $scoreForm = $request->request->get("score");
        $score = $scoreForm['score'];
        $userId = $scoreForm['user_id'];

        if(!$this->isGranted("IS_AUTHENTICATED_ANONYMOUSLY"))
        {
            $user = $repository->findOneBy(['id' => $userId]);

            $scoreObject = new Score($score, $user);
            $entityManager->persist($scoreObject);
            $entityManager->flush();
        }

        return $this->redirectToRoute('default');
    }
}
