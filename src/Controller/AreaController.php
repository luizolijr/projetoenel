<?php

namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaType;
use App\Filter\AreaFilterType;
use App\Repository\AreaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/area")
 */
class AreaController extends AbstractController
{
    /**
     * @Route("/", name="area_index", methods={"GET","POST"})
     */
    public function index(Request $request, AreaRepository $areaRepository): Response
    {
        $x = $this->getDoctrine()->getManager();
        $areas = $x->getRepository(Area::class)->findAll();
        $quantidade = count($areas);
        $totalPaginas = (count($areas) / 2);
        $pagina = 1;
        if ($totalPaginas > 1) {
            $queryAreas = $x->getRepository(Area::class) ->createQueryBuilder('p');
            $queryAreas->orderBy('p.descricao', 'ASC');
            $queryAreas->setFirstResult(2 * ($pagina - 1));
            $queryAreas->setMaxResults(2);
            $areas = $queryAreas->getQuery()->getResult();
        }

        $filter = $this->createForm(AreaFilterType::class);
        $filter->handleRequest($request);

        if ($filter->isSubmitted() && $filter->isValid()) {

            $buscaDescricao = $filter->get('descricao')->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $queryAreas = $x->getRepository(Area::class)->createQueryBuilder('a');
            $queryAreas->where('a.descricao LIKE :descricao');
            $queryAreas->setParameter(':descricao', '%' . $buscaDescricao . '%');

            $queryAreas->orderBy('a.descricao', 'ASC');
            $areas = $queryAreas->getQuery()->getResult();

            $quantidade = count($areas);
            $totalPaginas = (count($areas) / 2);
            $pagina = $filter->get('pagina')->getData();

            if ($totalPaginas > 1) {
                $queryAreas->setFirstResult(2 * ($pagina - 1));
                $queryAreas->setMaxResults(2);
                $areas = $queryAreas->getQuery()->getResult();
            }           
        }

        return $this->render('area/index.html.twig', [
            'areas' => $areas,
            'filter' => $filter->createView(),
            'quantidade' => $quantidade,
            'totalPaginas' => ceil($totalPaginas),
            'pagina' => $pagina
        ]);
    }

    /**
     * @Route("/new", name="area_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $area = new Area(); 
        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($area);
            $entityManager->flush();

            return $this->redirectToRoute('area_index');
        }

        return $this->render('area/new.html.twig', [
            'area' => $area,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="area_show", methods={"GET"})
     */
    public function show(Area $area): Response
    {
        return $this->render('area/show.html.twig', [
            'area' => $area,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="area_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Area $area): Response
    {
        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('area_index');
        }

        return $this->render('area/edit.html.twig', [
            'area' => $area,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="area_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Area $area): Response
    {
        if ($this->isCsrfTokenValid('delete'.$area->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($area);
            $entityManager->flush();
        }

        return $this->redirectToRoute('area_index');
    }
}
