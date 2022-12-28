<?php

namespace App\Form;
use App\Classe;
use App\Classe\Search;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    // notre form
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string', TextType::class,[
                "label" => false,
                "required" => false,
                'attr' => [
                    "placeholder" => "Votre recherche ...",
                    "class" => "form-control-sm "
                ]
    
                
                ])
                
            ->add('categories' , EntityType::class,[
                "label" => false,
                "required" => false, 
                "class" => Category::class,
                "multiple" => true,
                // pour select +ieurs categories
                "expanded" => true
            ] )
            ->add('submit', SubmitType::class,[
                "attr" =>[
                    'label' => 'Filtrer',
                    'class' => ' btn-block btn-primary'
                ]
            ])
                ;

            
         
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            // pour avoir un url deja fait quon peut partager et methode get pour recuperer ca dan 
            // s lurl
            'crsf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return ''; 
        // pour pas modifier l'url
    }
}