<?php

namespace App\Controller;

use App\Entity\CargoDesejado;
use App\Form\CargoDesejadoType;
use App\Repository\CargoDesejadoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cargodesejado")
 */
class CargoDesejadoController extends AbstractController
{
    /**
     * @Route("/", name="cargo_desejado_index", methods={"GET"})
     */
    public function index(CargoDesejadoRepository $cargoDesejadoRepository): Response
    {
        return $this->render('cargo_desejado/index.html.twig', [
            'cargo_desejados' => $cargoDesejadoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cargo_desejado_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cargoDesejado = new CargoDesejado();
        $form = $this->createForm(CargoDesejadoType::class, $cargoDesejado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cargoDesejado);
            $entityManager->flush();

            return $this->redirectToRoute('cargo_desejado_index');
        }

        return $this->render('cargo_desejado/new.html.twig', [
            'cargo_desejado' => $cargoDesejado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cargo_desejado_show", methods={"GET"})
     */
    public function show(CargoDesejado $cargoDesejado): Response
    {
        return $this->render('cargo_desejado/show.html.twig', [
            'cargo_desejado' => $cargoDesejado,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cargo_desejado_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CargoDesejado $cargoDesejado): Response
    {
        $form = $this->createForm(CargoDesejadoType::class, $cargoDesejado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cargo_desejado_index');
        }

        return $this->render('cargo_desejado/edit.html.twig', [
            'cargo_desejado' => $cargoDesejado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cargo_desejado_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CargoDesejado $cargoDesejado): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cargoDesejado->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cargoDesejado);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cargo_desejado_index');
    }
}
