<?php

namespace App\Form;

use App\Entity\Candidato;
use App\Entity\Software;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SoftwareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descricao')
            ->add('nivel', ChoiceType::class, [
                'required' => true,
                'choices' => [                    
                    'Iniciante' => 'Iniciante',
                    'Intermediário' => 'Intermediário',
                    'Avançado' => 'Avançado',
                    'Fluente' => 'Fluente',
                ],
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
            'data_class' => Software::class,
        ]);
    }
}
