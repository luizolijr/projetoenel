<?php

namespace App\Form;

use App\Entity\Empresa;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome_fantasia')
            ->add('razao_social')
            ->add('cnpj')
            ->add('email')
            ->add('telefone1')
            ->add('telefone2')
            ->add('cep')
            ->add('logradouro')
            ->add('numero')
            ->add('complemento')
            ->add('bairro')
            ->add('cidade')
            ->add('estado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
