<?php

namespace App\Controller;

use App\Entity\Empresas;
use App\Form\EmpresasType;
use App\Repository\EmpresasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bunble\FrameworkExtraBundle\Configuration\IsGranted;

class EmpresasController extends AbstractController
{
    #[Route('/empresas', name: 'lista_empresa')]
    #[IsGranted('ROLE_USER')]
    public function listarEmpresas(EmpresasRepository $empresasRepository):Response
    {   
        $this->denyAccessUnlessGranted('ROLE_USER');

        $data['empresas'] = $empresasRepository->findAll();
        $data['titulo'] = 'Listagem de Empresas';

        return $this->render('empresaList.html.twig',$data);
    }

    #[Route('/empresa/adicionar', name: 'add_empresa')]
    #[IsGranted('ROLE_USER')]
    public function addEmpresa (Request $request, EntityManagerInterface $entityManager) : Response 
    {
        $msg = "";
        $empresa = new Empresas();
        $form = $this->createForm(EmpresasType::class,$empresa);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($empresa);
            $entityManager->flush();
            $msg = "Empresa Adicionada com sucesso";

            return $this->redirectToRoute('lista_empresa');
        }
        $data['titulo']= 'Adicionar nova Empresa';
        $data['form'] = $form;
        $data['msg']    = $msg;


        return $this->render('empresas.html.twig',$data);
    }
    #[Route('/empresa/editar/{id}', name: 'edit_empresa')]
    #[IsGranted('ROLE_USER')]
    public function editEmpresa($id, Request $request, EntityManagerInterface $entityManager, EmpresasRepository $empresasRepository) : Response
    {   
        $msg = "";
        $empresa = $empresasRepository->find($id);
        $form = $this->createForm(EmpresasType::class,$empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager->flush();
            $msg = "Empresa Editada com sucesso";
            return $this->redirectToRoute('lista_empresa');
        }
        
        $data['titulo'] = 'Editar Empresa';
        $data['form']   = $form;
        $data['msg']    = $msg;

        return $this->render('empresas.html.twig',$data);
    }
    #[Route('/empresa/excluir/{id}', name: 'excluir_empresa')]  
    #[IsGranted('ROLE_USER')]
    public function excluirEmpresa($id , EntityManagerInterface $entityManager, EmpresasRepository $empresasRepository): Response
    {
        $empresa = $empresasRepository->find($id);

        $entityManager->remove($empresa);
        $entityManager->flush();

        return $this->redirectToRoute('lista_empresa');
    }
}