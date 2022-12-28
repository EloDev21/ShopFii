<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            "label" => "E-mail",
            "disabled" =>true
        ])
        ->add('firstname', TextType::class,[
            "label" => "Mon prénom",
            "disabled" =>true
        ] )
        ->add('lastname', TextType::class,[
            "label" => "Mon nom",
            "disabled" =>true,
            "attr" =>[
                "placeholder" => "Merci de rentrer votre mot de passe actuel"
            ]
        ])
        ->add('old_pwd', PasswordType::class,[
            "label" => "Mon mot de passe actuel",
            "mapped" => false,
        
            "attr" =>[
                "placeholder" => "Merci de rentrer votre mot de passe actuel"
            ]


        ])
        ->add('new_pwd', RepeatedType::class, [
            "mapped" => false,
            "type" => PasswordType::class,
            "invalid_message" => "Les deux mots de passe doivent être identiques. Merci de réessayer.",
            "label" => "Mon nouveau mot de passe",
            "required" => true,
            "first_options" => [
                'label' => "Mon nouveau mot de passe",
                "attr" => [
                    "placeholder" => " Merci de saisir votre nouveau mot de passe"
                ]
            ],
            "second_options" => [
                'label' => "Confirmer votre nouveau mot de passe",
                "attr" => [
                    "placeholder" => " Merci de confirmer votre nouveau  mot de passe"
                ]
            ],


        ])
            ->add('submit', SubmitType::class,[
                'label' => "Mettre à jour"
               
            ])
        
        
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ])
        
        ;
    }
}