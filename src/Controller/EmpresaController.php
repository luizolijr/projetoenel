<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Form\EmpresaType;
use App\Repository\EmpresaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Filter\EmpresaFilterType;

/**
 * @Route("/admin/empresa")
 */
class EmpresaController extends AbstractController
{
    /**
     * @Route("/", name="empresa_index", methods={"GET","POST"})
     */
    public function index(Request $request, EmpresaRepository $empresaRepository): Response
    {
        $x = $this->getDoctrine()->getManager();
        $empresas = $x->getRepository(Empresa::class)->findAll();
        $quantidade = count($empresas);
        $totalPaginas = (count($empresas) / 2);
        $pagina = 1;
        if ($totalPaginas > 1) {
            $queryEmpresas = $x->getRepository(Empresa::class) ->createQueryBuilder('p');
            $queryEmpresas->orderBy('p.nome_fantasia', 'ASC');
            $queryEmpresas->setFirstResult(2 * ($pagina - 1));
            $queryEmpresas->setMaxResults(2);
            $empresas = $queryEmpresas->getQuery()->getResult();
        }       
        
        $filter = $this->createForm(EmpresaFilterType::class);
        $filter->handleRequest($request);

        if ($filter->isSubmitted() && $filter->isValid()) {
            
            $buscaNomeFantasia = $filter->get('nome_fantasia')->getData();
            
            $entityManager = $this->getDoctrine()->getManager();

            $queryEmpresas = $x->getRepository(Empresa::class)->createQueryBuilder('a');
            $queryEmpresas->where('a.nome_fantasia LIKE :nome_fantasia');
            $queryEmpresas->setParameter(':nome_fantasia', '%' . $buscaNomeFantasia . '%');
            // $query = $queryEmpresa->getQuery();
            // $empresas = $query->getResult();

            $queryEmpresas->orderBy('a.nome_fantasia', 'ASC');
            $empresas = $queryEmpresas->getQuery()->getResult();

            $quantidade = count($empresas);
            $totalPaginas = (count($empresas) / 2);
            $pagina = $filter->get('pagina')->getData();

            if ($totalPaginas > 1) {
                $queryEmpresas->setFirstResult(2 * ($pagina - 1));
                $queryEmpresas->setMaxResults(2);
                $empresas = $queryEmpresas->getQuery()->getResult();
            }
        }

        return $this->render('empresa/index.html.twig', [
            'empresas' => $empresas,
            'filter' => $filter->createView(),
            'quantidade' => $quantidade,
            'totalPaginas' => ceil($totalPaginas),
            'pagina' => $pagina
        ]);
    }

    /**
     * @Route("/new", name="empresa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $empresa = new Empresa();
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresa);
            $entityManager->flush();

            return $this->redirectToRoute('empresa_index');
        }

        return $this->render('empresa/new.html.twig', [
            'empresa' => $empresa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="empresa_show", methods={"GET"})
     */
    public function show(Empresa $empresa): Response
    {
        return $this->render('empresa/show.html.twig', [
            'empresa' => $empresa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="empresa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Empresa $empresa): Response
    {
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('empresa_index');
        }

        return $this->render('empresa/edit.html.twig', [
            'empresa' => $empresa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="empresa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Empresa $empresa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$empresa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($empresa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('empresa_index');
    }
}
