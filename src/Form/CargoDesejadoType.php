<?php

namespace App\Form;

use App\Entity\Candidato;
use App\Entity\CargoDesejado;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CargoDesejadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cargo')
            ->add('pretencao_salarial')
            ->add('candidato', EntityType::class, [
                'class' => Candidato::class,
                'choice_label' => 'nome',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CargoDesejado::class,
        ]);
    }
}
