<?php

namespace App\Filter;

use App\Entity\Candidato;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;




class CandidatoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pagina', TextType::class, [
            'required' => false,
            ])
            ->add('nome', TextType::class, [
                'required' => false
            ])           
            ->add('ativo', ChoiceType::class, array(
                'required' => true,
                'choices' => array(
                    'Todos' => 'Todos',
                    'Sim' => 'Sim',
                    'Não' => 'Não'
                )
            ))
            
            // ->add('imageFile', FileType::class,[
            //     'required' => false
            // ])
            // ->add('imageFile2', FileType::class,[
            //     'required' => false
            // ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => Candidato::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'candidato_filter';
    }
}

