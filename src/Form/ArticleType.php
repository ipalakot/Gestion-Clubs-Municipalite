<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Article;
use App\Entity\Categorie;

use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'required'   => false,
                'label'=> 'Noms :'])
            
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

            ->add('createdAt', DateType::class, [
                'label'=> 'Date de Creation :',
               // 'format' => 'yyyy-MM-dd',
                'placeholder' => [
                    'year' => 'Year', 
                    'month' => 'Month', 
                    'day' => 'Day',
                    ],
                ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image à inserrer'
            ])
            ->add('resume', CKEditorType::class, [
                'label'=> 'Resume :'])
            ->add('contenu', CKEditorType::class, [
                'label'=> 'Texte :'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
