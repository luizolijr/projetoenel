<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Entity\Formacao;
use App\Form\CandidatoType;
use App\Form\CandidatoLinguaType;
use App\Form\CandidatoExperienciaType;
use App\Form\CandidatoSoftwareType;
use App\Form\CandidatoFormacaoType;
use App\Form\CandidatoDesejadoType;
use App\Repository\CandidatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lingua;
use App\Entity\Experiencia;
use App\Entity\Software;
use App\Entity\CargoDesejado;
use App\Entity\Desejado;
use App\Filter\CandidatoFilterType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;


/**
 * @Route("/admin/candidato")
 */
class CandidatoController extends AbstractController
{
    /**
     * @Route("/", name="candidato_index", methods={"GET","POST"})
     */
    public function index(Request $request, CandidatoRepository $candidatoRepository): Response
    {
        $x = $this->getDoctrine()->getManager();
        $candidatos = $x->getRepository(Candidato::class)->findAll();
        $quantidade = count($candidatos);
        $totalPaginas = (count($candidatos) / 2);
        $pagina = 1;
        if ($totalPaginas > 1) {
            $queryCandidatos = $x->getRepository(Candidato::class) ->createQueryBuilder('p');
            $queryCandidatos->orderBy('p.nome', 'ASC');
            $queryCandidatos->setFirstResult(2 * ($pagina - 1));
            $queryCandidatos->setMaxResults(2);
            $candidatos = $queryCandidatos->getQuery()->getResult();
        }        

        $filter = $this->createForm(CandidatoFilterType::class);
        $filter->handleRequest($request);

        if ($filter->isSubmitted() && $filter->isValid()) {

            //$queryProjetos=$x->getRepository(Candidato::class)->createQueryBuilder('p');

            $buscaNome = $filter->get('nome')->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $queryCandidatos = $x->getRepository(Candidato::class)->createQueryBuilder('a');
            $queryCandidatos->where('a.nome LIKE :nome');
            $queryCandidatos->setParameter(':nome', '%' . $buscaNome . '%');
            //$query = $queryCandidato->getQuery();
            //$candidatos = $query->getResult();
        
        
            $queryCandidatos->orderBy('a.nome', 'ASC');
            $candidatos = $queryCandidatos->getQuery()->getResult();

            $quantidade = count($candidatos);
            $totalPaginas = (count($candidatos) / 2);
            $pagina = $filter->get('pagina')->getData();

            if ($totalPaginas > 1) {
                $queryCandidatos->setFirstResult(2 * ($pagina - 1));
                $queryCandidatos->setMaxResults(2);
                $candidatos = $queryCandidatos->getQuery()->getResult();
            }
        }

        $relatorio = '';
        $relatorio = $relatorio . '<table width="100%"><tr><td width="15%" align="left"><img src="" style="max-width: 120px; max-height: 100px;"></td><td width="85%" align="left"><span style="font-size: 23px;"><b>ALÔ ALÔ RELATÓRIO
    !!</b></span><br>';
        $relatorio = $relatorio . '<span style="font-size: 12px;">Rua do Luix, Nº 10<br>';
        $relatorio = $relatorio . '(22) 9999 - 9999<br>';
        $relatorio = $relatorio . 'Campos / RJ<br>';
        $relatorio = $relatorio . 'CEP: xx.xxx-xxx</span></td></tr></table><br>';

        $relatorio = $relatorio . '<table width="100%"><tr><td align="center"><span style="font-size: 16px;"><b>Relatório dos Projetos<b/></span></td></tr></table><br>';

        $relatorio = $relatorio . '<table width="100%"><tr><td align="center"><hr></td></tr></table>';

        $relatorio = $relatorio . '<table width="100%">';
        $relatorio = $relatorio . '<tr>';
        $relatorio = $relatorio . '  <td width="50%" align="left"><span style="font-size: 12px;"><b>Nome</b></span></td>';
        $relatorio = $relatorio . '</tr>';
        $relatorio = $relatorio . '<tr>';
        $relatorio = $relatorio . '<td colspan="7"><hr></td></tr>';

        foreach ($candidatos as $candidato) {
            

            $relatorio = $relatorio . '<tr>';
            $relatorio = $relatorio . '  <td width="50%" align="left"><span style="font-size: 12px;">'. $candidato->getNome() .'</span></td>';
            $relatorio = $relatorio . '</tr>';
        }

        $relatorio = $relatorio . '</table>';

        $relatorio = $relatorio . '<table width="100%"><tr><td align="center"><hr></td></tr></table>';

        if ($candidatos != null){
            $relatorio = $relatorio . '<table width="100%"><tr><td align="left"><span style="font-size: 12px;"><b>Quantidade de candidatos: '. count($candidatos).'</b></span></td></tr></table>';
        }

        $defaultData = array('message'=> $relatorio);
        $report_form = $this->createFormBuilder($defaultData)
            ->add('message', TextareaType::class)
            ->getForm();
        $report_form->handleRequest($request);
        
        return $this->render('candidato/index.html.twig', [
            'candidatos' => $candidatos,
            'filter' => $filter->createView(),
            'report_form'=>$report_form->createView(),
            'quantidade' => $quantidade,
            'totalPaginas' => ceil($totalPaginas),
            'pagina' => $pagina
        ]); 
    }

