<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('noms', TextType::class, [
                'required'   => false,
                'label'=> 'Noms :'])
            ->add('prenoms', TextType::class, [
                'label'=> 'Prenoms : '])
            ->add('adresse', TextareaType::class, [
                'label'=> 'Adresse : '])
            ->add('mail', EmailType::class,[
                'label'=> 'Emails :'])
            ->add('phone', TelType::class,[
                'label'=> 'Phone :'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
