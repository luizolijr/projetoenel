<?php

namespace App\Controller;

use App\Entity\Cargo;
use App\Form\CargoType;
use App\Repository\CargoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Filter\CargoFilterType;

/**
 * @Route("/admin/cargo")
 */
class CargoController extends AbstractController
{
    /**
     * @Route("/", name="cargo_index", methods={"GET","POST"})
     */
    public function index(Request $request, CargoRepository $cargoRepository): Response
    {
        $x = $this->getDoctrine()->getManager();
        $cargos = $x->getRepository(Cargo::class)->findAll();
        $quantidade = count($cargos);
        $totalPaginas = (count($cargos) / 2);
        $pagina = 1;
        if ($totalPaginas > 1) {
            $queryCargos = $x->getRepository(Cargo::class) ->createQueryBuilder('p');
            $queryCargos->orderBy('p.descricao', 'ASC');
            $queryCargos->setFirstResult(2 * ($pagina - 1));
            $queryCargos->setMaxResults(2);
            $cargos = $queryCargos->getQuery()->getResult();
        }        

        $filter = $this->createForm(CargoFilterType::class);
        $filter->handleRequest($request);

        if ($filter->isSubmitted() && $filter->isValid()) {

            $buscaDescricao = $filter->get('descricao')->getData();
            $buscaArea = $filter->get('area')->getData();
            $entrou = false;
            
            $entityManager = $this->getDoctrine()->getManager();

            $queryCargos = $x->getRepository(Cargo::class)->createQueryBuilder('a');
            $queryCargos->where('a.descricao LIKE :descricao');
            // $queryCargos->where('a.area LIKE :area');
            $queryCargos->setParameter(':descricao', '%' . $buscaDescricao . '%');
            // $queryCargos->setParameter(':area', '%' . $buscaArea . '%');
            
            if ($buscaDescricao != null) {
                $queryCargos->where('a.descricao LIKE :descricao');            
                $queryCargos->setParameter(':descricao', '%' . $buscaDescricao . '%');
                $entrou = true;
            }
            
            if  ($buscaArea != null) {
                if ($entrou == false) {
                    $queryCargos->where('a.area = :area');    
                } else {
                    $queryCargos->andWhere('a.area = :area');
                }
                $queryCargos->setParameter(':area', $buscaArea);
            }

            $queryCargos->orderBy('a.descricao', 'ASC');
            $cargos = $queryCargos->getQuery()->getResult();

            $quantidade = count($cargos);
            $totalPaginas = (count($cargos) / 2);
            $pagina = $filter->get('pagina')->getData();

            if ($totalPaginas > 1) {
                $queryCargos->setFirstResult(2 * ($pagina - 1));
                $queryCargos->setMaxResults(2);
                $cargos = $queryCargos->getQuery()->getResult();
            }
        }

        return $this->render('cargo/index.html.twig', [
            'cargos' => $cargos,
            'filter' => $filter->createView(),
            'quantidade' => $quantidade,
            'totalPaginas' => ceil($totalPaginas),
            'pagina' => $pagina
        ]);
    }

    /**
     * @Route("/new", name="cargo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cargo = new Cargo();
        $form = $this->createForm(CargoType::class, $cargo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cargo);
            $entityManager->flush();

            return $this->redirectToRoute('cargo_index');
        }

        return $this->render('cargo/new.html.twig', [
            'cargo' => $cargo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cargo_show", methods={"GET"})
     */
    public function show(Cargo $cargo): Response
    {
        return $this->render('cargo/show.html.twig', [
            'cargo' => $cargo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cargo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cargo $cargo): Response
    {
        $form = $this->createForm(CargoType::class, $cargo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cargo_index');
        }

        return $this->render('cargo/edit.html.twig', [
            'cargo' => $cargo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cargo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cargo $cargo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cargo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cargo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cargo_index');
    }
}