    /**
     * @Route("/new", name="candidato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $candidato = new Candidato();
        $form = $this->createForm(CandidatoType::class, $candidato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidato);
            $entityManager->flush();

            return $this->redirectToRoute('candidato_index');
        }

        return $this->render('candidato/new.html.twig', [
            'candidato' => $candidato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidato_show", methods={"GET"})
     */
    public function show(Candidato $candidato): Response
    {
        return $this->render('candidato/show.html.twig', [
            'candidato' => $candidato,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="candidato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidato $candidato): Response
    {
        $form = $this->createForm(CandidatoType::class, $candidato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidato_index');
        }

        return $this->render('candidato/edit.html.twig', [
            'candidato' => $candidato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidato_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Candidato $candidato): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidato->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidato_index');
    }

    /**
     * @Route("/adicionar/lingua", name="candidato_lingua", methods={"GET","POST"})
     */
    public function adicionarLingua(Request $request, CandidatoRepository $candidatoRepository): Response
    {
        $descricao = $request->get("lingua_descricao");
        $nivel = $request->get("lingua_nivel");
        $candidatoId = $request->get("lingua_candidato");

        $candidato = $candidatoRepository->find($candidatoId);

        $lingua = new Lingua();
        $lingua->setDescricao( $descricao );
        $lingua->setNivelFluencia( $nivel );
        $lingua->setCandidato( $candidato );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($lingua);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 'id' => $candidato->getId() ]); 
    }

    /**
     * @Route("/mostrar/lingua/{candidato}/{lingua}", name="candidato_mostrar_lingua", methods={"GET"})
     */
    public function showLingua(Candidato $candidato, Lingua $lingua ): Response
    {
        return $this->render('candidato/mostrar_lingua.html.twig', [
            'candidato' => $candidato,
            'lingua' => $lingua,
        ]);
    }

    /**
     * @Route("/editar/lingua/{candidato}/{lingua}", name="candidato_editar_lingua", methods={"GET","POST"})
     */
    public function editarLingua(Request $request, Candidato $candidato, Lingua $lingua ): Response
    {

        $form = $this->createForm(CandidatoLinguaType::class, $lingua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidato_edit', [ 
                'id' => $candidato->getId()
            ]);
        }

        return $this->render('candidato/lingua.html.twig', [
            'candidato' => $candidato,
            'lingua' => $lingua,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/remover/lingua/{candidato}/{lingua}", name="candidato_delete_lingua", methods={"GET","POST"})
     */
    public function deleteLingua(Request $request, Candidato $candidato, Lingua $lingua): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($lingua);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 
            'id' => $candidato->getId()
        ]);
    }
    
