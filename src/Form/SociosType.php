<?php

namespace App\Form;

use App\Entity\Empresas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SociosType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome',TextType::class,['label'=>'Nome do Socio: '])
            ->add('cpf',TextType::class,['label'=>'Numero do CPF do Socio'])
            ->add('empresas', EntityType::class, [
                'class'=>Empresas::class,
                'choice_label' =>'razaosocial'
            ])
            ->add('Salvar',SubmitType::class);
    }
}