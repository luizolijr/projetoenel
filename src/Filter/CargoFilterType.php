<?php

namespace App\Filter;

use App\Entity\Area;
use App\Entity\Cargo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CargoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pagina', TextType::class, [
                'required' => false,
                ])
            ->add('descricao', TextType::class, [
                'required' => false,
                ])
            ->add('area', EntityType::class, [
                'required' => false,
                'class' => Area::class,
                'choice_label' => 'descricao',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => Cargo::class,
        ]);
    }
}
