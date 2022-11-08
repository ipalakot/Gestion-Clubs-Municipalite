<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Auteur;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('image')
            ->add('resume')
            ->add('contenu')
            ->add('createdAt')
            ->add('categorie', EntityType::class,[
                
                    //Choix de l'entity
                    'class'=>Categorie::class,

                    //Propriete sur laquelle je vais faire le choix
                    'choice_label'=>'titre',]
                )

            ->add('auteur', EntityType::class,[
                
                    //Choix de l'entity
                    'class'=>Auteur::class,

                    //Propriete sur laquelle je vais faire le choix
                    'choice_label'=>'noms',]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
