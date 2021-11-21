<?php

namespace App\Controller;

use App\Entity\Experiencia;
use App\Form\ExperienciaType;
use App\Repository\ExperienciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/experiencia")
 */
class ExperienciaController extends AbstractController
{
    /**
     * @Route("/", name="experiencia_index", methods={"GET"})
     */
    public function index(ExperienciaRepository $experienciaRepository): Response
    {
        return $this->render('experiencia/index.html.twig', [
            'experiencias' => $experienciaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="experiencia_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $experiencium = new Experiencia();
        $form = $this->createForm(ExperienciaType::class, $experiencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($experiencium);
            $entityManager->flush();

            return $this->redirectToRoute('experiencia_index');
        }

        return $this->render('experiencia/new.html.twig', [
            'experiencium' => $experiencium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="experiencia_show", methods={"GET"})
     */
    public function show(Experiencia $experiencium): Response
    {
        return $this->render('experiencia/show.html.twig', [
            'experiencium' => $experiencium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="experiencia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Experiencia $experiencium): Response
    {
        $form = $this->createForm(ExperienciaType::class, $experiencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('experiencia_index');
        }

        return $this->render('experiencia/edit.html.twig', [
            'experiencium' => $experiencium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="experiencia_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Experiencia $experiencium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experiencium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($experiencium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('experiencia_index');
    }
}
