<?php

namespace App\Controller;

use App\Entity\Lingua;
use App\Form\LinguaType;
use App\Repository\LinguaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/lingua")
 */
class LinguaController extends AbstractController
{
    /**
     * @Route("/", name="lingua_index", methods={"GET"})
     */
    public function index(LinguaRepository $linguaRepository): Response
    {
        return $this->render('lingua/index.html.twig', [
            'linguas' => $linguaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lingua_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lingua = new Lingua();
        $form = $this->createForm(LinguaType::class, $lingua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lingua);
            $entityManager->flush();

            return $this->redirectToRoute('lingua_index');
        }

        return $this->render('lingua/new.html.twig', [
            'lingua' => $lingua,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lingua_show", methods={"GET"})
     */
    public function show(Lingua $lingua): Response
    {
        return $this->render('lingua/show.html.twig', [
            'lingua' => $lingua,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lingua_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lingua $lingua): Response
    {
        $form = $this->createForm(LinguaType::class, $lingua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lingua_index');
        }

        return $this->render('lingua/edit.html.twig', [
            'lingua' => $lingua,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lingua_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lingua $lingua): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lingua->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lingua);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lingua_index');
    }
}
