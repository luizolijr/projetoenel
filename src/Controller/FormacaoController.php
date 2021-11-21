<?php

namespace App\Controller;

use App\Entity\Formacao;
use App\Form\FormacaoType;
use App\Repository\FormacaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/formacao")
 */
class FormacaoController extends AbstractController
{
    /**
     * @Route("/", name="formacao_index", methods={"GET"})
     */
    public function index(FormacaoRepository $formacaoRepository): Response
    {
        return $this->render('formacao/index.html.twig', [
            'formacaos' => $formacaoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="formacao_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formacao = new Formacao();
        $form = $this->createForm(FormacaoType::class, $formacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formacao);
            $entityManager->flush();

            return $this->redirectToRoute('formacao_index');
        }

        return $this->render('formacao/new.html.twig', [
            'formacao' => $formacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formacao_show", methods={"GET"})
     */
    public function show(Formacao $formacao): Response
    {
        return $this->render('formacao/show.html.twig', [
            'formacao' => $formacao,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formacao_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formacao $formacao): Response
    {
        $form = $this->createForm(FormacaoType::class, $formacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formacao_index');
        }

        return $this->render('formacao/edit.html.twig', [
            'formacao' => $formacao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formacao_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Formacao $formacao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formacao->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formacao);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formacao_index');
    }
}
