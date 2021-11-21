<?php

namespace App\Form;

use App\Entity\Candidato;
use App\Entity\Experiencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CandidatoExperienciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('empresa')
            ->add('ultimo_cargo')
            ->add('data_admissao', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('data_demissao', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('ultimo_salario')
            ->add('atividade_exercida')            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experiencia::class,
        ]);
    }
}
