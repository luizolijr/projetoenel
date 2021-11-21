<?php

namespace App\Form;

use App\Entity\Candidato;
use App\Entity\Empresa;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')            
            ->add('tipo')
            ->add('empresa', EntityType::class, [
                'class' => Empresa::class,
                'choice_label' => 'nome_fantasia',
            ])
            ->add('candidato', EntityType::class, [
                'class' => Candidato::class,
                'choice_label' => 'nome',
            ])
            ->add('password', RepeatedType::class, [
                'required' => false,
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Senha'],
                'second_options' => ['label' => 'Confirme a Senha'],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
