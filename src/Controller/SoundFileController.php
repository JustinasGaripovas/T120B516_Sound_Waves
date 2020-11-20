<?php

namespace App\Controller;

use App\Entity\SoundFile;
use App\Form\SoundFileType;
use App\Repository\SoundFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/sound/file")
 */
class SoundFileController extends AbstractController
{
    /**
     * @Route("/", name="sound_file_index")
     */
    public function index(SoundFileRepository $soundFileRepository): Response
    {
        return $this->render('sound_file/index.html.twig', [
            'sound_files' => $soundFileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sound_file_new")
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $soundFile = new SoundFile();
        $form = $this->createForm(SoundFileType::class, $soundFile);
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
                $soundFile->setFilename($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($soundFile);
            $entityManager->flush();

            return $this->redirectToRoute('sound_file_index');
        }

        return $this->render('sound_file/new.html.twig', [
            'sound_file' => $soundFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sound_file_show")
     */
    public function show(SoundFile $soundFile): Response
    {
        return $this->render('sound_file/show.html.twig', [
            'sound_file' => $soundFile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sound_file_edit")
     */
    public function edit(Request $request, SoundFile $soundFile): Response
    {
        $form = $this->createForm(SoundFileType::class, $soundFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sound_file_index');
        }

        return $this->render('sound_file/edit.html.twig', [
            'sound_file' => $soundFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sound_file_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SoundFile $soundFile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soundFile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soundFile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sound_file_index');
    }
}
