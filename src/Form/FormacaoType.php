<?php

namespace App\Form;

use App\Entity\Candidato;
use App\Entity\Formacao;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FormacaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grau_formacao')
            ->add('curso')
            ->add('instituicao')
            ->add('situacao')
            ->add('data_conclusao', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('candidato', EntityType::class, [
                'class' => Candidato::class,
                'choice_label' => 'nome',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formacao::class,
        ]);
    }
}
