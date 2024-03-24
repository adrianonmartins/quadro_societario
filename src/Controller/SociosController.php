<?php

namespace App\Controller;

use App\Entity\Socios;
use App\Form\SociosType;
use App\Repository\SociosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bunble\FrameworkExtraBundle\Configuration\IsGranted;

class SociosController extends AbstractController
{
    #[Route('/socios', name: 'lista_socio')]
    #[IsGranted('ROLE_USER')]
    public function listarSocios(SociosRepository $sociosRepository):Response
    {   
        $data['socios'] = $sociosRepository->findAll();
        $data['titulo'] = 'Socios Cadastrados';

        return $this->render('socioList.html.twig',$data);
    }

    #[Route('/socio/adicionar', name: 'add_socio')]
    #[IsGranted('ROLE_USER')]
    public function addSocio (Request $request, EntityManagerInterface $entityManager) : Response 
    {
        $msg = "";
        $socio = new Socios();
        $form = $this->createForm(SociosType::class,$socio);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($socio);
            $entityManager->flush();
            $msg = "Socio Adicionado com sucesso";

            return $this->redirectToRoute('lista_socio');
        }
        $data['titulo']= 'Adicionar novo Socio';
        $data['form'] = $form;
        $data['msg']    = $msg;

        return $this->render('socios.html.twig',$data);
    }
    #[Route('/socio/editar/{id}', name: 'edit_socio')]
    #[IsGranted('ROLE_USER')]
    public function editSocio($id, Request $request, EntityManagerInterface $entityManager, SociosRepository $sociosRepository) : Response
    {   
        $msg = "";
        $socio = $sociosRepository->find($id);
        $form = $this->createForm(SociosType::class,$socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager->flush();
            $msg = "Cadastro de Socio Editado com sucesso";

            return $this->redirectToRoute('lista_socio');
        }
        
        $data['titulo'] = 'Editar Socio';
        $data['form']   = $form;
        $data['msg']    = $msg;

        return $this->render('socios.html.twig',$data);
    }
    #[Route('/socio/excluir/{id}', name: 'excluir_socio')]  
    #[IsGranted('ROLE_USER')]
    public function excluirSocio($id , EntityManagerInterface $entityManager, SociosRepository $sociosRepository): Response
    {
        $socio = $sociosRepository->find($id);

        $entityManager->remove($socio);
        $entityManager->flush();

        return $this->redirectToRoute('lista_socio');
    }
}