    /**
     * @Route("/adicionar/experiencia", name="candidato_experiencia", methods={"GET","POST"})
     */
    public function adicionarExperiencia(Request $request, CandidatoRepository $candidatoRepository): Response
    {
        
       
        $empresa = $request->get("experiencia_empresa");
        $cargo = $request->get("experiencia_cargo");
        $admissao = null;
        if ( $request->get("experiencia_admissao") != null ) {
            $admissao = new \DateTime( $request->get("experiencia_admissao") , new \DateTimeZone('America/Sao_Paulo'));
        }
        $demissao = null;
        if ( $request->get("experiencia_demissao") != null ) {
            $demissao = new \DateTime( $request->get("experiencia_demissao") , new \DateTimeZone('America/Sao_Paulo'));
        }
        $salario = $request->get("experiencia_salario");
        $atividade = $request->get("experiencia_atividade");
        $candidatoId = $request->get("experiencia_candidato");

        $candidato = $candidatoRepository->find($candidatoId);

        $experiencia = new Experiencia();
        $experiencia->setEmpresa( $empresa );
        $experiencia->setUltimoCargo( $cargo );
        $experiencia->setDataAdmissao( $admissao );
        $experiencia->setDataDemissao( $demissao );
        $experiencia->setUltimoSalario( $salario );
        $experiencia->setAtividadeExercida( $atividade );
        $experiencia->setCandidato( $candidato );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($experiencia);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 'id' => $candidato->getId() ]);
    }

    /**
     * @Route("/mostrar/experiencia/{candidato}/{experiencia}", name="candidato_mostrar_experiencia", methods={"GET"})
     */
    public function showExperiencia(Candidato $candidato, Experiencia $experiencia ): Response
    {
        return $this->render('candidato/mostrar_experiencia.html.twig', [
            'candidato' => $candidato,
            'experiencia' => $experiencia,
        ]);
    }


    /**
     * @Route("/editar/experiencia/{candidato}/{experiencia}", name="candidato_editar_experiencia", methods={"GET","POST"})
     */
    public function editarExperiencia(Request $request, Candidato $candidato, Experiencia $experiencia): Response
    {

        $form = $this->createForm(CandidatoExperienciaType::class, $experiencia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidato_edit', [ 
                'id' => $candidato->getId()
            ]);
        }

        return $this->render('candidato/experiencia.html.twig', [
            'candidato' => $candidato,
            'experiencia' => $experiencia,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/remover/experiencia/{candidato}/{experiencia}", name="candidato_delete_experiencia", methods={"GET","POST"})
     */
    public function deleteExperiencia(Request $request, Candidato $candidato, Experiencia $experiencia): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($experiencia);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 
            'id' => $candidato->getId()
        ]);
    }


    /**
     * @Route("/adicionar/formacao", name="candidato_formacao", methods={"GET","POST"})
     */
    public function adicionarFormacao(Request $request, CandidatoRepository $candidatoRepository): Response
    {
        
       
        $curso = $request->get("formacao_curso");
        $situacao = $request->get("formacao_situacao");
        $conclusao = null;
        if ( $request->get("formacao_conclusao") != null ) {
            $conclusao = new \DateTime( $request->get("formacao_conclusao") , new \DateTimeZone('America/Sao_Paulo'));
        }        
        $grau = $request->get("formacao_grau");
        $instituicao = $request->get("formacao_instituicao");
        $candidatoId = $request->get("formacao_candidato");

        $candidato = $candidatoRepository->find($candidatoId);

        $formacao = new Formacao();
        $formacao->setCurso( $curso );
        $formacao->setSituacao( $situacao );
        $formacao->setDataConclusao( $conclusao );
        $formacao->setGrauFormacao( $grau );
        $formacao->setInstituicao( $instituicao );
        $formacao->setCandidato( $candidato );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($formacao);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 'id' => $candidato->getId() ]);
    }

    /**
     * @Route("/mostrar/formacao/{candidato}/{formacao}", name="candidato_mostrar_formacao", methods={"GET"})
     */
    public function showFormacao(Candidato $candidato, Formacao $formacao ): Response
    {
        return $this->render('candidato/mostrar_formacao.html.twig', [
            'candidato' => $candidato,
            'formacao' => $formacao,
        ]);
    }


    /**
     * @Route("/editar/formacao/{candidato}/{formacao}", name="candidato_editar_formacao", methods={"GET","POST"})
     */
    public function editarFormacao(Request $request, Candidato $candidato, Formacao $formacao): Response
    {

        $form = $this->createForm(CandidatoFormacaoType::class, $formacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidato_edit', [ 
                'id' => $candidato->getId()
            ]);
        }

        return $this->render('candidato/formacao.html.twig', [
            'candidato' => $candidato,
            'formacao' => $formacao,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/remover/formacao/{candidato}/{formacao}", name="candidato_delete_formacao", methods={"GET","POST"})
     */
    public function deleteFormacao(Request $request, Candidato $candidato, Formacao $formacao): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($formacao);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 
            'id' => $candidato->getId()
        ]);
    }

    /**
     * @Route("/adicionar/software", name="candidato_software", methods={"GET","POST"})
     */
    public function adicionarSoftware(Request $request, CandidatoRepository $candidatoRepository): Response
    {
        
       
        $descricao = $request->get("software_descricao");
        $nivel = $request->get("software_nivel");
        $candidatoId = $request->get("software_candidato");

        $candidato = $candidatoRepository->find($candidatoId);

        $software = new Software();
        $software->setDescricao( $descricao );
        $software->setNivel( $nivel );
        $software->setCandidato( $candidato );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($software);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 'id' => $candidato->getId() ]);
    }

    /**
     * @Route("/mostrar/software/{candidato}/{software}", name="candidato_mostrar_software", methods={"GET"})
     */
    public function showSoftware(Candidato $candidato, Software $software ): Response
    {
        return $this->render('candidato/mostrar_software.html.twig', [
            'candidato' => $candidato,
            'software' => $software,
        ]);
    }


    /**
     * @Route("/editar/software/{candidato}/{software}", name="candidato_editar_software", methods={"GET","POST"})
     */
    public function editarSoftware(Request $request, Candidato $candidato, Software $software): Response
    {

        $form = $this->createForm(CandidatoSoftwareType::class, $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidato_edit', [ 
                'id' => $candidato->getId()
            ]);
        }

        return $this->render('candidato/software.html.twig', [
            'candidato' => $candidato,
            'software' => $software,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/remover/software/{candidato}/{software}", name="candidato_delete_software", methods={"GET","POST"})
     */
    public function deleteSoftware(Request $request, Candidato $candidato, Software $software): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($software);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 
            'id' => $candidato->getId()
        ]);
    }

    /**
     * @Route("/adicionar/desejado", name="candidato_desejado", methods={"GET","POST"})
     */
    public function adicionarDesejado(Request $request, CandidatoRepository $candidatoRepository): Response
    {
        
       
        $cargo = $request->get("desejado_cargo");
        $pretensao = $request->get("desejado_pretensao");
        $candidatoId = $request->get("desejado_candidato");

        $candidato = $candidatoRepository->find($candidatoId);

        $desejado = new CargoDesejado();
        $desejado->setCargo( $cargo );
        $desejado->setPretencaoSalarial( $pretensao );
        $desejado->setCandidato( $candidato );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($desejado);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 'id' => $candidato->getId() ]);
    }

    /**
     * @Route("/mostrar/desejado/{candidato}/{desejado}", name="candidato_mostrar_desejado", methods={"GET"})
     */
    public function showCargoDesejado(Candidato $candidato, CargoDesejado $cargoDesejado ): Response
    {
        return $this->render('candidato/mostrar_desejado.html.twig', [
            'candidato' => $candidato,
            'desejado' => $cargoDesejado,
        ]);
    }


    /**
     * @Route("/editar/desejado/{candidato}/{desejado}", name="candidato_editar_desejado", methods={"GET","POST"})
     */
    public function editarCargoDesejado(Request $request, Candidato $candidato, CargoDesejado $cargoDesejado): Response
    {

        $form = $this->createForm(CandidatoDesejadoType::class, $cargoDesejado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidato_edit', [ 
                'id' => $candidato->getId()
            ]);
        }

        return $this->render('candidato/desejado.html.twig', [
            'candidato' => $candidato,
            'desejado' => $cargoDesejado,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/remover/desejado/{candidato}/{desejado}", name="candidato_delete_desejado", methods={"GET","POST"})
     */
    public function deleteCargoDesejado(Request $request, Candidato $candidato, CargoDesejado $cargoDesejado): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($cargoDesejado);
        $entityManager->flush();

        return $this->redirectToRoute('candidato_edit', [ 
            'id' => $candidato->getId()
        ]);
    }

    /**
     * @Route("/report/print", name="candidato_report", methods={"POST"})
     */
    public function report(Request $request)
    {
        $defaultData = array('message' => '' );
        $report = $this->createFormBuilder($defaultData)
            ->add('message', TextareaType::class)
            ->getForm();
        if ($request->getMethod() == 'POST') {
            $report->handleRequest($request);

            $relatorio = $report->get('message')->getData();

            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'L'
            ]);
            $mpdf->WriteHTML($relatorio);
            $mpdf->Output();
            exit();
        }
    }
}