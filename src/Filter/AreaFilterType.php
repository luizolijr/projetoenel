<?php

namespace App\Filter;

use App\Entity\Area;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AreaFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pagina', TextType::class, [
            'required' => false,
            ])
            ->add('descricao', TextType::class, [
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => Area::class,
        ]);
    }
    
    public function getBlockPrefix()
    {
        return 'area_filter';
    }
}
