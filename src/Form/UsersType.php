<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('noms', TextType::class, [
                'required'   => false,
                'label'=> 'Noms :'])
            ->add('prenoms', TextType::class, [
                'label'=> 'Prenoms : '])
            ->add('pseudo', TextType::class, [
                'label'=> 'pseudo : '])
            ->add('adresse',TextType::class, [
                'label'=> 'Adresse : '])
            ->add('phone', TelType::class,[
                'label'=> 'Phone :'])
            ->add('mail', EmailType::class,[
                'label'=> 'Emails :'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
