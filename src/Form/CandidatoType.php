<?php

namespace App\Form;

use App\Entity\Candidato;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class CandidatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('email')
            ->add('cpf')
            ->add('primeiro_emprego')
            ->add('data_nascimento', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('estado_civil', ChoiceType::class, [
                'choices' => [
                    'Selecione' => Null,
                    'Solteiro' => 'Solteiro',
                    'Casado' => 'Casado',
                    'Viúvo' => 'Viúvo',
                    'Separado judicialmente' => 'Separado judicialmente',
                    'Divorciado' => 'Divorciado',
                ],
                
            ])
            ->add('sexo', ChoiceType::class, [
                'choices' => [
                    'Selecione' => Null,
                    'Masculino' => 'Masculino',
                    'Feminino' => 'Feminino',
                    'Não-Binário' => 'Não-Binário',
                ],
            ])
            ->add('numero_filhos')
            ->add('possui_decifiencia')
            ->add('carteira_habilitacao')
            ->add('nacionalidade')
            ->add('naturalidade')
            ->add('foto')
            ->add('cep')
            ->add('logradouro')
            ->add('numero')
            ->add('complemento')
            ->add('bairro')
            ->add('cidade')
            ->add('estado')
            ->add('telefone1')
            ->add('falarcom1')
            ->add('telefone2')
            ->add('falarcom2')            
            ->add('senha', RepeatedType::class, [
                'required' => false,
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Senha'],
                'second_options' => ['label' => 'Confirme a Senha'],
                ])
            // ->add('imageFile', FileType::class,[
            //     'required' => false
            // ])
            // ->add('imageFile2', FileType::class,[
            //     'required' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidato::class,
        ]);
    }
}
